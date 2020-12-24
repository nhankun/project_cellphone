<?php

namespace App\Models\Users;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'password','avatar','address','country','city','district','status','expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at','deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    public function getName()
    {
        return $this->name;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    //function
    public function active()
    {
        $this->status = true;
        return $this->save();
    }

    public function cancel()
    {
        $this->status = false;
        return $this->save();
    }

    public function getTimeLoggedIn($to)
    {
        Carbon::setLocale('vi');

        $to = Carbon::createFromFormat('Y-m-d H:i:s', $to);
        $from = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

//        $diff_in_months = $to->diffInMonths($from);
//        $diff_in_days = $to->diffInDays($from);
//        $diff_In_Hours = $to->diffInHours($from);
        $diffForHumans = $to->diffForHumans($from);
        return $diffForHumans;
    }

}
