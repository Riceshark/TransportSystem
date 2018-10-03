<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator',],
            ['id' => 2, 'title' => 'User',],
            ['id' => 3, 'title' => 'CEO',],
            ['id' => 4, 'title' => 'Truck driver',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
