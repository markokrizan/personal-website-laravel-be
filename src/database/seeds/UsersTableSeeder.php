<?php

use Illuminate\Database\Seeder;
use App\Constants\UserConstants;
use App\Models\User\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'role' => UserConstants::ROLE_ADMIN
        ]);
    }
}
