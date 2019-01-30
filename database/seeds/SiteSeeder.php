<?php

use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          // Role comes before User seeder here.
          $this->call('RoleTableSeeder');
          // Projects seeder will create projects.
          $this->call('PermissionTableSeeder');
          // User seeder will use the roles above created.
          $this->call('UserTableSeeder');
          // Use page seeder.
          $this->call('PageTableSeeder');

          $this->command->info('Основные страницы сайта загружены в бд!');
    }
}
