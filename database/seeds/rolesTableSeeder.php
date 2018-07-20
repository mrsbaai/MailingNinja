<?php

use Illuminate\Database\Seeder;
use App\role;
class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new role();
        $role_admin->name = 'admin';
        $role_admin->description = 'adnin';
        $role_admin->save();

        $role_costumer = new role();
        $role_costumer->name = 'costumer';
        $role_costumer->description = 'costumer';
        $role_costumer->save();

        $role_manager = new role();
        $role_manager->name = 'manager';
        $role_manager->description = 'offer manager';
        $role_manager->save();

        $role_publisher = new role();
        $role_publisher->name = 'publisher';
        $role_publisher->description = 'publisher';
        $role_publisher->save();

    }
}
