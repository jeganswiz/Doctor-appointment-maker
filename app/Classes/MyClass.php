<?php
namespace App\Classes;

use Session;
use App\Models\Enquiry;
use App\Models\Sitesettings;
use Mail;
use Uuid; 
use Config;

class MyClass { 
    
	public function anySendmail($type, $template, $sub, $userModel, $secretcode = null,$siteUrl)
    {
        $sitesettingModel = Sitesettings::find(1);
        if (!empty($sitesettingModel))
        {
            $smtphost = $sitesettingModel->smtphost;
            $smtpport = $sitesettingModel->smtpport;
            $smtpusername = $sitesettingModel->smtpemail;
            $smtppassword = $sitesettingModel->smtppassword;
            $sitename = $sitesettingModel->sitename;
            if ($sitesettingModel->smtpenable == 1)
            {
                Config::set('mail.driver', 'smtp');
                Config::set('mail.port', $smtpport);
                Config::set('mail.host', $smtphost);
                Config::set('mail.username', $smtpusername);
                Config::set('mail.password', $smtppassword);
                Config::set('mail.encryption', 'ssl');
            }
            else
            {
                Config::set('mail.driver', 'sendmail');
            }

            try
            {
            	if ($type == 'sendconfirmation') {
            		Mail::send($template, ['userModel' => $userModel, 'sitesettingModel' => $sitesettingModel, 'secretCode' => $secretcode,'siteUrl' => $siteUrl], function ($message) use ($userModel, $sub, $sitesettingModel)
	                {
	                    $message->subject($sub);
	                    $message->from($sitesettingModel->smtpemail, $sitesettingModel->sitename);
	                    $message->to($userModel->email);
	                });
            	}
            	return true;
            }
            catch(\Swift_TransportException $e)
            {
            	// echo "1";
                return false;
            }

        }
    }

} // E O class
?>