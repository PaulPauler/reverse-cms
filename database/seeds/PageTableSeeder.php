<?php

use Illuminate\Database\Seeder;
use App\Cms\Models\{Page, Language};

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Add ru language supporting*/
        Language::create(['name' => Config::get('app.locale'), 'code' => Config::get('app.locale')]);

        /*Home page*/
        Page::create(['url' => '/', 'menu_id' => 1])
          ->translate()
          ->create(['name' => 'Главная страница', 'language_id' => 1]);
        /*Contacts*/
        Page::create(['url' => 'contacts', 'module' => 'feedback', 'menu_id' => 1])
            ->translate()
            ->create(['name' => 'Контакты', 'language_id' => 1]);
        /*Sitemap*/
        Page::create(['url' => 'sitemap', 'module' => 'sitemap',  'menu_id' => 1])
            ->translate()
            ->create(['name' => 'Карта сайта', 'language_id' => 1]);
    }
}
