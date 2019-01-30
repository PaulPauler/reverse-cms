<?php

use Illuminate\Database\Seeder;
use App\{User, Role};

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       User::create(['name' => 'Admin','username' => 'admin','email' => 'admin@reverse.systems','password' => bcrypt('admin')])
             ->attachRole(Role::where('name', 'Admin')->first());

       User::create(['name' => 'Content manager','username' => 'manager','email' => 'manager@reverse.systems','password' => bcrypt('manager')])
             ->attachRole(Role::where('name', 'Content_manager')->first());
     }
}
