<?php

use Illuminate\Database\Seeder;
use App\user;
use App\role;
class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $role_manager  = role::where('name', 'manager')->first();
        $role_admin  = role::where('name', 'admin')->first();
        $role_publisher  = role::where('name', 'publisher')->first();
        $role_costumer  = role::where('name', 'costumer')->first();

        $password =  bcrypt("991580");
        DB::table('users')->delete();

        $admin = new user();
        $admin->name = 'Abdelilah Sbaai';
        $admin->password = $password;
        $admin->email = "abdelilah.sbaai@gmail.com";
        $admin->save();
        $admin->roles()->attach($role_manager);
        $admin->roles()->attach($role_admin);

        $manager = new user();
        $manager->paypal = "example.paypal@gmail.com";
        $manager->skype = "Omayma el misbahi";
        $manager->name = "Oumayma";
        $manager->balance = "0";
        $manager->life_time_profit = "0";
        $manager->email = "manager@gmail.com";
        $manager->password = $password;
        $manager->save();
        $manager->roles()->attach($role_manager);


        $publisher_manager = user::where('name', 'Oumayma')->first();

        $publisher = new user();
        $publisher->manager_id = $publisher_manager['id'];
        $publisher->paypal = "example.paypal@gmail.com";
        $publisher->skype = "nice publisher";
        $publisher->name = "publisher name";
        $publisher->balance = "0";
        $publisher->life_time_profit = "0";
        $publisher->email = "publisher@gmail.com";
        $publisher->password = $password;
        $publisher->save();
        $publisher->roles()->attach($role_publisher);




        $costumer = new user();
        $costumer->paypal = "costumer.paypal@gmail.com";
        $costumer->name = "happy costumer";
        $costumer->email = "costumer@gmail.com";
        $costumer->password = $password;
        $costumer->save();
        $costumer->roles()->attach($role_costumer);


    }
}
