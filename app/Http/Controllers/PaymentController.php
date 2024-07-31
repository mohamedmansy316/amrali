<?php

namespace App\Http\Controllers;
//use Omnipay\Common\Omnipay;
use Illuminate\Http\Request;
//use Omnipay\Omnipay as Omnipay;
use PhpParser\Node\Stmt\TryCatch;
//use App\Http\Controllers\Ominpay;
//use App\Http\Controllers\Omnipay ;
//use Omnipay\Omnipay as Omnipay;
//use  App\Http\Controllers\Ominpay;
//use App\PayPal\Omnipay;
//use Omnipay\PayPal\Services\Omnipay;
//use Ignited\LaravelOmnipay\Facades\OmnipayFacade;
use Omnipay\Omnipay;
use App\Models\Book;
use App\Models\Client;
use Config;
//use Ignited\LaravelOmnipay\Facades\Omnipay;
use Illuminate\Support\Facades\Http;
//add this on server
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
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
       $username = $request->username;
        $phone = $request->phone;
        $email = $request->email;
        $type = $request->type;
        $address = $request->address;
        $book_name = $request->book_name;
        if($request->input('action')=='paypal'){
            // return "paypal";
            $book_id = $request->book_id;
            $dp_price = Book::select('pdf', 'inside_Egypt', 'outside_Egypt')->where('id', '=', $book_id)->get();
            // return $price;
            // $book_id = $request->book_id;

            //for setting price
            if ($type == 'pdf') {
                $price = $dp_price[0]->pdf;
            } elseif ($type == 'insideEgypt') {
                $price = $dp_price[0]->inside_Egypt;
                //$price=50;
            } else {
                $price = $dp_price[0]->outside_Egypt;
            }
            $request->session()->put('book_id', $book_id);
            $request->session()->put('username', $username);
            $request->session()->put('phone', $phone);
            $request->session()->put('email', $email);
            $request->session()->put('address', $address);
            $request->session()->put('type', $type);
            $request->session()->put('book_name', $book_name);
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $price,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('error')
                ))->send();
                if ($response->isRedirect()) {
                    $response->redirect();
                } else {
                    return $response->getMessage();
                }
            } catch (\Throwable $th) {
                return $th->getMessage();
            }

        }
        else{
          //  return "paymob";
            $book_id = $request->book_id;
            $dp_price = Book::select('pdf', 'inside_Egypt', 'outside_Egypt')->where('id', '=', $book_id)->get();
            //for setting price
            if ($type == 'pdf') {
                $price = $dp_price[0]->pdf;
            } elseif ($type == 'insideEgypt') {
                $price = $dp_price[0]->inside_Egypt;
                //$price=50;
            } else {
                $price = $dp_price[0]->outside_Egypt;
            }
            $request->session()->put('book_id', $book_id);
            $request->session()->put('username', $username);
            $request->session()->put('phone', $phone);
            $request->session()->put('email', $email);
            $request->session()->put('address', $address);
            $request->session()->put('type', $type);
            $request->session()->put('book_name', $book_name);
            $request->session()->put('price', $price);
            return redirect()->route('paymob');

        }

    }
    //for success request
    public function success(Request $request)
    {
        //this is id of selected book
        // return  session('book_id');
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
                $book_id = session('book_id');
                //for insert data in client table
                $username = session('username');
                $phone = session('phone');
                $email = session('email');
                $address = session('address');
                $type = session('type');
                $book_name = session('book_name');
                $type == 'pdf' ? $booked = 0 : $booked = 1;

                Client::create([
                    'username' => $username,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address,
                    'type' => $type,
                    'book_name' => $book_name,
                    'booked' => $booked,
                ]);
                //for type of book
                if ($type == 'pdf') {
                    //get the selected book for pdf download
                    $book = Book::findOrFail($book_id);
                    return view('books.successBookspay', compact('id', 'book'));
                } else {
                    //for hard copy book
                    return view('books.successHardcopy');
                }
            } else {
                // return $response->getMessage();
                return view('books.errorBookspay');
            }
        } else {
            // return 'Payment declined!';
            return view('books.errorBookspay');
        }
    }
    //for cancel url request
    public function error()
    {
        //  return 'User declined the payment!';
        return view('books.errorBookspay');
    }
    //buy books form
    public function buybooksform($book_id, $book_name)
    {
          // 1 authentication request
        $auth_request = Http::withHeaders(['Content-Type' => 'application/json'])->post(
            "https://accept.paymob.com/api/auth/tokens",
            [
                "api_key" => "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SndjbTltYVd4bFgzQnJJam95TURJMU5ESXNJbTVoYldVaU9pSnBibWwwYVdGc0lpd2lZMnhoYzNNaU9pSk5aWEpqYUdGdWRDSjkuenl6Tk5yc0JiZTN2c0p2Wm1xZHpYYmd1QnFrdTBhNm9PWDNBd1hwRDdwcGY4Rm1fQi0xYmhqR1I1cWRId3F4M29ISVEyckhIUmJsODJfZE8wS2hsaHc="
            ]
        );
        $result = $auth_request->getBody();
        if ($result) {
            $token = json_decode($result, true);
            $auth_token = json_encode($token['token']);
            session()->put('auth_token', $auth_token);
        }

        return view('books.buybooksform', compact('book_id', 'book_name'));
    }
    //cash on delivary form
    public function cashOnDelivaryForm($book_id, $book_name)
    {
        return view('books.cashOnDelivaryForm', compact('book_id', 'book_name'));
    }
    //cash on delivary create
    public function cashOnDelivaryCreate(Request $request)
    {
        Client::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'type' => $request->type,
            'book_name' => $request->book_name,
            'type' => 'cash on delivary',
            'booked' => 1,
        ]);
        return view('books.successCashOnDelivary');
    }


       public function paymob()
    {
        //2 order registeration api
       $auth_token = session('auth_token');
       //return  $auth_token;
       $book_id=session('book_id');
       $user_name=session('username');
       $phone=session('phone');
       $email=session('email');
       $price=(int)session('price') *1900;
       $amount_cents=(string)$price;
    $items=array(
        "name"=>session('book_name'),
        "amount_cents"=> $price,
        "description"=> "",
        "quantity"=> "1"
    );
        $name=json_encode($items['name']);
        $amount=json_encode($items['amount_cents']);
        Session::forget('auth_token');
        $order_registeration = Http::withHeaders([
            'Content-Type' => 'application/json',
            'WWW-Authenticate' => 'Bearer realm=Paymob'
        ])->post(
            "https://accept.paymob.com/api/ecommerce/orders",
            [
                "auth_token" => $auth_token,
                "delivery_needed" => "false",
                "amount_cents"=> $amount,
                "currency"=> "EGP",
                // "merchant_order_id"=>202542,
                "items"=>[
                [
                    "name"=>$name,
                    "amount_cents"=>$amount,
                    "description"=> "",
                    "quantity"=> "1"
                ]
                   ]
            ]
        );
        $result=$order_registeration->getBody();
        if($result){
           $order =json_decode($result, true);
        //   //return  $order;
        //   $order_id= json_encode($order['id']);
        //   $order_email=json_encode($email);
        //   $order_first_name=json_encode($user_name);
        //   $order_phone=json_encode($phone);

           $order_id= $order['id'];
          $order_email=$email;
          $order_first_name=$user_name;
          $order_phone=$phone;

           //3-payment key request
           $payment_key = Http::withHeaders([
            'Content-Type' => 'application/json',
            'WWW-Authenticate' => 'Bearer realm=Paymob'
        ])->post(
            "https://accept.paymob.com/api/acceptance/payment_keys",
            [
                "auth_token" => $auth_token,
                "amount_cents"=> $amount,
                "order_id"=> $order_id,
                "billing_data"=>[
                    "apartment"=> "NA",
                    "email"=>$order_email,
                    "floor"=> "NA",
                    "first_name"=> $order_first_name,
                    "street"=> "NA",
                    "building"=> "NA",
                    "phone_number"=> $order_phone,
                    "shipping_method"=> "NA",
                    "postal_code"=> "NA",
                    "city"=> "NA",
                    "country"=> "NA",
                    "last_name"=> $order_first_name,
                    "state"=> "NA"
                ],
                   "currency"=> "EGP",
                   "integration_id"=> 2219285,
                   "lock_order_when_paid"=> "false"
            ]
        );

        //old "integration_id"=> 2219285,
      $payment_token=json_decode($payment_key->getBody(),true);
      $order_token= json_encode($payment_token['token']);
       $payment_url='https://accept.paymob.com/api/acceptance/iframes/400603?payment_token='.$payment_token['token'];
        return Redirect()->to($payment_url);

        }

    }

       public function callback(Request $request){
     $data=$request->all();
     //dd($data);
     ksort($data);
     //dd($data);
     $hmac=$data['hmac'];
     //return $hmac;
     $array=[
       'amount_cents',
       'created_at',
       'currency',
       'error_occured',
       'has_parent_transaction',
       'id',
       'integration_id',
       'is_3d_secure',
       'is_auth',
       'is_capture',
       'is_refunded',
       'is_standalone_payment',
       'is_voided',
       'order.id',
       'owner',
       'pending',
       'source_data.pan',
       'source_data.sub_type',
       'source_data.type',
       'success',
     ];
     $connectedString='';
     foreach($data as $key =>$element)
     {
        if(in_array($key,$array)){
        $connectedString.=$element;
        }
     }
     //return $connectedString;
    //return $data;
     $secret="BFD108F7CDF2AF382EFF77B0DE39C635";
     $hashed=hash_hmac('SHA512',$connectedString,$secret);
    // return $hashed;
     if($hashed==$hmac)
     {
       // echo 'secure';
         $id = $data['id'];
                $book_id = session('book_id');
                //for insert data in client table
                $username = session('username');
                $phone = session('phone');
                $email = session('email');
                $address = session('address');
                $type = session('type');
                $book_name = session('book_name');
                $type == 'pdf' ? $booked = 0 : $booked = 1;

                Client::create([
                    'username' => $username,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address,
                    'type' => $type,
                    'book_name' => $book_name,
                    'booked' => $booked,
                ]);
                //for type of book
                if ($type == 'pdf') {
                    //get the selected book for pdf download
                    $book = Book::findOrFail($book_id);
                    return view('books.successBookspay', compact('id', 'book'));
                } else {
                    //for hard copy book
                    return view('books.successHardcopy');
                }
    }
     else{
       // echo 'not secure book';
         $id = $data['id'];
                $book_id = session('book_id');
                //for insert data in client table
                $username = session('username');
                $phone = session('phone');
                $email = session('email');
                $address = session('address');
                $type = session('type');
                $book_name = session('book_name');
                $type == 'pdf' ? $booked = 0 : $booked = 1;

                Client::create([
                    'username' => $username,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address,
                    'type' => $type,
                    'book_name' => $book_name,
                    'booked' => $booked,
                ]);
                //for type of book
                if ($type == 'pdf') {
                    //get the selected book for pdf download
                    $book = Book::findOrFail($book_id);
                    return view('books.successBookspay', compact('id', 'book'));
                } else {
                    //for hard copy book
                    return view('books.successHardcopy');
                }
     }
      //return $book_id = session('book_id');


    }

}
