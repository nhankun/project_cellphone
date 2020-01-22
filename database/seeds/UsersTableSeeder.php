<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('users')->insert([
            [
                'id'=>1,
                'name'=>'Admin',
                'email' => 'admin@cellphone.com',
                'password' => bcrypt('123123123'),
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>2,
                'name'=>'Manager',
                'email' => 'manager@cellphone.com',
                'password' => bcrypt('123123123'),
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>3,
                'name'=>'user',
                'email' => 'user@cellphone.com',
                'password' => bcrypt('123123123'),
                'status' => true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ]
        ]);
    }
}
