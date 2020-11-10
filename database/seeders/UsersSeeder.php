<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Janja Marmelada',
                'email' => 'janja@test.com',
                'password' => Hash::make(123456)
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
