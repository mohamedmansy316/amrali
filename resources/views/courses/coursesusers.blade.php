@extends('layouts.app')
@section('content')
<style>
  #muted  video::-webkit-media-controls-volume-slider {
  display: none;
}

#muted video::-webkit-media-controls-mute-button {
  display: none;
}
</style>
<div class="container">
    <h1 style="margin-top: 10px;margin-bottom: 30px;">@lang('auth.coursess') </h1>
    <div class="row">
        @foreach ($courses as $course )
        <div class="col-sm-6">
            <div class="card">
                {{-- {{ asset('storage/upload_courses/' . $course->course_picture) }} --}}
                {{-- {{asset('storage/upload_courses/'.$course->course_picture)}} --}}
                <!--<video loop="true" controls >-->
                <!--    <source src="{{asset('storage/upload_courses/'.$course->course_picture)}}" type="video/mp4">-->
                <!--  </video>-->
                  @if ($course->course_name=='كورس التسويق الألكتروني')
                  <iframe width="100%" height="315" src="https://www.youtube.com/embed/mJ9a-DkMJO0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <!--<video loop="true" controls poster="{{asset('upload_courses/1665983061.jpeg')}}" style="height: 255px;">-->
                <!--    <source src="{{asset('upload_courses/'.$course->course_picture)}}" type="video/mp4">-->
                <!--</video>-->
                
                @elseif($course->course_name=='كورس الحجامة')
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/uRwevC5g9O8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <!--<div id="muted">-->
                <!--     <video loop="true" controls muted controlsList="novolume" poster="{{asset('upload_courses/course4.jpeg')}}" style="height: 255px;width: 100%;">-->
                <!--    <source src="{{asset('storage/upload_courses/'.$course->course_picture)}}" type="video/mp4">-->
                <!--</video>-->
                <!--</div>-->
                
                
                @elseif($course->course_name=='كورس العلاج بالطاقة الحيوية')
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/xqV_ipFSt2g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <!--<video loop="true" controls poster="{{asset('upload_courses/course1.jpeg')}}"  style="height: 255px;" >-->
                <!--    <source src="{{asset('upload_courses/'.$course->course_picture)}}" type="video/mp4">-->
                <!--  </video>-->
                  @elseif($course->course_name=='كيف تتخلص من وجع الاسنان')
                <video loop="true" controls poster="{{asset('upload_courses/dent.jpg')}}" style="height: 255px;" >
                    <source src="{{asset('upload_courses/'.$course->course_picture)}}" type="video/mp4">
                  </video>
                  
                   @else
                    <!--<embed type='application/x-mplayer20' src="{{asset('storage/upload_courses/'.$course->course_picture)}}" >-->
                    <!--</embed>-->
                <!--<video loop="true" controls  style="height: 255px;" >-->
                    <img src="{{asset('upload_courses/'.$course->course_picture)}}" style="height: 300px;" >
                  <!--</video>-->
    
                @endif
                <div class="card-body">
                  <h5 class="card-title" style="font-size: x-large">{{$course->course_name}}</h5>
                    @if ($course->course_name=='كورس تعلم الانجليزية')
                  <p class="card-text" style="font-size: large">Offline price: {{$course->price_offline}}</p>
                  @elseif($course->course_name=='كورس تعلم الالمانية')
                   <p class="card-text" style="font-size: large">Offline price: {{$course->price_offline}}</p>
                  @else
                  <p class="card-text" style="font-size: large">Online price: {{$course->price_online}}</p>
                  <p class="card-text" style="font-size: large">Offline price: {{$course->price_offline}}</p>
                  @endif
                 
                  {{-- <a href="{{route('course.download',$course->id)}}" class="btn btn-danger"> @lang('auth.Buy now') <i class="fas fa-shopping-cart"></i></a> --}}
                  <a href="{{ route('buycourseform', [$course->id, $course->course_name]) }}" class="btn btn-danger">
                    @lang('auth.Buy now') <i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
          </div>

        @endforeach
    </div>
</div>
@endsection
