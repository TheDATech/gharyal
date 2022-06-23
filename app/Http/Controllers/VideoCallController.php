<?php

namespace App\Http\Controllers;

use App\Models\videoCall;
use App\Models\User;
use Illuminate\Http\Request;
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\Role;

class VideoCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'from_user_id' => 'required',
            'to_user_id' => 'required'
        ]);

        $user = User::findOrFail($request->from_user_id);
        $user2 = User::findOrFail($request->to_user_id);
        
        $opentok = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
        $videoCall = new videoCall();
        $videoCall->name = $user->name . " and " . $user2->name ." call";
        $videoCall->from_user_id = $request->from_user_id;
        $videoCall->to_user_id = $request->to_user_id;
        $videoCall->session_id = $session->getSessionId();
        $videoCall->save();
        $sessionId = $videoCall->session_id;
        $token = $opentok->generateToken($sessionId, ['role' => Role::PUBLISHER, 'expireTime' => time() + (7 * 24 * 60 * 60)]);
        return response()->json([
            "session_id" => $sessionId,
            "token" => $token,
            "id" => $videoCall->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\videoCall  $videoCall
     * @return \Illuminate\Http\Response
     */
    public function show(videoCall $videoCall)
    {
        $sessionId = $videoCall->session_id;
        $opentok = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $token = $opentok->generateToken($sessionId, ['role' => Role::PUBLISHER, 'expireTime' => time() + (7 * 24 * 60 * 60)]);
        return view('call.index', compact(["sessionId", "token"]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\videoCall  $videoCall
     * @return \Illuminate\Http\Response
     */
    public function edit(videoCall $videoCall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\videoCall  $videoCall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, videoCall $videoCall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\videoCall  $videoCall
     * @return \Illuminate\Http\Response
     */
    public function destroy(videoCall $videoCall)
    {
        //
    }
}
