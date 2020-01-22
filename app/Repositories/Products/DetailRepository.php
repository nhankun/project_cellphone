<?php

namespace App\Repositories\Products;

use App\Models\Products\Product;

class DetailRepository
{
    public function getDetailByProduct($product_id)
    {
        return Product::findOrFail($product_id);
    }
}
