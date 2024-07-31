<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get client data
        $clients = Client::orderBy('created_at', 'desc')->get();;
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // this to create user for free book
        // return "done";
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  this to create user for free book
        //return $request;
        $book_id = $request->book_id;
       //$request->all();
        Client::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'type' => $request->type,
            'book_name' => $request->book_name,
            'booked' => 0,
        ]);
        return redirect()->back()->with('clientsaved', $book_id);
    }
    //store client from admin page
    public function storeAdmin(Request $request)
    {
        //return $request;
        $type = $request->type;
        // $booked;
        $type == 'pdf' ? $booked = 0 : $booked = 1;
        Client::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'type' => $request->type,
            'book_name' => $request->book_name,
            'booked' => $booked,
        ]);
        return redirect()->back()->with('clientAdminsave', 'Client Added');
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
        //return "done";
        $client_id = $id;
        $client = Client::findOrFail($id);
        $client->update([
            "booked" => 0,
        ]);
        return redirect()->back()->with('clientContacted', $client_id);
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
        //
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
        $client = Client::find($id);
        $client->delete();
        return redirect()->back();
    }
    public function allcourses(){
        //return "done";
        $courses = Course::get();
        return view('courses.coursesusers',compact('courses'));
    }

     //for download course
     public function downloadCourse($id){
        // download course
        $course=Course::findOrFail($id);
        $filepath = public_path('storage/upload_courses/'.$course->course_rar);
         return Response()->download($filepath);
    }

}
