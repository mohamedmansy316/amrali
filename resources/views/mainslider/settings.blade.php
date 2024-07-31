@extends('layouts.app')
@section('content')

             <div class="iframe-container"  style="margin-right: 3%;">
             <h1> تعديل الاعدادات</h1>
             <form method="POST" action="{{route('mainslider.update',1)}}"  enctype="multipart/form-data" style="width: 80%;">
                @csrf
                @method('PUT')
                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">العنوان بالعربية</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                         name="setting_title_ar" value="{{$setting->setting_title_ar}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">العنوان بالانجليزية</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_title_en" value="{{$setting->setting_title_en}}">
                </div>

                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">اميل الشركة</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_site_email" value="{{$setting->setting_site_email}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">كلمات البحث</label>
                    <textarea type="LONGBLOB" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"style="height: 50px;" name="setting_keywords"><?php echo $setting->setting_keywords ?></textarea>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">الوصف</label>
                    <textarea type="LONGBLOB" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"style="height: 50px;" name="setting_description"><?php echo $setting->setting_description ?></textarea>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">العنوان بالعربية</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_site_address_ar" value="{{$setting->setting_site_address_ar}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">العنوان بالانجليزية</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_site_address_en" value="{{$setting->setting_site_address_en}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1"> لينك خريطة جوجل</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_googlemap" value="{{$setting->setting_googlemap}}">
                </div> --}}

                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1"> نبذة عني بالعربية</label>
                    {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_site_address_ar" value="{{$setting->setting_site_address_ar}}"> --}}

                    <textarea type="LONGBLOB" id="arabic"  class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp"style="height: 100px;" name="setting_site_address_ar" style="margin-top: 10px"><?php echo str_replace('<br />', ' ', $setting->setting_site_address_ar . "\n"); ?></textarea>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1"> نبذة عني بالانجليزية</label>
                    {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_site_address_en" value="{{$setting->setting_site_address_en}}"> --}}

                    <textarea type="LONGBLOB" id="arabic"  class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp"style="height: 100px;" name="setting_site_address_en" style="margin-top: 10px"><?php echo str_replace('<br />', ' ', $setting->setting_site_address_en . "\n"); ?></textarea>
                </div>

                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">لينك الفيس بوك</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_facebookurl" value="{{$setting->setting_facebookurl}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">لينك الواتساب</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_whatsappurl" value="{{$setting->setting_whatsappurl}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">  لينك اليوتيوب</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_youtubeurl" value="{{$setting->setting_youtubeurl}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">حساب انستجرام</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_instgramurl" value="{{$setting->setting_instgramurl}}">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="exampleInputEmail1">رابط التلجرام</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="setting_telegramurl" value="{{$setting->setting_telegramurl}}">
                </div>

                <button type="submit" class="btn btn-warning" style="margin-top: 10px;margin-bottom: 34px;">تعديل</button>

               </form>



            </div>
 @endsection


