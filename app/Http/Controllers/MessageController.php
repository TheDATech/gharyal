<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class MessageController extends Controller
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
            'to_user_id' => 'required',
            'from_user_id' => 'required|email',
            'message' => 'required'
        ]);

        $message = new Message();
        $message->from_user_id = $request->from_user_id;
        $message->to_user_id = $request->to_user_id;
        $message->message = $request->message;
        $message->is_read = false;
        $message->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }


    // ========================================= API Controllers


    public function save(Request $request)
    {
        $this->validate(request(), [
            'from_user_id' => 'required',
            'message' => 'required'
        ]);

        if(isset($request->to_user_id)) {
            $message = new Message();
            $message->from_user_id = $request->from_user_id;
            $message->to_user_id = $request->to_user_id;
            $message->message = $request->message;
            $message->is_read = false;
            $message->save();
        }else {
            $role = Role::findOrFail($request->department_id);
            $representatives = User::role($role->name)->get();
            foreach($representatives as $representative) {
                $message = new Message();
                $message->from_user_id = $request->from_user_id;
                $message->to_user_id = $representative->id;
                $message->message = $request->message;
                $message->save();
            }
        }

        return response()->json([
            "message" => "Message sent successfully."
        ]);
    }

    public function getMessages(Request $request)
    {
        $this->validate(request(), [
            'from_user_id' => 'required'
        ]);

        $messages = Message::select('message', 'from_user_id', 'to_user_id')->where('to_user_id', $request->from_user_id)->orWhere('from_user_id', $request->from_user_id)->groupBy('message')->orderBy('id')->get();
        $i = 1;
        $myList = [];
        foreach($messages as $message) {
            if($request->from_user_id != $message->from_user_id) {
                $user = User::findOrFail($message->to_user_id);
                $arr = [
                    "representative_message" => $message->message,
                    "customer_message" => "",
                    "from_user_id" => $message->from_user_id,
                    "to_user_id" => $message->to_user_id,
                    "id" => $i++,
                    "name" => $user->name,
                    "is_received" => true,
                    "sender" => "representative"
                ];
                array_push($myList, $arr);
            }else {
                $user = User::findOrFail($message->to_user_id);
                $arr = [
                    "customer_message" => $message->message,
                    "representative_message" => "",
                    "from_user_id" => $message->from_user_id,
                    "to_user_id" => $message->to_user_id,
                    "id" => $i++,
                    "name" => $user->name,
                    "is_received" => false,
                    "sender" => "customer"
                ];
                array_push($myList, $arr);
            }
        }

        return response()->json($myList);
    }
    
    public function getRepresentative(Request $request) {
        $this->validate(request(), [
            'from_user_id' => 'required'
        ]);

        $messages = Message::select('message', 'from_user_id', 'to_user_id')->where('to_user_id', $request->from_user_id)->first();
        
        if($messages) {
            return response()->json([
                "to_user_id" => $messages->from_user_id
            ]);            
        }else  {
            return response()->json([
                "to_user_id" => null
            ]);            
        }

    }
}