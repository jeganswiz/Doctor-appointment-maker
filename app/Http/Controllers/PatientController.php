<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sitesettings;
use App\Models\Admin;
use App\Models\Enquiry;
use App\Models\Enquirydates;
use DB;
use Session;
use URL;

class PatientController extends Controller
{
    public function index()
    {
        $sitesettings = Sitesettings::find(1);
    	return view('patient.index',['settings'=>$sitesettings]);
    }
    public function add_enquiry(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $message = $request->message;
        $datetime = date('Y-m-d H:i:s');

        $enquiry = new Enquiry;
        $enquiry->name = $name;
        $enquiry->email = $email;
        $enquiry->phone = $phone;
        $enquiry->description = $message;
        $enquiry->created_on = $datetime;
        
        if ($enquiry->save()) {
    		
            Session::flash('enquiry_message', "Enquiry added, we'll reach you soon"); 
            Session::flash('enquiry_alert', "alert-success"); 
    		return Redirect::to('/');
    	}
    	else {
    		Session::flash('enquiry_message', 'Sorry, Enquiry not added, Try again'); 
            Session::flash('enquiry_alert', "alert-danger"); 
    		return Redirect::to('/');
    	}
    }
    public function confirm_appointment($id) 
    {
        $dec_id = base64_decode($id);
        $get_enq = Enquiry::where('enquiry_id',$dec_id)->first();
        if (empty($get_enq)) {
            return redirect()->back(); 
        }
        $get_enq_dates = Enquirydates::where('enquiry_id',$dec_id)->orderBy('date','ASC')->get();
        // print_r($get_enq_dates);die;
        return view('patient.confirm_appointment',['enq_info'=>$get_enq,'enq_date_info'=>$get_enq_dates ]);
    }
    public function get_stripe_payment_url(Request $request)
    {
        $enquiry_id = $request->enquiry_id;
        $chosen_date = $request->chosen_date;
        $chosen_slot = $request->chosen_slot;

        $get_enq = Enquiry::where('enquiry_id',$enquiry_id)->first();
        $amount = $get_enq->fees * 100;
        $get_sett = Sitesettings::find(1);
        $stripe_key = json_decode($get_sett->stripe_keys);
        $succ_url = URL::to('/').'/stripe_payment_updated/{CHECKOUT_SESSION_ID}';
        $cancel_url = URL::to('/').'/confirm_appointment/'.base64_encode($enquiry_id);
        try {
        	$stripe = new \Stripe\StripeClient($stripe_key->Stripe_Private_Id);
	        $session = $stripe->checkout->sessions->create([
			  'success_url' => $succ_url,
			  'cancel_url' => $cancel_url,
			  'line_items' => [
			    [
			      'price_data' => [
			      	'currency' => 'INR',
			      	'unit_amount' => floatval($amount),
			      	'product_data' => [
			      		'name'=>'Consultancy Fees'
			      	]
			      ],
			      'quantity' => 1,
			    ],
			  ],
			  'mode' => 'payment',
			]);
			$resultarray['status'] = true;
			$resultarray['url'] = $session['url'];
			$result = json_encode($resultarray);
            session()->put('enq_id', $enquiry_id);
            session()->put('enq_date', $chosen_date);
            session()->put('enq_slot', $chosen_slot);
			echo $result;
	    } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            return '{"status":"false","message":"The transaction could not be performed because the amount paid is too low"}';
        }
        catch (\Stripe\Error\Base $e) {
	    	echo($e->getMessage()); die();
	    } catch (Exception $e) {
		  print_r($e);die();
		}
    }
    public function stripe_payment_updated($id)
    {
        $get_sett = Sitesettings::find(1);
        $stripe_key = json_decode($get_sett->stripe_keys);
        $stripe = new \Stripe\StripeClient($stripe_key->Stripe_Private_Id);
        $payment_info = $stripe->checkout->sessions->retrieve($id);
        if ((isset($payment_info) && $payment_info->payment_status == 'paid')) {
            $payment_intent = $payment_info->payment_intent;
            $enquiry_id = session()->get('enq_id');
            $chosen_date = session()->get('enq_date');
            $chosen_slot = session()->get('enq_slot');

            $update_enq = Enquiry::where('enquiry_id',$enquiry_id)
					->update([
						'allocated_date' =>  $chosen_date,
						'allocated_time' => $chosen_slot,
                        'payment_type' => 'stripe',
                        'payment_transaction_id' => $payment_intent,
                        'updated_on' => date('Y-m-d H:i:s'),
						'status' => 2
					]);
                    
            
            if ($update_enq) {
                session()->forget('enq_id');
                session()->forget('enq_date');
                session()->forget('enq_slot');
                Session::flash('enquiry_message', "Slot Booked successfully"); 
                Session::flash('enquiry_alert', "alert-success"); 
                return Redirect::to('/confirm_appointment/'.base64_encode($enquiry_id));
            }
            else {
                Session::flash('enquiry_message', "Payment failed, if payment credited from your account will be credit soon"); 
                Session::flash('enquiry_alert', "alert-success"); 
                return Redirect::to('/confirm_appointment/'.base64_encode($enquiry_id));
            }
        }
        // print_r($payment_info);
    }
    public function paystatusrazor(Request $request)
    {
        $enquiry_id = $request->enquiry_id;
        $chosen_date = $request->chosen_date;
        $chosen_slot = $request->chosen_slot;

        $get_enq = Enquiry::where('enquiry_id',$enquiry_id)->first();
        $amount = $get_enq->fees * 100;
        $get_sett = Sitesettings::find(1);
        $razor_key = json_decode($get_sett->razor_keys);
        $secretkey = $razor_key->razorPublicKey.':'.$razor_key->razorPrivateKey;
		$keyid = $razor_key->razorPublicKey; 

        $url = 'https://api.razorpay.com/v1/orders';
		$requestparams = array("amount"=>$amount,"currency"=>"INR");
		$data = json_encode($requestparams);
		//echo "<pre>"; print_r($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $secretkey);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		//'Authorization: Bearer ' . $secretkey,
		'Content-Type: application/json'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		$output = json_decode($result, true);

		//echo "<pre>"; print_r($output); die;
		if ($output['status'] == 'created'){  
			$orderid = $output['id'];
			$logo1 =  URL::to('/').'/public/front/img/dr_logo.png';

			$arr = array();
			$arr['orderid'] = $orderid;
			$arr['keyid'] = $keyid;
			$arr['currency'] = "INR";
			$arr['logo'] = $logo1;
			$arr['price'] = $amount;
			$arr['name'] = $get_enq->name;
			$arr['sitename'] = $get_sett->sitename;
			$arr['itemid'] = rand();
			$arr['custom'] = '';
			echo '{"status":"true","result":'.json_encode($arr).'}';die;
		}else{
			echo '{"status":"false", "message":"Something went wrong!"}';die;
		}


    }

    public function update_razor_payment(Request $request)
    {
        $payment_intent = $request->razorpay_payment_id;
        $enquiry_id = $request->enquiry_id;
        $chosen_date = $request->chosen_date;
        $chosen_slot = $request->chosen_slot;

        $update_enq = Enquiry::where('enquiry_id',$enquiry_id)
                ->update([
                    'allocated_date' =>  $chosen_date,
                    'allocated_time' => $chosen_slot,
                    'payment_type' => 'razorpay',
                    'payment_transaction_id' => $payment_intent,
                    'updated_on' => date('Y-m-d H:i:s'),
                    'status' => 2
                ]);
                
        
        if ($update_enq) {
            echo "1";
        }
        else {
            echo "0";
        }

    }
}