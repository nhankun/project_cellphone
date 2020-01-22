<?php
namespace App\Services;


use Illuminate\Support\Facades\Session;

class GetSession {

    public static function putSessionProduct($id)
    {
        Session::put('product_id',$id);
    }

    public static function getSessionProduct()
    {
        return Session::get('product_id');
    }

}
