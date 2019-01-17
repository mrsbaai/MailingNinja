<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public function getPrice($code){

    }

    public function getMerchant($code){

    }


    public function RedirectToPayment(){

        $business =  Input::get('toemail');
        $amount = Input::get('amount');
        $item_name = "$" . $amount . " Balance TopUp";
        $custom = "internal";
        $domain = "http://premiumbooks.net/";

        $cmd = '_xclick';
        $currency_code = 'USD';
        $return = $domain;
        $notify_url = $domain. '/ipn/paypal';
        $cancel_return = $domain;
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

        $paypalAccounts = paypalids::where('is_active', '=' ,true)->where('is_disposable', '=' ,false)->where('balance', '>=' ,0)->get();

        $logs = paymentlog::where('type', '=' ,"new_case")->where('created_at', '>', $earlier)->get();


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
        $selected_paypal_account_id = paypalids::where('email', $acceptable_accounts[0])->first();
        return $selected_paypal_account_id['paypalid'];


    }






    public function paypalIPN(){

        $ipn = new PaypalIPN();


        $verified = $ipn->verifyIPN();

        if ($verified) {

            $payedAmount = $originalAmount = $code = $transactionType = $transactionStatus = $userEmail = $buyerEmail = $accountId = $paymentSystem = $txn_id = "";

            if (isset($_POST["custom"])){$description = $_POST["custom"];}else{$description = "";}


            if (isset($_POST["mc_fee"])){$mc_fee = $_POST["mc_fee"];}else{$mc_fee = "0";}
            if (isset($_POST["mc_gross"])){$payedAmount = $_POST["mc_gross"];}else{$payedAmount = "";}
            if (isset($_POST["txn_type"])){$transactionType = $_POST["txn_type"];}else{$transactionType = "";}
            if (isset($_POST["payment_status"])){$transactionStatus = $_POST["payment_status"];}else{$transactionStatus = "";}
            if (isset($_POST["payer_email"])){$buyerEmail = $_POST["payer_email"];}else{$buyerEmail = "";}
            if (isset($_POST["business"])){$accountId = $_POST["business"];}else{$accountId = "";}
            if (isset($_POST["payment_status"])){$payment_status = $_POST["payment_status"];}else{$payment_status = "";}
            if (isset($_POST["payment_type"])){$payment_type = $_POST["payment_type"];}else{$payment_type = "";}
            if (isset($_POST["pending_reason"])){$pending_reason = $_POST["pending_reason"];}else{$pending_reason = "";}

            if (isset($_POST["txn_id"])){$txn_id = $_POST["txn_id"];}else{$txn_id = null;}

            $checkLog = paymentlog::where('operation_id', $txn_id)->first();
            if ($checkLog !== null) {
                Log::error("PayPal operation: $txn_id Already exist");
                return;
            }



            if ($description == "SMS-Verification"){
                $originalAmount = $payedAmount;
                $userEmail = $buyerEmail;
                $code = "SMS-Verification";
            }else{


                if ($description != "internal"){


                    $originalAmount = $this->getDescriptionVariables("originalAmount",$description);
                    $userEmail = $this->getDescriptionVariables("userEmail",$description);
                    $code = $this->getDescriptionVariables("code",$description);

                    if(!$this->valid_email($userEmail)) {
                        Log::error("User email: $userEmail Not Valid");
                        return;
                    }

                }


                $toPaypalId = paypalids::where('email',$accountId)->first();
                $fromPaypalId =  paypalids::where('email',$buyerEmail)->first();


                if (!$fromPaypalId and $description != "SMS-Verification" and $description != "" and $description != "internal"){
                    if (($payment_status == 'Completed') || ($payment_status == 'Pending' && $payment_type == 'instant' && $pending_reason == 'paymentreview')){
                        // successful payment -> top up
                        if ($description != "internal" and $description != ""){
                            $this->doTopup($userEmail,$payedAmount,$originalAmount,$code, "PayPal", $txn_id);
                        }


                    }
                }


            }



            // loging the event
            $amountNoFee = $payedAmount;
            if ($payedAmount > 0){
                $payedAmount = $payedAmount - $mc_fee;
            }

            $this->log($payedAmount, $originalAmount, $code, $transactionType, $transactionStatus, $userEmail, $buyerEmail, $accountId, "PayPal",$txn_id);

            // Update balance

            $oldBalance = $newBalance = $senderOldBalance = $senderNewBalance = "";

            if ($transactionStatus == "Completed" or $transactionStatus == "Reversed" or $transactionStatus == "Canceled_Reversal"){
                $oldBalance = $toPaypalId['balance'];
                $newBalance = $oldBalance + $payedAmount;
                paypalids::where('email', "=", $accountId)->update(['balance' => $newBalance]);

                if ($fromPaypalId){
                    $senderOldBalance = $fromPaypalId['balance'];
                    $senderNewBalance = $senderOldBalance - $amountNoFee;
                    paypalids::where('email', "=", $buyerEmail)->update(['balance' => $senderNewBalance]);
                }

            }

            // notify
            $this->notify($oldBalance, $newBalance, "PayPal", $transactionType, $transactionStatus, $buyerEmail, $accountId, $payedAmount, $code, $senderOldBalance, $senderNewBalance);


        }
        header("HTTP/1.1 200 OK");
    }


    Private function log($invoice_id, $operation_id,$merchant_email,$net_amount, $type, $status){



        // get from costumer products table $invoice_id = id

        $publisher_id = "";
        $offer_id = "";
        $costumer_id = "";
        $costume_price = "";
        // get this
        $default_price = "";
        $costumer_email= "";
        $is_refund = "";



            $log = array(
                "publisher_id"=>$publisher_id,
                "offer_id"=>$offer_id,
                "operation_id"=>$operation_id,
                "costumer_id"=>$costumer_id,
                "merchant_email"=>$merchant_email,
                "net_amount"=>$net_amount,
                "costume_price"=>$costume_price,
                "default_price"=>$default_price,
                "type"=>$type,
                "status"=>$status,
                "is_refund"=>$is_refund,
                "costumer_email"=>$costumer_email,
                "created_at"=>Carbon::now()
            );

            DB::table('sell_log')->insert($log);


    }
}
