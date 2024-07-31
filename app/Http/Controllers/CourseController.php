<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use View;
//use Session;
//use App\Http\Controllers\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Course::get();
        return view('courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    /**
     * Handles the file upload
     *
     * @param FileReceiver $receiver
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     *
     */
    public function store(Request $request)
    {
        $course_rar_name = session('course_rar_name');
        if ($course_rar_name) {
            Session::forget('course_rar_name');
            $course_pic = $request->course_picture;
            $course_pic_name = time() . '.' . $course_pic->extension();
            Storage::putFileAs('public/upload_courses', $course_pic,  $course_pic_name);
            Course::create([
                'course_name' => $request->course_name,
                "price_online" => $request->price_online,
                "price_offline" => $request->price_offline,
                'course_picture' => $course_pic_name,
                'course_rar' => $course_rar_name,
            ]);
            return redirect()->back()->with('course', 'Course Saved!');

        }
        else{
            return redirect()->back()->with('course_error', 'please upload course file first!');
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $course=Course::find($id);
        return view('courses.edit',compact('course'));
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
        $course=Course::find($id);
        $new_price_online=$request->new_price_online;
        $new_price_offline=$request->new_price_offline;
        $new_video=$request->new_video;
        $new_name=$request->new_course_name;
        //if user entered new online price
        $new_price_online==null? $newOnlinePrice=$course->price_online : $newOnlinePrice=$new_price_online ;
        //if user entered new offline price
        $new_price_offline==null? $newOfflinePrice=$course->price_offline : $newOfflinePrice=$new_price_offline ;
        //$new_video==null ? $newVideo=$course->course_picture : $newVideo=$new_video ;
        $new_name==null ? $newName=$course->course_name  : $newName=$new_name ;
        if($new_video ==null){
            $course->update([
                'price_online'=> $newOnlinePrice ,
                'price_offline'=>$newOfflinePrice,
                'course_name'=>$newName
            ]);
        }else{
             //destroy old pic
             $img_destination = 'upload_courses/' . $course->course_picture;
             if (File::exists($img_destination)) {
                 File::delete($img_destination);
             }
             //upload new video
             $course_pic = $new_video;
             $course_pic_name = time() . '.' . $course_pic->extension();
             Storage::putFileAs('public/upload_courses', $course_pic,  $course_pic_name);
             $course->update([
                 'price_online'=> $newOnlinePrice ,
                 'price_offline'=>$newOfflinePrice,
                 'course_picture'=>$course_pic_name,
                 'course_name'=>$newName
             ]);
        }


        return redirect()->back()->with('course_edited', 'Course edited Successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //return "done";
        $course=Course::find($id);

        $img_destination = 'upload_courses/' . $course->course_picture;
        $course_destination = 'upload_courses/' . $course->course_rar;
        if (File::exists($img_destination)) {
            File::delete($img_destination);
        }

        if (File::exists($course_destination)) {
            File::delete($course_destination);
        }
        $course->delete();
        return redirect()->back();
    }

    public function insertcourse(Request $request)
    {
        $course_rar = $request->file;
        //upload course picture
        $course_rar_Name = time() . '.' . $course_rar->extension();
        //save course file to storage
        Storage::putFileAs('public/upload_courses', $course_rar,  $course_rar_Name);
        $request->session()->put('course_rar_name', $course_rar_Name);
    }
    // public function allcourses(){
    //     return "done";
    //     //$courses = Course::get();
    //     //return view('courses.coursesusers',compact('courses'));
    // }
}
