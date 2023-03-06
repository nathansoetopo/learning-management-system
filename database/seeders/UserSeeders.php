<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Superadmin Name',
            'email' => 'superadmin@test.test',
            'username' => 'superadmin',
            'gender' => 'male',
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRceeoCvxzs1sp0cKRtwCyzr9LvG3ceMP0OGg&usqp=CAU',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);

        $superadmin->assignRole('superadmin');

        $mentor = User::create([
            'name' => 'Mentor Name',
            'email' => 'mentor@test.test',
            'username' => 'mentor',
            'gender' => 'male',
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRceeoCvxzs1sp0cKRtwCyzr9LvG3ceMP0OGg&usqp=CAU',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);

        $mentor->assignRole('superadmin');

        $mentee = User::create([
            'name' => 'Nathan Ari Soetopo',
            'email' => 'nathan@test.test',
            'username' => 'nathansoetopo',
            'gender' => 'male',
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRceeoCvxzs1sp0cKRtwCyzr9LvG3ceMP0OGg&usqp=CAU',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);

        $mentee->assignRole('mentee');

        $user = User::create([
            'name' => 'User LMS',
            'email' => 'user@test.test',
            'username' => 'user',
            'gender' => 'male',
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRceeoCvxzs1sp0cKRtwCyzr9LvG3ceMP0OGg&usqp=CAU',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);

        $user->assignRole('user');
    }
}
