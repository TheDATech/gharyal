<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;
    
    public static function profile($user_id) {
        return User::findOrFail($user_id)->getFirstMediaUrl('avatar', 'thumb');
    }
    
}
