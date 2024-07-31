<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Session_client;
//add
use Illuminate\Support\Facades\Http;


class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // All sessions for admin
    public function index()
    {
        //
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // All sessions for admin
    public function create()
    {
        return view('sessions.create');
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
        //return $request;
        Session::create([
            'session_type' => $request->session_type,
            "price_online" => $request->price_online,
            "price_offline" => $request->price_offline,
        ]);
        return redirect()->back()->with('session_saved', 'Session Saved!');
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
        $session = Session::find($id);
        return view('sessions.edit', compact('session'));
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
        $session = Session::find($id);
        $request->new_session_type == null ? $new_session_type = $session->session_type : $new_session_type = $request->new_session_type;
        $request->new_price_online == null ? $new_online_price = $session->price_online : $new_online_price = $request->new_price_online;
        $request->new_price_offline == null ?  $new_offline_price = $session->price_offline : $new_offline_price = $request->new_price_offline;

        $session->update([
            'session_type' => $new_session_type,
            'price_online' => $new_online_price,
            'price_offline' => $new_offline_price,
        ]);
        return redirect()->back()->with('session_edited', 'Session edited Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::find($id)->delete();
        return redirect()->back();
    }
    public function userSession()
    {
        // 1 authentication request
        $auth_request = Http::withHeaders(['Content-Type' => 'application/json'])->post(
            "https://accept.paymob.com/api/auth/tokens",
            [
                "api_key" => "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SndjbTltYVd4bFgzQnJJam95TURJMU5ESXNJbTVoYldVaU9pSnBibWwwYVdGc0lpd2lZMnhoYzNNaU9pSk5aWEpqYUdGdWRDSjkuenl6Tk5yc0JiZTN2c0p2Wm1xZHpYYmd1QnFrdTBhNm9PWDNBd1hwRDdwcGY4Rm1fQi0xYmhqR1I1cWRId3F4M29ISVEyckhIUmJsODJfZE8wS2hsaHc="
            ]
        );
        $result = $auth_request->getBody();
        if ($result) {
            $token = json_decode($result, true);
            $auth_token = json_encode($token['token']);
            session()->put('auth_token', $auth_token);
        }
        $sessions = Session::latest()->get();
        return view('sessions.userform', compact('sessions'));
    }
    public function adminSession()
    {
        $session_clients = Session_client::all();
        return view('sessions.sessionclient', compact('session_clients'));
    }
    public function connectClient($id)
    {
        Session_client::where('id', $id)
            ->update([
                'booked' => 1
            ]);
        return redirect()->back()->with('sessionContacted', $id);
    }
    public function deleteClient($id)
    {
        //return $id;
        Session_client::find($id)->delete();
        return redirect()->back();
    }
}
