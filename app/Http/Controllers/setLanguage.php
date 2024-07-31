<?php

namespace App\Http\Controllers;
use App\Http\Middleware\setlocale;

use Illuminate\Http\Request;

class setLanguage extends Controller
{
    //
    public function arlanguage(){
         app()->setLocale='ar';
       return redirect()->back();
     }
     public function enlanguage(){
         app()->setLocale='en';
       return redirect()->back();
 
     }
   
}
