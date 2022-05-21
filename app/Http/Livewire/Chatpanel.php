<?php

namespace App\Http\Livewire;
use App\Models\Message;
use App\Models\User;
use App\Models\Group;
use Livewire\Component;
use Auth;

class Chatpanel extends Component
{
    public $to_user_id;
    public $to_group_id;
    public $name;
    public $description;
    public $messages;
    public $show_chat = false;
    public $show_group_chat = false;

    protected $listeners = ['updateChatAttributes', 'updateGroupChatAttributes', 'showMessages'];

    public function updateGroupChatAttributes($to_group_id)
    {
        $this->to_group_id = $to_group_id;
        $this->to_user_id = null;
        $this->show_group_chat = 1;
        $this->show_chat = false;
        $group = Group::find($this->to_group_id);
        $this->name = $group->name;
        $this->description = $group->description;

        $this->emit("updateGroupId", $this->to_group_id);
    }

    public function updateChatAttributes($to_user_id)
    {
        $this->to_user_id = $to_user_id;
        $this->to_group_id = null;
        $this->show_chat = 1;
        $this->show_group_chat = false;
        $user = User::find($this->to_user_id);
        $this->name = $user->name;

        foreach($user->messages as $message) {
            $message->is_read = true;
            $message->save();
        }

        $this->emit("updateMessageRecieverId", $this->to_user_id);
    }

    public function render()
    {
        if(isset($this->to_group_id)) {
            $group = Group::find($this->to_group_id);
            $this->messages = $group->messages;
        }else if(isset($this->to_user_id)) {
            $this->messages = Message::where(function($query) {
                    $query->where('from_user_id',$this->to_user_id)
                    ->orWhere('to_user_id',$this->to_user_id);
                })->where(function($query) {
                    $query->where('from_user_id', Auth::User()->id)
                    ->orWhere('to_user_id', Auth::User()->id);
                })->get();

            foreach($this->messages as $message) {
                if(Auth::User()->id == $message->to_user_id) {
                    $message->is_read = true;
                    $message->save();
                }
            }

        }else {
            $this->messages = new Message;
        }

        return view('livewire.chatpanel', ['messages' => $this->messages]);
    }
}