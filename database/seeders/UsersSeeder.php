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
                'email' => config('app.test_user.email'),
                'password' => Hash::make(config('app.test_user.password'))
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
