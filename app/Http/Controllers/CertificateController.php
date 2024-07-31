<?php

namespace App\Http\Controllers;
use App\Models\Certificate;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $certificates=Certificate::all();
        return view('certificates.index',compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // for moving certificate
        $file_extension = $request->certificate->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'certificates';
        $request->certificate->move($path, $file_name);
        Certificate::create([
            'name' => $file_name,
        ]);
        return redirect()->back()->with('certificate', 'Certificate Saved!');

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
        $certificate = Certificate::find($id);
        $img_destination = 'certificates/' . $certificate->name;
        if (File::exists($img_destination)) {
            File::delete($img_destination);
        }
        $certificate->delete();
        return redirect()->back();
    }
    public function userCertificates(){
        $certificates=Certificate::all();
        return view('certificates.userCertificates',compact('certificates'));
    }
}
