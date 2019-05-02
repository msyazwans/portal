<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function announcement()
    {
        return $this->hasMany('App\Announcement','user_id');
    }

    public function slider()
    {
        return $this->hasMany('App\Slider','user_id');
    }

    public function link()
    {
        return $this->hasMany('App\Link','user_id');
    }

    public function service()
    {
        return $this->hasMany('App\Service','user_id');
    }

    public function question()
    {
        return $this->hasMany('App\Question','user_id');
    }

    public function article()
    {
        return $this->hasMany('App\Article','user_id');
    }
}
