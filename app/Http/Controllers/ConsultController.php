<?php

namespace App\Http\Controllers;
use App\Models\Consult;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consults=Consult::get();
        return view('consulting.index',compact('consults'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('consulting.create');
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
       // return $request;
       $consult = new Consult;
       $consult->consult_type= $request->consult_type;
       $consult->price_online=$request->price_online;
       $consult->price_offline=$request->price_offline;
       $consult->save();
       return redirect()->back()->with('consult_saved', 'Consult Saved!');

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
        $consult=Consult::find($id);
        return view('consulting.edit',compact('consult'));
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
       $update=array();
       $request->consult_type==null? '' : $update['consult_type'] = $request->consult_type;
       $request->price_online==null? '' :$update['price_online']=$request->price_online;
       $request->price_offline==null? '' :$update['price_offline']=$request->price_offline;

       Consult::where('id', $id)->update(
        $update
       );
       return redirect()->back()->with('consult_updated', 'Consult Updated!');
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
        Consult::where('id',$id)->delete();
        return redirect()->back();
    }
}
