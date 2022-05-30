<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Role;

class AuthController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'message' => 'required'
        ]);
        
        $user = User::create([
            "name" => $request->name, 
            "email" => $request->email, 
            "password" => bcrypt('password123')
        ]);
        
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->user_id = $user->id;
        $profile->save();
        
        $role = Role::find(Role::CUSTOMER_ROLE_ID);
        $user->assignRole([$role->id]);
        
        $representatives = User::role($request->department)->get();
        foreach($representatives as $representative) {
            $message = new Message();
            $message->from_user_id = $user->id;
            $message->to_user_id = $representative->id;
            $message->message = $request->message;
            $message->save();
        }

        return response()->json([
            "message" => "successfully chat initiated."
        ]);
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
    }
}
