<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Session_client;
use App\Models\Session;
use Illuminate\Support\Facades\Http;

class PaymentSessionController extends Controller
{
    //
    private $gateway;
    //public $book_id;
    public function __construct()
    {
        //$Omnipay = new Omnipay;
        // $this->book_id;
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(false);
    }
    public function pay(Request $request)
    {
        // Retrieve session details
        $session = Session::find($request->session_type);
        if (!$session) {
            return back()->withErrors(['error' => 'Invalid session type selected.']);
        }

        // Retrieve input data
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $type = $request->type;
        $session_time = $request->session_time;

        // Determine price based on type
        $price = ($type === 'online') ? $session->price_online : $session->price_offline;

        // Store data in session
        $request->session()->put([
            'session_id' => $session->id,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'type' => $type,
            'session_type' => $session->session_type,
            'session_time' => $session_time,
            'price' => $price,
        ]);

        // Handle payment action
        if ($request->input('action') === 'paypal') {
            // PayPal payment
            try {
                $response = $this->gateway->purchase([
                    'amount' => $price,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('successSession'),
                    'cancelUrl' => url('errorSession'),
                ])->send();

                if ($response->isRedirect()) {
                    $response->redirect();
                } else {
                    return back()->withErrors(['error' => $response->getMessage()]);
                }
            } catch (\Throwable $th) {
                return back()->withErrors(['error' => 'An error occurred: ' . $th->getMessage()]);
            }
        } else {
            // Paymob payment
            return redirect()->route('paymobSession');
        }
    }

    //for success request
    public function successSession(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));
            $response = $transaction->send();
            //for success pay
            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $id = $arr['id'];

                //          return "done";
                //    $course_id=session('course_id');
                // //   //for insert data in client table
                $name = session('name');
                $phone = session('phone');
                $email = session('email');
                $type = session('type');
                $session_type = session('session_type');
                $session_time = session('session_time');
                Session_client::create([
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'type' => $type,
                    'session_type' => $session_type,
                    'session_time' => $session_time,
                ]);
                return view('sessions.successSessionPay');
            } else {
                return view('sessions.errorSessionPay');
            }
        } else {
            return view('sessions.errorSessionPay');
        }
    }
    //for cancel url request
    public function errorSession()
    {
        return view('sessions.errorSessionPay');
    }
    //for paymob
    public function paymobSession()
    {
        // Retrieve session data
        $auth_token = session('auth_token');
        $session_id = session('session_id');
        $user_name = session('name');
        $phone = session('phone');
        $email = session('email');
        $session_type = session('session_type');
        $price = (int)session('price') * 100; // Ensure price is in cents
        $amount_cents = (string)$price;

        // Prepare items array
        $items = [
            [
                "name" => $session_type,
                "amount_cents" => $price,
                "description" => "",
                "quantity" => "1"
            ]
        ];

        // Order registration API request
        $order_response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $auth_token" // Updated header for authorization
        ])->post(
            "https://accept.paymob.com/api/ecommerce/orders",
            [
                "auth_token" => $auth_token,
                "delivery_needed" => "false",
                "amount_cents" => $amount_cents,
                "currency" => "EGP",
                "items" => $items
            ]
        );

        // Handle order registration response
        if ($order_response->successful()) {
            $order = $order_response->json();
            $order_id = $order['id'];

            // Payment key request
            $payment_key_response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $auth_token" // Updated header for authorization
            ])->post(
                "https://accept.paymob.com/api/acceptance/payment_keys",
                [
                    "auth_token" => $auth_token,
                    "amount_cents" => $amount_cents,
                    "order_id" => $order_id,
                    "billing_data" => [
                        "apartment" => "NA",
                        "email" => $email,
                        "floor" => "NA",
                        "first_name" => $user_name,
                        "street" => "NA",
                        "building" => "NA",
                        "phone_number" => $phone,
                        "shipping_method" => "NA",
                        "postal_code" => "NA",
                        "city" => "NA",
                        "country" => "NA",
                        "last_name" => $user_name,
                        "state" => "NA"
                    ],
                    "currency" => "EGP",
                    "integration_id" => 2219285, // Store integration_id in .env file
                    "lock_order_when_paid" => "false"
                ]
            );

            // Handle payment key response
            if ($payment_key_response->successful()) {
                $payment_token = $payment_key_response->json();
                $payment_url = 'https://accept.paymob.com/api/acceptance/iframes/400603?payment_token=' . $payment_token['token'];
                return redirect()->to($payment_url);
            } else {
                return back()->withErrors(['error' => 'Unable to retrieve payment key.']);
            }
        } else {
            return back()->withErrors(['error' => 'Unable to register order.']);
        }
    }

    public function callbacksession(Request $request){
        // dd($request->all());
        // return session('session_type');
        $data = $request->all();
        if ($data) {

            //          return "done";
            //    $course_id=session('course_id');
            // //   //for insert data in client table
            $name = session('name');
            $phone = session('phone');
            $email = session('email');
            $type = session('type');
            $session_type = session('session_type');
            $session_time = session('session_time');
            Session_client::create([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'type' => $type,
                'session_type' => $session_type,
                'session_time' => $session_time,
            ]);
            return view('sessions.successSessionPay');
        } else {
            return view('sessions.errorSessionPay');
        }
    }
}
