<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Setting;

use Illuminate\Http\Request;

class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Article::
            where('type', '1')
            ->get();
        $page='معرض الصور الرئيسي';
        $type='1';

        return view('mainslider.index',compact('sliders','page','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sliders = Article::
            where('type', '2')
            ->get();
        $page='معرض صور المؤلفات';
        $type='2';

        return view('mainslider.index',compact('sliders','page','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo_picture=$request->image;
        $file_extension = $logo_picture->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'mainImages';
        $logo_picture->move($path, $file_name);

        Article::create([
            'articles_image'=>$file_name,
            'type'=>$request->type
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sliders = Article::
            where('type', $id)
            ->get();
            if($id==3)
        $page='معرض صور الكورسات';

        if($id==4)
        $page='معرض صور اراء العملاء';
        $type=$id;

        return view('mainslider.index',compact('sliders','page','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting=Setting::findOrNew(1);
        $setting->save();

        return view('mainslider.settings',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = array();
       // $request->setting_title_ar == null ? '' : $update['setting_title_ar'] = $request->setting_title_ar;
       // $request->setting_title_en == null ? '' : $update['setting_title_en'] = $request->setting_title_en;
       // $request->setting_site_email == null ? '' : $update['setting_site_email'] = $request->setting_site_email;
       // $request->setting_keywords == null ? '' : $update['setting_keywords'] = $request->setting_keywords;
       // $request->setting_description == null ? '' : $update['setting_description'] = $request->setting_description;
       //nl2br(htmlentities($request->setting_site_address_ar, ENT_QUOTES, 'UTF-8'))
        $request->setting_site_address_ar == null ? '' : $update['setting_site_address_ar'] = nl2br(htmlentities($request->setting_site_address_ar, ENT_QUOTES, 'UTF-8'));
        $request->setting_site_address_en == null ? '' : $update['setting_site_address_en'] = nl2br(htmlentities($request->setting_site_address_en, ENT_QUOTES, 'UTF-8'));


        $request->setting_facebookurl == null ? '' : $update['setting_facebookurl'] = $request->setting_facebookurl;
        $request->setting_whatsappurl == null ? '' : $update['setting_whatsappurl'] = $request->setting_whatsappurl;
        $request->setting_youtubeurl == null ? '' : $update['setting_youtubeurl'] = $request->setting_youtubeurl;
        $request->setting_instgramurl == null ? '' : $update['setting_instgramurl'] = $request->setting_instgramurl;
        $request->setting_telegramurl == null ? '' : $update['setting_telegramurl'] = $request->setting_telegramurl;
       // $request->setting_sitetell1 == null ? '' : $update['setting_sitetell1'] = $request->setting_sitetell1;
        Setting::where('id', 1)->update(
            $update
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->back();
    }
}
