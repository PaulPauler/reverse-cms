<?php
namespace App\Cms\Providers;

class CmsModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot() {
        $pathToCustomModule = '../../../../../../app/Cms/Modules';
        $pathToVendor = '../Modules';

        //Get module list from "config/cms.php"
        $modules = config("cms.modules");

        if($modules) {
              foreach ($modules as $module => $moduleName){
                  //Load routes
                  if(file_exists(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Routes/routes.php')) {
                      $this->loadRoutesFrom(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Routes/routes.php');
                  }elseif(file_exists(__DIR__.'/'.$pathToVendor.'/'.$module.'/Routes/routes.php')) {
                      $this->loadRoutesFrom(__DIR__.'/'.$pathToVendor.'/'.$module.'/Routes/routes.php');
                  }

                  //Load Views
                  //use "view('Test::admin')" in controller
                  if(is_dir(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Views')) {
                      $this->loadViewsFrom(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Views', $module);
                  }elseif(is_dir(__DIR__.'/'.$pathToVendor.'/'.$module.'/Views')) {
                      $this->loadViewsFrom(__DIR__.'/'.$pathToVendor.'/'.$module.'/Views', $module);
                  }

                  //Load migrations
                  if(is_dir(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Migrations')) {
                      $this->loadMigrationsFrom(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Migrations');
                  }
                  if(is_dir(__DIR__.'/'.$pathToVendor.'/'.$module.'/Migrations')) {
                      $this->loadMigrationsFrom(__DIR__.'/'.$pathToVendor.'/'.$module.'/Migrations');
                  }

                  //Load trans
                  //trans('Test::messages.welcome')
                  if(is_dir(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Lang')) {
                      $this->loadTranslationsFrom(__DIR__.'/'.$pathToCustomModule.'/'.$module.'/Lang', $module);
                  }elseif(is_dir(__DIR__.'/'.$pathToVendor.'/'.$module.'/Lang')) {
                      $this->loadTranslationsFrom(__DIR__.'/'.$pathToVendor.'/'.$module.'/Lang', $module);
                  }
             }
        }
    }

    public function register()
    {

    }
}
