<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('manufacturers')->insert([
            [
                'id' => 1,
                'name' => 'Asus',
                'email' => 'asus@asus.com',
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>2,
                'name' => 'Samsung',
                'email' => 'samsung@samsung.com',
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>3,
                'name' => 'Sony',
                'email' => 'sony@sony.com',
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ]
        ]);
    }
}
