<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Omnipay\Omnipay ;
use App\Models\Course;
use App\Models\Client;
use Config;
use Illuminate\Support\Facades\Http;
//add this on server
use Illuminate\Support\Facades\Session;
use App\Models\Book;


class PaymentCourseController extends Controller
{
    //
    private $gateway;
    //public $book_id;
    public function __construct()
    {
        //$Omnipay = new Omnipay;
       // $this->book_id;
        $this->gateway= Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(false);
    }
    public function pay(Request $request){
        if($request->input('action')=='paypal'){
            // return $request;
        $course_id=$request->course_id;
        $price=Course::select('price_online','price_offline')->where('id','=',$course_id)->get();
       // return $price[0]->price_online;
        $username=$request->username;
        $phone=$request->phone;
        $email=$request->email;
        $type=$request->type;
        $address=$request->address;
        $course_name=$request->course_name;
     //  for setting price
       if($type=='book_online'){
           $price=$price[0]->price_online;
       }
       elseif($type=='book_offline'){
           $price=$price[0]->price_offline;
       }

        $request->session()->put('course_id', $course_id);
        $request->session()->put('course_name', $course_name);
        $request->session()->put('username', $username);
        $request->session()->put('phone', $phone);
        $request->session()->put('email', $email);
        $request->session()->put('address', $address);
        $request->session()->put('type', $type);

       try {
           $response=$this->gateway->purchase(array(
               'amount'=>$price,
               'currency'=>env('PAYPAL_CURRENCY'),
               'returnUrl'=>url('successCourse'),
               'cancelUrl'=>url('errorCourse')
           ))->send();
           if ($response->isRedirect()) {
             $response->redirect();
           }
           else{
               return $response->getMessage();
           }
       } catch (\Throwable $th) {
         return $th->getMessage();
       }

        }
        else{
            //paymob
              //  return "paymob";
              $course_id=$request->course_id;
              $username=$request->username;
              $phone=$request->phone;
              $email=$request->email;
              $type=$request->type;
              $address=$request->address;
              $course_name=$request->course_name;
              $price=Course::select('price_online','price_offline')->where('id','=',$course_id)->get();
              //for setting price
              if($type=='book_online'){
                $price=$price[0]->price_online;
            }
            elseif($type=='book_offline'){
                $price=$price[0]->price_offline;
            }
            $request->session()->put('course_id', $course_id);
            $request->session()->put('course_name', $course_name);
            $request->session()->put('username', $username);
            $request->session()->put('phone', $phone);
            $request->session()->put('email', $email);
            $request->session()->put('address', $address);
            $request->session()->put('type', $type);
            $request->session()->put('price', $price);
            return redirect()->route('paymobCourse');

        }

     }
     //for success request
     public function successCourse(Request $request){
         //this is id of selected book
       // return  session('book_id');
     if ($request->input('paymentId')&&$request->input('PayerID') ) {
      $transaction=$this->gateway->completePurchase(  array(
          'payer_id'=>$request->input('PayerID'),
          'transactionReference'=>$request->input('paymentId')
      ));
      $response=$transaction->send();
        //for success pay
      if( $response->isSuccessful() ){
          $arr=$response->getData();
          $id=$arr['id'];
          //return view('courses.successCoursepay');
          return "done";
           $course_id=session('course_id');
        //   //for insert data in client table
           $username=session('username');
           $phone=session('phone');
           $email=session('email');
           $address=session('address');
           $type=session('type');
           $course_name=session('course_name');
           $type=='book_online'? $booked=0:$booked=1;

          Client::create([
             'username' => $username,
             'phone' => $phone,
             'email'=>$email,
             'address'=>$address,
             'type'=>$type,
             'book_name'=>$course_name,
             'booked'=>$booked,
         ]);
        //  //for type of course
         if($type=='book_online'){
          //get the selected course download
          $course= Course::findOrFail($course_id);
          return view('courses.successCoursepay',compact('id','course'));
         }
         else{
             //for offline course book
             return view('courses.successCourseOffline');
         }

      }
      else{
         return view('courses.errorCoursePay');
      }
     }
     else{
        // return 'Payment declined!';
        return view('courses.errorCoursePay');
     }

     }
     //for cancel url request
     public function errorCourse(){
   //  return 'User declined the payment!';
     return view('courses.errorCoursePay');
     }
   //buy course form
   public function buycourseform($course_id,$course_name){
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

      $course=Course::Find($course_id);
      return view('courses.buyCourseForm',compact('course'));
   }

   public function paymobCourse(){
      // return  Session::all();

      //2 order registeration api
      $auth_token = session('auth_token');
      $course_id=session('course_id');
       $user_name=session('username');
       $phone=session('phone');
       $email=session('email');
       $price=(int)session('price') *1900;
       $amount_cents=(string)$price;
    $items=array(
        "name"=>session('course_name'),
        "amount_cents"=> $price,
        "description"=> "",
        "quantity"=> "1"
    );
       // $name=json_encode($items['name']);
        // $name=json_encode($items['name']);
        // $amount=json_encode($items['amount_cents']);

         $name=$items['name'];
        $amount=$items['amount_cents'];

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
           //return  $order['id'];
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
        //old   "integration_id"=> 2219285,
      $payment_token=json_decode($payment_key->getBody(),true);
      $order_token= json_encode($payment_token['token']);
       $payment_url='https://accept.paymob.com/api/acceptance/iframes/400603?payment_token='.$payment_token['token'];
        return Redirect()->to($payment_url);
        }
   }
   public function callback(Request $request){
     //  return 'pay course';
    $data=$request->all();
    $id=$data['id'];
          //return view('courses.successCoursepay');
//          return "done";
          $course_id=session('course_id');
           $book_id = session('book_id');
        if($course_id){
              $username=session('username');
          $phone=session('phone');
          $email=session('email');
          $address=session('address');
          $type=session('type');
          $course_name=session('course_name');
          $type=='book_online'? $booked=0:$booked=1;

          Client::create([
             'username' => $username,
             'phone' => $phone,
             'email'=>$email,
             'address'=>$address,
             'type'=>$type,
             'book_name'=>$course_name,
             'booked'=>$booked,
         ]);

         $request->session()->flush();

        //  //for type of course
         if($type=='book_online'){
          //get the selected course download
          $course= Course::findOrFail($course_id);
          return view('courses.successCoursepay',compact('id','course'));
         }
         else{
             //for offline course book
             return view('courses.successCourseOffline');
         }
        }

        if($book_id){
          //  return 'book';
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

                $request->session()->flush();

                //for type of book
                if ($type == 'pdf') {
                  //  return $book_id;
                    //get the selected book for pdf download
                    $book = Book::findOrFail($book_id);
                    return view('books.successBookspay', compact('id', 'book'));
                } else {
                    //for hard copy book
                    return view('books.successHardcopy');
                }
        }
        //  return $book_id;

        //   //for insert data in client table



   }


}
