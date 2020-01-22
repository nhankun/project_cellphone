<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key', 'name'
    ];

    public function districts()
    {
        return $this->hasMany(District::class, 'province_id','id');
    }
}
