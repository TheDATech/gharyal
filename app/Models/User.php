<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Message;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Auth;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    public static function lastMessage($user_id)
    {
        $message = Message::where('from_user_id', $user_id)->where('to_user_id', Auth::User()->id)->orderBy('id', 'desc')->first();
        return $message;
    }

    public static function countuUnseenMessages($from_user_id)
    {
        return Message::where('from_user_id', $from_user_id)->where('to_user_id', Auth::User()->id)->where('is_read', false)->count();
    }
    
    public static function getAllMessages($user_id, $user_id2)
    {
        $messages = Message::where(function($query) use ($user_id) {
            $query->where('from_user_id',$user_id)
            ->orWhere('to_user_id',$user_id);
        })->where(function($query) use ($user_id2) {
            $query->where('from_user_id', $user_id2)
            ->orWhere('to_user_id', $user_id2);
        })->get();
        return $messages;
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function mySession() {
        return $this->hasOne(videoCall::class);
    }
}
