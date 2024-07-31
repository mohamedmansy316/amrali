<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       app()->setLocale($request->segment(1));
    //    if($request->route()=='/'){
    //     //return redirect('/ar');
    //     app()->setlocale('ar');
    //    }
      // $url = $request->url();
       //isset();
    //    if(! $request->segment(1)){
    // // return  $request->fullUrlWithQuery(['type' => 'phone']);
    //        //return redirect('/ar');
    //    }
        return $next($request);
    }
}
