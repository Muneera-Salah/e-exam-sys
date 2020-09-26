<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jazmy\FormBuilder\Traits\HasFormBuilderTraits;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, HasFormBuilderTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        $userrole = Auth::user()->role_id;
        if ($userrole == 1) {
            return true;
        }
        return false;
    }
    public function isExamMaker()
    {
        $userrole = Auth::user()->role_id;
        if ($userrole == 2) {
            return true;
        }
        return false;
    }

    public function isStudent()
    {
        $userrole = Auth::user()->role_id;
        if ($userrole == 3) {
            return true;
        }
        return false;
    }
}
