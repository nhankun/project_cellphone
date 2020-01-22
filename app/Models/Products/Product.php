<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'provider_id','name', 'quantity','price','description','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id','id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'product_id','id');
    }

    public function imageSmall()
    {
        return $this->hasOne(Image::class, 'product_id','id')->where('type','small');
    }
}
