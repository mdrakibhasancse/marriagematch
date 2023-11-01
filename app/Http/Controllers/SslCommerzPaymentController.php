<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Carbon\Carbon;
use App\Model\Order;
use GuzzleHttp\Client;
use App\Model\OrderPayment;
use App\Model\ProductSku;
use App\Mail\OrderconfirmMail;
use Illuminate\Http\Request;
use App\Model\BalanceTransaction;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\User;
use Cp\Membership\Models\MembershipOrderPayment;
use Cp\Membership\Models\MembershipPackageOrder;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('membership_package_orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function payViaAjax(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        // return   $post_data;


        #Before  going to initiate the payment order status need to update as Pending.

        $order = MembershipPackageOrder::where('id', $request->order)->where('payment_status', 'unpaid')->where('order_status', 'pending')->first();


        if ($order) {
            $order->transaction_id = $post_data['tran_id'];
            $order->save();
            $post_data['total_amount'] = $order->final_price;
            $post_data['cus_phone'] = preg_replace('/^\+?88|\|88|\D/', '', ($order->user->mobile));
        }


        $sslc = new SslCommerzNotification();


        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        // return  $payment_options;

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        // dd($request->all());
        // echo "Transaction is Successful";

        //         "tran_id" => "64f3180307789"
        //   "val_id" => "2309021717113oXJ6fT3VIRlhFr"
        //   "amount" => "6000.00"
        //   "card_type" => "NAGAD-Nagad"
        //   "store_amount" => "5850.00"
        //   "card_no" => null
        //   "bank_tran_id" => "2309021717110PKVvzhMlnPKW6a"
        //   "status" => "VALID"
        //   "tran_date" => "2023-09-02 17:17:11"
        //   "error" => null
        //   "currency" => "BDT"
        //   "card_issuer" => "Nagad"
        //   "card_brand" => "MOBILEBANKING"
        //   "card_sub_brand" => "Classic"
        //   "card_issuer_country" => "Bangladesh"
        //   "card_issuer_country_code" => "BD"
        //   "store_id" => "marri64f2d2777eb9d"
        //   "verify_sign" => "e197f2480afa3b14b1fe1578d1c753b1"
        //   "verify_key" => "amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d ◀amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,curr ▶"
        //   "verify_sign_sha2" => "c71f8a0f05854cc4e5fdef69c388e20784c53e2c0f927532a664d241878c95bc"
        //   "currency_type" => null
        //   "currency_amount" => null
        //   "currency_rate" => null
        //   "base_fair" => null
        //   "value_a" => null
        //   "value_b" => null
        //   "value_c" => null
        //   "value_d" => null
        //   "subscription_id" => null
        //   "risk_level" => "0"
        //   "risk_title" => "Safe"

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        $currency = $request->input('currency');
        $order_detials = MembershipPackageOrder::where('transaction_id', $tran_id)->first();


        $sslc = new SslCommerzNotification();


        if ($order_detials->order_status == 'pending') {


            // $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            // if ($validation == TRUE) {


            /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */

            $order =  MembershipPackageOrder::where('transaction_id', $tran_id)->first();;
            if ($order) {
                $order->order_status = 'delivered';
                $order->payment_status = 'paid';
                $order->paid_amount = $amount;
                $order->save();

                $payment =  new MembershipOrderPayment();
                $payment->payment_date = date('Y-m-d');
                $payment->order_id = $order->id;
                $payment->user_id = $order->user_id;
                $payment->package_id = $order->membership_package_id;
                $payment->payment_method = 'sslcommerz';
                // $payment->payment_type = 'online';
                $payment->payment_status = 'paid';
                $payment->note = $order->transaction_id;
                $payment->paid_amount = $order->paid_amount;
                // $payment->receivedby_id = null;
                $payment->addedby_id = $order->user_id;
                $payment->editedby_id = null;
                $payment->save();



                $user = User::find($order->user_id);
                $up  = $user->profile;
                $up->package_id = $order->membership_package_id;
                $up->duration = $up->duration + $order->duration;

                $up->daily_contact_limit = $up->daily_contact_limit + $order->daily_contact_limit;

                $up->total_contact_limit = $up->total_contact_limit + $order->total_contact_limit;

                $up->daily_cv_collect_limit = $up->daily_cv_collect_limit + $order->daily_cv_collect_limit;

                $up->total_cv_collect_limit = $up->total_cv_collect_limit + $order->total_cv_collect_limit;

                $up->daily_proposal_sent = $up->daily_proposal_sent + $order->daily_proposal_sent;

                $up->total_proposal_sent = $up->total_proposal_sent + $order->total_proposal_sent;

                $up->daily_matched_profile_sent = $up->daily_matched_profile_sent + $order->daily_matched_profile_sent;

                $up->total_matched_profile_sent = $up->total_matched_profile_sent + $order->total_matched_profile_sent;
                $up->save();


                // if (!$order->mobile == null) {
                //     $m = $order->mobile;
                //     $total = number_format($order->grand_total, 0);
                //     $to = bdMobile($m);
                //     if (strlen($to) != 13) {
                //         return true;
                //     }
                //     $projectName = env('PROJECT_NAME');
                //     $msg = urlencode("Your #{$order->invoice_number} Order Is Success In {$projectName} Total Cost Is BDT {$total}"); //150 characters allowed here

                //     $url = smsUrl($to, $msg);

                //     $client = new Client();

                //     try {
                //         $r = $client->request('GET', $url);
                //     } catch (\GuzzleHttp\Exception\ConnectException $e) {
                //     } catch (\GuzzleHttp\Exception\ClientException $e) {
                //     }
                // }

                // Mail And SMS Notification End";



                $user->orderPaidEmailToUserSent($order);


                $admins = User::whereHas('roles', function ($q) {
                        $q->where('name', 'admin');
                })->where('active', 1)->get();

                foreach ($admins as $admin) {
                    $admin->orderPaidEmailToAdminSent($order);
                }
                    

                toast('Your payment successfully completed. Thank you for being with us.', 'success');
                return redirect()->route('membership.myOrders', $order->user_id);
            }
            // } else {

            //     echo "validation Fail";

            //     return redirect()->route('user.dashboard')->with('info', 'Sorry, Payment gateway validation failed');
            // }
        } else if ($order_detials->order_status == 'delivered') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            // echo "Transaction is successfully Completed";

            toast('Your transaction is successfully completed.', 'success');
            return redirect()->route('userrole.dashboard');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            // echo "Invalid Transaction";
            toast('Sorry, Invalid Transaction.', 'warning');
            return redirect()->route('userrole.dashboard');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order = MembershipPackageOrder::where('transaction_id', $tran_id)->first();
        $order->transaction_id = null;
        $order->save();
        toast('Sorry, Transaction is failed.', 'warning');
        return redirect()->route('membership.myOrders', $order->user_id);
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order = MembershipPackageOrder::where('transaction_id', $tran_id)->first();
        $order->transaction_id = null;
        $order->save();
        toast('Your Transaction is Cancelled.', 'warning');
        return redirect()->route('membership.myOrders', $order->user_id);
    }

    public function ipn(Request $request)
    {


        #Received all the payement information from the gateway
        // if ($request->input('tran_id')) #Check transation id is posted or not.
        // {

        //     $tran_id = $request->input('tran_id');

        //     #Check order status in order tabel against the transaction id or order id.
        //     $order_details = MembershipPackageOrder::where('transaction_id', $tran_id)->first();

        //     if ($order_details->order_status == 'pending') {
        //         $sslc = new SslCommerzNotification();
        //         $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
        //         if ($validation == TRUE) {
        //             /*
        //             That means IPN worked. Here you need to update order status
        //             in order table as Processing or Complete.
        //             Here you can also sent sms or email for successful transaction to customer
        //             */
        //             // $update_product = DB::table('orders')
        //             //     ->where('transaction_id', $tran_id)
        //             //     ->update(['status' => 'Processing']);

        //             // echo "Transaction is successfully Completed";


        //             $order = MembershipPackageOrder::where('transaction_id', $tran_id)->first();
        //             if ($order) {
        //                 $order->order_status = 'delivered';
        //                 $order->payment_status = 'paid';
        //                 $order->paid_amount = $amount;
        //                 $order->save();



        //                 $payment =  new MembershipOrderPayment();
        //                 $payment->payment_date = date('Y-m-d');
        //                 $payment->order_id = $order->id;
        //                 $payment->user_id = $order->user_id;
        //                 $payment->payment_method = 'sslcommerz';
        //                 // $payment->payment_type = 'online';
        //                 $payment->payment_status = 'paid';
        //                 $payment->note = $order->transaction_id;
        //                 $payment->paid_amount = $order->paid_amount;
        //                 // $payment->receivedby_id = null;
        //                 $payment->addedby_id = $order->user_id;
        //                 $payment->editedby_id = null;
        //                 $payment->save();

        //                 toast('Your payment successfully completed. Thank you for being with us..', 'success');
        //                 return redirect()->route('user.myOrders', $order->user_id);
        //             }
        //         } else {
        //             toast('Gateway validation failed.', 'warning');
        //             return redirect()->route('userrole.dashboard');
        //         }
        //     } else if ($order_details->status == 'delivered') {

        //         toast('Your transaction is successfully completed.', 'success');
        //         return redirect()->route('userrole.dashboard');
        //     } else {

        //         toast('Sorry, Invalid Transaction.', 'warning');
        //         return redirect()->route('userrole.dashboard');
        //     }
        // } else {
        //     toast('Sorry, Invalid Data.', 'warning');
        //     return redirect()->route('userrole.dashboard');
        // }
    }
}