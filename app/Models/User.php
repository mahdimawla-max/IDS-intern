<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends  Authenticatable
{
    //
    use Notifiable;
    protected $fillable = ['username' , 'email' , 'password' , 'fullname'];

    public function shares()
    {
        return $this->belongsToMany(Share::class, 'users_shares');
    }

}

