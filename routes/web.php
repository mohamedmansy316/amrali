<?php
use App\Http\Controllers\setLanguage;
//use App\Http\config\LaravelLocalization;
//use App\Http\Kernel;
//use APP\Http\mcamara/laravel-localization;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentCourseController;
use App\Http\Controllers\PaymentSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\MainSliderController;

use App\Models\Article;
use App\Models\Setting;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use  Illuminate\Routing\RouteFileRegistrar;
use Illuminate\Support\Facades\App;

use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
  'prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{
        $sliders = Article::
            where('type', '1')
            ->get();

            $books = Article::
            where('type', '2')
            ->get();

            $courses = Article::
            where('type', '3')
            ->get();

            $testoninals=Article::
            where('type', '4')
            ->get();

            $settings=Setting::find(1);
    return View('welcome',compact('sliders','books','courses','testoninals','settings'));
	});
    Route::get('/home', function () {
      return redirect(LaravelLocalization::localizeUrl('/'));
     });
Route::view('/returns', 'static.returns')->name('returns');
  Route::get('/login',[LoginController::class,'showLoginForm']);
  Route::get('/register',[RegisterController::class,'showRegistrationForm']);
  //controller routes
  Route::resource('/books',BookController::class);
  Route::resource('/clients',ClientController::class);
  Route::resource('/sessions',SessionController::class);
  Route::resource('/courses',CourseController::class);
  Route::resource('/certificates',CertificateController::class);
  Route::resource('/consults',ConsultController::class);
  Route::resource('/mainslider',MainSliderController::class);

 // Route::get('/settings',[MainSliderController::class,'settings'])->name('settings');

  Route::POST('/courses/addcourse',[CourseController::class,'insertcourse'])->name('insertcourse');

 //Route::get('/courses/video',[CourseController::class,'insertcourse'])->name('insertcourseeee');
  //admin store page
  Route::POST('/clients/create/admin',[ClientController::class,'storeAdmin'])->name('storeAdmin');
  //userbooks page
  Route::get('/user/books',[BookController::class,'allbooks'])->name('users.books');
  //user course page
  Route::get('/client/userscourses',[ClientController::class,'allcourses'])->name('allcourses');
  //user session page
  Route::get('/usersession',[SessionController::class,'userSession'])->name('users.sessions');
  //admin client page
  Route::get('/adminsession',[SessionController::class,'adminSession'])->name('admin.sessions');
  //connect client route
  Route::get('/adminsession/connectclient/{id}',[SessionController::class,'connectClient'])->name('connectClient');
  //delete session client route
  Route::get('/adminsession/deleteclient/{id}',[SessionController::class,'deleteClient'])->name('deleteClient');
  //videes page route
  Route::get('/videos',[BookController::class,'videos'])->name('videos');
  // payment route
  Route::POST('/user/books/pay',[PaymentController::class,'pay'])->name('payment');
  //buy books form
  Route::get('/user/books/form/{id}/bookname/{bookname}',[PaymentController::class,'buybooksform'])->name('buybooksform');
  // cash on delivary form  cashOnDelivaryForm
  Route::get('/user/books/cashondelivary/{id}/bookname/{bookname}',[PaymentController::class,'cashOnDelivaryForm'])->name('cashOnDelivaryForm');
  //cash on delivary route
  Route::POST('/user/cashondelivary',[PaymentController::class,'cashOnDelivaryCreate'])->name('cashOnDelivaryCreate');
   //success route
 Route::get('/success',[PaymentController::class,'success']);
 //error route
 Route::get('/error',[PaymentController::class,'error']);
 //download book route
 Route::get('/user/books/download/{id}',[BookController::class,'download'])->name('book.download');

  //buy course form
  Route::get('/user/client/form/{id}/coursename/{bookname}',[PaymentCourseController::class,'buycourseform'])->name('buycourseform');
  // paymentcourse route
  Route::POST('/user/client/pay',[PaymentCourseController::class,'pay'])->name('course.pay');
  //success course route
 Route::get('/successCourse',[PaymentCourseController::class,'successCourse']);
 //error course route
 Route::get('/errorCourse',[PaymentCourseController::class,'errorCourse']);
 //download course route
 Route::get('/user/client/download/{id}',[ClientController::class,'downloadCourse'])->name('course.download');

 //payment session route
 Route::POST('/user/session/pay',[PaymentSessionController::class,'pay'])->name('session.pay');
 //success session route
 Route::get('/successSession',[PaymentSessionController::class,'successSession']);
 //error Session route
 Route::get('/errorSession',[PaymentSessionController::class,'errorSession']);
 //user certificate page
 Route::get('/userCertificates',[CertificateController::class,'userCertificates'])->name('userCertificates');


 //added for paymob
 Route::get('/user/books/paymob',[PaymentController::class,'paymob'])->name('paymob');
 Route::get('/callback',[PaymentController::class,'callback']);
 //pay course
 Route::get('/user/courses/paymob',[PaymentCourseController::class,'paymobCourse'])->name('paymobCourse');
 Route::get('/callback',[PaymentCourseController::class,'callback']);
 //pay session
 Route::get('/user/sessions/paymob',[PaymentSessionController::class,'paymobSession'])->name('paymobSession');
 Route::get('/callbacksession',[PaymentSessionController::class,'callbacksession']);

});



//to make arabic as default language
Route::get('/', function () {
    return redirect('/ar');
  });
Auth::routes();

