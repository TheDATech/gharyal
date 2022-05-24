<?php

namespace App\Http\Livewire;

use App\Models\GroupMessage;
use Livewire\Component;
use App\Models\Message;
use Auth;

class Chatmessage extends Component
{
    public $message;
    public $from_user_id;
    public $is_read;
    public $to_user_id;
    public $to_group_id;
    public $show_chat = false;

    protected $listeners = ['updateMessageRecieverId', 'updateGroupId'];

    public function updateGroupId($to_group_id)
    {
        $this->to_group_id = $to_group_id;
        $this->to_user_id = null;
    }

    public function updateMessageRecieverId($to_user_id)
    {
        $this->to_user_id = $to_user_id;
        $this->to_group_id = null;
    }

    public function sendMessage()
    {
        if(isset($this->to_user_id)) {
            $message = new Message();
            $message->from_user_id = Auth::User()->id;
            $message->to_user_id = $this->to_user_id;
            $message->message = $this->message;
            $message->is_read = false;
            $message->save();
        }elseif(isset($this->to_group_id)) {
            $message = new GroupMessage();
            $message->user_id = Auth::User()->id;
            $message->group_id = $this->to_group_id;
            $message->message = $this->message;
            $message->save();
        }
        
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->message = "";
    }

    public function render()
    {
        return view('livewire.chatmessage');
    }
}
