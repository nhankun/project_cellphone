<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key_province','province_id', 'key','name'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id','id');
    }
}
