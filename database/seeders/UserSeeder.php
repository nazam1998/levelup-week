<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Nazam",
            'email' => 'nazamfr1998@gmail.com',
            'password' => Hash::make('root'),
            'role_id' => 1
        ]);
        DB::table('users')->insert([
            'name' => "Loulou",
            'email' => 'lou@lou.com',
            'password' => Hash::make('root'),
            'role_id' => 2
        ]);
    }
}
