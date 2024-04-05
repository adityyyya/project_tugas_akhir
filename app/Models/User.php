<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use App\Enums\Config as ConfigEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        // 'password',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'is_active' => 'boolean',
    // ];

    /**
     * Get the user's profile picture
     *
     * @return Attribute
     */
    public static function getUser()
    {
        $data = User::join('biodata','biodata.id_user','=','users.id')
        ->where('users.level','!=','Admin')
        ->get();
        return $data;
    }
    public static function getEditUser($id)
    {
        $data = User::join('biodata','biodata.id_user','=','users.id')
        ->where('users.level','!=','Admin')
        ->where('users.id',$id)
        ->get();
        return $data;
    }
    public static function getUserProfil()
    {
        $data = User::join('biodata','biodata.id_user','=','users.id')
        ->where('users.id',Auth::user()->id)
        ->first();
        return $data;
    }
}
