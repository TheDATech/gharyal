<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\GroupMessage;
use Auth;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::All();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $representatives = User::All();
        return view('groups.create', compact('representatives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new Group;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();

        if (isset($request->groupIcon)) {
            $group->addMediaFromRequest('groupIcon')->toMediaCollection('groupIcons');
        }

        $group->representatives()->sync($request->representatives);

        return redirect()->route('groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $representatives = User::All();
        return view('groups.edit', compact(['group', 'representatives']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();

        if ($request->hasFile('groupIcon')) {
            $group->media()->delete();
            $group->addMediaFromRequest('groupIcon')->toMediaCollection('groupIcons');
        }

        $group->representatives()->sync($request->representatives);
        return redirect()->route('groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }

    public function convertChatToGroup(Request $request)
    {
        $user_ids = [$request->user_id, Auth::User()->id];

        $representatives = User::All();
        return view('groups.chat_convert_to_group', compact(['user_ids', 'representatives']));
    }

    public function createCustomGroup(Request $request)
    {
        $group = new Group;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();

        if (isset($request->groupIcon)) {
            $group->addMediaFromRequest('groupIcon')->toMediaCollection('groupIcons');
        }

        $group->representatives()->sync($request->representatives);

        $messsages = User::getAllMessages($request->u_id1, $request->u_id2);
        foreach($messsages as $messsage) {
            $message = new GroupMessage();
            $message->user_id = $messsage->from_user_id;
            $message->group_id = $group->id;
            $message->message = $messsage->message;
            $message->save();
        }

        return redirect()->route('chat.index');
    }
}
