<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$e2yOOj36ie6PjsluTo1g5utY7i4J2lju5D9yMk1aTv4NupiUx3G02', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'User', 'email' => 'user@user.com', 'password' => '$2y$10$aO.Suwp7P2WhzGpjK2UL7.4VjMhWLLOiycAJaUCK4/5ACr/hxPepK', 'role_id' => 2, 'remember_token' => null,],
            ['id' => 3, 'name' => 'CEO', 'email' => 'ceo@ceo.com', 'password' => '$2y$10$g8mvHJLJu3UT9F0liXzd/ublkUmcpc4xjgjcIxjxucjgbyd8TUEfO', 'role_id' => 3, 'remember_token' => null,],
            ['id' => 4, 'name' => 'Truck Driver', 'email' => 'truck@truck.com', 'password' => '$2y$10$27rPzpabVxYpHLO9oQqsgOg3ZCtHW4Uv3E2UXR7IpCEKYJyMdfIIu', 'role_id' => 4, 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
