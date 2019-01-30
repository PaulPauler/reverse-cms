<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create(['name' => 'Admin','display_name' => 'Admin','description' => 'Admin']);
      Role::create(['name' => 'Content_manager','display_name' => 'Content manager','description' => 'Content manager']);
    }
}
