<?php
namespace App\Cms\Providers;

use Illuminate\Support\Facades\View;

class CmsServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public $path = '..';

    protected $commands = [
        'Install' => 'console.cms.install',
        'Update' => 'console.cms.update',
        'Template' => 'console.cms.template'
    ];

    public function boot() {
        //Cms courier, default = "Cms"
        $courier = 'Cms';
        $path = $this->path;

        //Load routes
        if(file_exists(__DIR__.'/'.$path.'/Routes/routes.php')) {
            $this->loadRoutesFrom(__DIR__.'/'.$path.'/Routes/routes.php');
        }

        //Load views
        //use "view('Test::admin')" in controller
        if(is_dir(__DIR__.'/'.$path.'/Views')) {
            $this->loadViewsFrom(__DIR__.'/'.$path.'/Views', $courier);
        }

        //Load migrations
        if(is_dir(__DIR__.'/'.$path.'/Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/'.$path.'/Migrations');
        }

       //Load trans
       //trans('Test::messages.welcome')
        if(is_dir(__DIR__.'/'.$path.'/Lang')) {
            $this->loadTranslationsFrom(__DIR__.'/'.$path.'/Lang', $courier);
        }

        //First publish
        $this->publishes([
          __DIR__.'/'.$path.'/../../public/cms' => public_path('cms'),
          __DIR__.'/'.$path.'/../../public/vendor' => public_path('vendor'),
          __DIR__.'/'.$path.'/../../resources/lang' => resource_path('lang'),
          __DIR__.'/'.$path.'/../../config/cms.php' => config_path('cms.php'),
          __DIR__.'/'.$path.'/../../config/lfm.php' => config_path('lfm.php'),
          __DIR__.'/'.$path.'/../../resources/views' => resource_path('views'),
        ], 'install');

        //Updating
        $this->publishes([
          __DIR__.'/'.$path.'/../../public/cms' => public_path('cms'),
          __DIR__.'/'.$path.'/../../public/vendor' => public_path('vendor'),
          __DIR__.'/'.$path.'/../../config/lfm.php' => config_path('lfm.php'),
          __DIR__.'/'.$path.'/../../resources/views/vendor' => resource_path('views/vendor'),
          __DIR__.'/'.$path.'/../../resources/lang' => resource_path('lang'),
        ], 'update');

        // $this->app['router']->middleware('multilang', 'App\Cms\Middleware\Multilang');
        $this->app['router']->aliasMiddleware('multilang-cms', 'App\Cms\Middleware\MultilangCms::class');
        $this->app['router']->aliasMiddleware('multilang-site', 'App\Cms\Middleware\MultilangSite::class');
    }

    public function register()
    {
        $path = $this->path;
        $this->mergeConfigFrom(
          __DIR__.'/'.$path.'/../../config/cms_dev.php', 'cms'
        );
        $this->registerCommands();

    }

    protected function registerCommands()
    {
        foreach (array_keys($this->commands) as $command) {
            $method = "register{$command}Command";

            call_user_func_array([$this, $method], []);
        }

        $this->commands(array_values($this->commands));
    }

    protected function registerInstallCommand()
    {
        $this->app->singleton('console.cms.install', function () {
            return new \App\Cms\Console\InstallCommand();
        });
    }

    protected function registerUpdateCommand()
    {
        $this->app->singleton('console.cms.update', function () {
            return new \App\Cms\Console\UpdateCommand();
        });
    }

    protected function registerTemplateCommand()
    {
        $this->app->singleton('console.cms.template', function () {
            return new \App\Cms\Console\TemplateCommand();
        });
    }
}
