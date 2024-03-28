<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sitesettings;
use App\Models\Admin;
use App\Models\Enquiry;
use App\Models\Enquirydates;
use App\Classes\MyClass;
use DB;
use URL;
use Session;

class AdminController extends Controller
{
	public function index()
    {
		if (session()->get('user_type') != '0') {
			return Redirect::to('/admin/upcoming_appointment');
		}
    	$get_enquiry = Enquiry::where('status','0')
						->orWhere('status','1')
						->orderBy('created_on','DESC')->paginate(10);
    	return view('admin.index',['get_all_enquiry'=>$get_enquiry]);
    }
	public function confirmlist()
    {
		if (session()->get('user_type') != '0') {
			return Redirect::to('/admin/upcoming_appointment');
		}
    	$get_enquiry = Enquiry::where('status','2')
						->orderBy('created_on','DESC')->paginate(10);
    	return view('admin.confirm',['get_all_enquiry'=>$get_enquiry]);
    }
	public function approvelist()
    {
		if (session()->get('user_type') != '0') {
			return Redirect::to('/admin/upcoming_appointment');
		}
    	$get_enquiry = Enquiry::where('status','3')
						->orderBy('created_on','DESC')->paginate(10);
    	return view('admin.approve',['get_all_enquiry'=>$get_enquiry]);
    }
    public function adminlogin()
    {
    	$get_settings = Sitesettings::find(1);
    	return view('login.login',[
    		"settings"=>$get_settings,
    	]);
    }
    public function logout(Request $request) 
	{
    	session()->flush();
        return redirect('/adminlogin');
    }
    public function authenticate_admin(Request $request) 
    {
    	$email = $request->email;
    	$password = $request->password;

    	$get_admin = Admin::where('email',$email)
    					->where('password',$password)
    					->where('status','0')->first();
    	if (!empty($get_admin)) {
    		session()->put('user_type', $get_admin->role);
    		session()->put('user_id', $get_admin->id);
    		session()->put('user_name', $get_admin->name);
    		session()->put('user_email', $get_admin->email);
			if ($get_admin->role == '0') {
				return Redirect::to('/admin');
			}
			else {
				return Redirect::to('/admin/upcoming_appointment');
			}
    		
    	}
    	else {
    		Session::flash('login_message', 'Invalid credentials!'); 
    		return Redirect::to('/adminlogin');
    	}
    }
	public function add_enquiry_optional_dates(Request $request)
	{
		// print_r($_POST);
		$dates = explode(',',$request->dates);
		$enq_fees = $request->enquiry_fees;
		$enquiry_id = $request->enquiry_id;
		$myClass = new MyClass();
		$sitesettings = Sitesettings::find(1);
		foreach ($dates as $key => $value) {
			$date_format = date('Y-m-d',strtotime($value));
			$enquirydate = new Enquirydates;
			$enquirydate->enquiry_id = $enquiry_id;
			$enquirydate->date = $date_format;
			$enquirydate->save();
		}
		$get_enq = Enquiry::where('enquiry_id',$enquiry_id)->first();

		$update_stu = Enquiry::where('enquiry_id',$enquiry_id)
					->update([
						'fees' =>  $enq_fees,
						'updated_on' => date('Y-m-d H:i:s'),
						'status' => 1
					]);
		
		$subject = $sitesettings->sitename.' - Your Appointment reviewed';
		$siteUrl = URL::to('/');
		$send_email = $myClass->anySendmail( 'sendconfirmation','emails.confirm_enquiry',$subject,$get_enq,null,$siteUrl );
		if($send_email) {
			Session::flash('enq_message', 'Enquiry updated successfully'); 
    		return Redirect::to('/admin');
		}
		else {
			Session::flash('enq_message', 'Failed to update Enquiry'); 
    		return Redirect::to('/admin');
		}	
	}
	public function adminsettings_page() 
	{
		if (session()->get('user_type') != '0') {
			return Redirect::to('/admin/upcoming_appointment');
		}
		$get_settings = Sitesettings::find(1);
		return view('admin.settings',[
    		"settings"=>$get_settings,
    	]);
	}
	public function update_settings(Request $request)
	{
		$site_name = $request->site_name;
		$default_fees = $request->default_fees;
		$smtp_port = $request->smtp_port;
		$smtp_host = $request->smtp_host;
		$smtp_email = $request->smtp_email;
		$smtp_password = $request->smtp_password;
		$str_pub = $request->str_pub;
		$str_pri = $request->str_pri;
		$raz_pub = $request->raz_pub;
		$raz_pri = $request->raz_pri;

		$stripe_json['Stripe_Public_Key'] = $str_pub;
		$stripe_json['Stripe_Private_Id'] = $str_pri;

		$razor_json['razorPublicKey'] = $raz_pub;
		$razor_json['razorPrivateKey'] = $raz_pri;

		$sett = Sitesettings::find(1);
		$sett->sitename = $site_name;
		$sett->default_fees = $default_fees;
		$sett->smtpport = $smtp_port;
		$sett->smtphost = $smtp_host;
		$sett->smtpemail = $smtp_email;
		$sett->smtppassword = $smtp_password;
		$sett->stripe_keys = json_encode($stripe_json);
		$sett->razor_keys = json_encode($razor_json);

		if ($sett->save()) {
			Session::flash('enq_message', 'Settings updated successfully'); 
    		return Redirect::to('/admin/settings');
		}
		else {
			Session::flash('enq_message', 'Settings failed to update'); 
    		return Redirect::to('/admin/settings');
		}
	}
	public function update_status(Request $request)
	{
		$confirm_enq_id = $request->confirm_enq_id;
		$confirm_status = $request->confirm_status;
		$update_enq = Enquiry::where('enquiry_id',$confirm_enq_id)
					->update([
						'updated_on' => date('Y-m-d H:i:s'),
						'status' => $confirm_status
					]);
		if ($update_enq) {
			Session::flash('enq_message', 'Enquiry updated successfully'); 
			if ($confirm_status == '3') {
				return Redirect::to('/admin/approvelist');
			}
			else {
				return Redirect::to('/admin');
			}
    		
		}
		else {
			Session::flash('enq_message', 'Failed to update Enquiry'); 
    		return Redirect::to('/admin');
		}
	}
	public function upcoming_appointment()
	{
		if (session()->get('user_type') != '1') {
			return Redirect::to('/admin');
		}
		$curr_date = date('Y-m-d');
		$get_enquiry = Enquiry::where('status','3')
						->where('allocated_date', '>=', $curr_date)
						->orderBy('updated_on','DESC')->paginate(10);
    	return view('doctor.upcomingenq',['get_all_enquiry'=>$get_enquiry]);
	}
	public function completed_appointment()
	{
		if (session()->get('user_type') != '1') {
			return Redirect::to('/admin');
		}
		$curr_date = date('Y-m-d H:i:s');
		$get_enquiry = Enquiry::where('status','3')
						->where('allocated_date', '<', $curr_date)
						->orderBy('updated_on','DESC')->paginate(10);
    	return view('doctor.completedenq',['get_all_enquiry'=>$get_enquiry]);
	}
	public function add_notes(Request $request)
	{
		$enq_id = $request->enq_id;
		$get_enq = Enquiry::where('enquiry_id',$enq_id)->first();
		if (!empty($get_enq)) {
			echo $get_enq->notes;
		}
	}
	public function save_notes(Request $request)
	{
		$notes = $request->notes;
		$enq_id = $request->notes_enq_id;

		$update_enq = Enquiry::where('enquiry_id',$enq_id)
					->update([
						'updated_on' => date('Y-m-d H:i:s'),
						'notes' => $notes
					]);
		if ($update_enq) {
			Session::flash('enq_message', 'Notes updated successfully'); 
    		return redirect()->back(); 
		}
		else {
			Session::flash('enq_message', 'Failed to update Notes'); 
    		return redirect()->back(); 
		}
	}
	public function view_enquiry($id)
	{
		$dec_id = base64_decode($id);
		$get_enq = Enquiry::where('enquiry_id',$dec_id)->first();
		if (empty($get_enq)) {
			return redirect()->back(); 
		}
		return view('admin.enq_view',['get_enq'=>$get_enq]);
	}
}