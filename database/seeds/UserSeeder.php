<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        $user = new \App\User();
        $user->name = 'Admin';
        $user->email = 'admin@email.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('123456');

        $user->save();
    }
}
