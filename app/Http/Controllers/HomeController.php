<?php

namespace App\Http\Controllers;

use App\Models\videoCall;
use App\Models\User;
use Illuminate\Http\Request;
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        // Instantiate a new OpenTok object with our api key & secret
        $opentok = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        // Creates a new session (Stored in the Vonage API cloud)
        $session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
        // Store the unique ID of the session
        $session_id = $session->getSessionId();
        $token = $opentok->generateToken($session_id, ['role' => Role::PUBLISHER, 'expireTime' => time() + (7 * 24 * 60 * 60)]);

        return view('home', compact(['session_id', 'token']));
    }
}
