<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Livewire\Component;
use Auth;

class Representatives extends Component
{
    public function render()
    {
        $representatives = User::where('id', '<>', Auth::User()->id)->get();

        $groups = Group::whereHas('users', function($query) {
            $query->where('user_id', Auth::User()->id);
        })
        ->get();

        return view('livewire.representatives', 
        [
            'representatives' => $representatives,
            'groups' => $groups
        ]);
    }
}
