<?php
Route::group([
    'namespace' => 'App\Cms\Modules\example\Controllers',
    'middleware' => ['web', 'multilang-cms'],
    'prefix' => env('CMS_URL', 'panel'),
    ], function(){
        Route::resource('/modules/example', 'ExampleController');
    }
);
