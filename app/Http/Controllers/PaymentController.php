<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Request;
use Carbon\Carbon;

use App\costumerOffers;
use App\offer;
use App\PayPal;
use App\user;
use App\sells;
use DB;
use App\Quotation;

class PaymentController extends Controller
{



    public function RedirectToPayment(Request $request, $invoice_id){

        $invoice = costumerOffers::all()->where('id',$invoice_id)->first();
        $offer = offer::all()->where('id',$invoice['offer_id'])->first();


        if ($invoice['publisher_id'] == config('app.main_publisher')){
            $business = $this->GetInternalPayPal();
        }else{
            $publisher = user::all()->where('id',$invoice['publisher_id'])->first();
            $business =  $publisher['paypal'];
        }
        $amount = $invoice['price'];
        $item_name =  "[E-Book] " . "[" . $offer['title'] . "]";
        $custom = $invoice_id;

        $return = Request::root();
        $notify_url = Request::root() . '/ipn/paypal';
        $cancel_return = Request::root();


        $cmd = '_xclick';
        $currency_code = 'USD';
        $properties = array(
            "cmd"=>$cmd,
            "business"=>$business,
            "item_name"=>$item_name,
            "currency_code"=>$currency_code,
            "custom"=>$custom,
            "amount"=>$amount,
            "return"=>$return,
            "notify_url"=>$notify_url,
            "cancel_return"=>$cancel_return
        );


        $url = "https://www.paypal.com/cgi-bin/webscr";
        return redirect()->away($url . "?" . http_build_query($properties));
    }






    private function GetInternalPayPal(){


        $earlier = Carbon::now()->subDays(25);

        $paypalAccounts = PayPal::where('is_active', '=' ,true)->where('balance', '>=' ,0)->get();

        $logs = sells::where('type', '=' ,"new_case")->where('created_at', '>', $earlier)->get();

        $ids = array();
        foreach($paypalAccounts as $paypalAccount){
            $ids[$paypalAccount['email']] = 0;
        }

        foreach($paypalAccounts as $paypalAccount){
            foreach($logs as $log){
                if ($log['accountId'] == $paypalAccount['email']){
                    $ids[$paypalAccount['email']] = $ids[$paypalAccount['email']] + 1;
                }
            }
        }


        asort($ids);


        $least_amout_of_cases = $ids[key($ids)];

        $acceptable_accounts = array();
        foreach($ids as $email => $count){
            if ($least_amout_of_cases == $count){
                array_push($acceptable_accounts, $email);
            }
        }


        //shuffle($acceptable_accounts);
        $selected_paypal_account_id = PayPal::where('email', $acceptable_accounts[0])->first();
        return $selected_paypal_account_id['email'];


    }






    public function paypalIPN(){

        $ipn = new PaypalIPN();

        $verified = $ipn->verifyIPN();

        if ($verified) {

            $originalAmount = $code = $transactionType = $transactionStatus = $userEmail = $buyerEmail = $accountId = $paymentSystem = $txn_id = "";

            if (isset($_POST["custom"])){$invoice_id = $_POST["custom"];}else{$invoice_id = "";}

            if (isset($_POST["mc_fee"])){$mc_fee = $_POST["mc_fee"];}else{$mc_fee = "0";}
            if (isset($_POST["mc_gross"])){$mc_gross = $_POST["mc_gross"];}else{$mc_gross = "";}
            if (isset($_POST["txn_type"])){$txn_type = $_POST["txn_type"];}else{$txn_type = "";}
            if (isset($_POST["payment_status"])){$payment_status = $_POST["payment_status"];}else{$payment_status = "";}
            if (isset($_POST["payer_email"])){$payer_email = $_POST["payer_email"];}else{$payer_email = "";}
            if (isset($_POST["business"])){$merchant_email = $_POST["business"];}else{$merchant_email = "";}
            if (isset($_POST["payment_status"])){$payment_status = $_POST["payment_status"];}else{$payment_status = "";}
            if (isset($_POST["payment_type"])){$payment_type = $_POST["payment_type"];}else{$payment_type = "";}
            if (isset($_POST["pending_reason"])){$pending_reason = $_POST["pending_reason"];}else{$pending_reason = "";}
            if (isset($_POST["txn_id"])){$txn_id = $_POST["txn_id"];}else{$txn_id = null;}



            if ($mc_gross > 0){
                $net_amount = $mc_gross - $mc_fee;
            }
            $checkLog = sells::where('operation_id', $txn_id)->first();
            if ($checkLog !== null) {
                Log::error("PayPal operation: $txn_id Already exist");
                return;
            }

                if (($payment_status == 'Completed') || ($payment_status == 'Pending' && $payment_type == 'instant' && $pending_reason == 'paymentreview')){
                    $inv = costumerOffers::find($invoice_id);
                    if ($inv){
                        $inv->paid = true;
                        $inv->save();

                        $user = user::all()->where('id', $inv['costumer_id'])->first();


                        $data = array(
                            'email'=>$user['email'],
                            'name'=>$user['name'],
                            'transaction_id'=>$txn_id,
                            'invoice_id'=>$invoice_id,
                            'type'=>'PayPal',
                            'amount'=>$mc_gross
                        );

                        $fire = new fireEmail();
                        $fire->fire(true, $user['email'], $data,'emails.costumerReceipt','Payment Received');

                    }
                }

            $this->log($invoice_id, $txn_id,$merchant_email,$net_amount, $txn_type, $payment_status);


        }
        header("HTTP/1.1 200 OK");
    }


    Private function log($invoice_id, $operation_id,$merchant_email,$net_amount, $type, $status){


        $invoice = costumerOffers::all()->where("id", $invoice_id)->first();

        $publisher_id = $invoice['publisher_id'];
        $offer_id = $invoice['offer_id'];
        $costumer_id = $invoice['costumer_id'];
        $costume_price = $invoice['price'];

            $log = array(
                "publisher_id"=>$publisher_id,
                "offer_id"=>$offer_id,
                "operation_id"=>$operation_id,
                "costumer_id"=>$costumer_id,
                "merchant_email"=>$merchant_email,
                "net_amount"=>$net_amount,
                "costume_price"=>$costume_price,
                "type"=>$type,
                "status"=>$status,
                "created_at"=>Carbon::now()
            );

            DB::table('sell_log')->insert($log);


    }
}
