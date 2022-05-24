<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Group extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function representatives()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(GroupMessage::class);    
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function lastMessage($group_id)
    {
        $message = GroupMessage::where('group_id', $group_id)->orderBy('id', 'desc')->first();
        return $message;
    }
}
