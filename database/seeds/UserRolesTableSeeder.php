<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('user_roles')->insert([
            [
                'id'=> 1,
                'role_id'=> 1,
                'user_id' => 1,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=> 2,
                'role_id'=> 2,
                'user_id' => 2,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=> 3,
                'role_id'=> 3,
                'user_id' => 3,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ]
        ]);
    }
}
