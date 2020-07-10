<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminCreate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $input = [
            'code'=>'abc123',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('abcd1234'),
            'role_id' => 0
        ];
        DB::table('users')->create($input);
    }
}
