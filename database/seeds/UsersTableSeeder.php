<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = [
          'name' => "Test",
          'email' => "test@gmail.com",
          'password' => Hash::make('password'),
          'idfonctions'=> 1
        ];
        User::create($user1);
    }
}
