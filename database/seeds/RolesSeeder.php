<?php

use Illuminate\Database\Seeder;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "admin",//ID 1
        ]);
        DB::table('roles')->insert([
            'name' => "client",//ID 2
        ]);
        DB::table('roles')->insert([
            'name' => "barber",//ID 3
        ]);
    }
}
