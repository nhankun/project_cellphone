<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('providers')->insert([
            [
                'id' => 1,
                'name' => 'cellphone',
                'email' => 'manage@cellphone.com',
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>2,
                'name' => 'toki',
                'email' => 'manage@toki.com',
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>3,
                'name' => 'toko',
                'email' => 'toko@toko.com',
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ]
        ]);
    }
}
