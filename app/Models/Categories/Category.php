<?php

namespace App\Models\Categories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon','properties', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];

    public function scopeActived()
    {
        return $this->where('status',1);
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
