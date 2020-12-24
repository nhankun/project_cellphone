<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon','image', 'description', 'address', 'website', 'phone', 'email', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'manufacturer_id');
    }

    public function scopeActived()
    {
        return $this->where('status',1);
    }
}
