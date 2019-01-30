<?php
Route::group([
    'namespace' => 'App\Cms\Modules\sitemap\Controllers',
    'middleware' => ['web', 'multilang-cms'],
    'prefix' => env('CMS_URL', 'panel'),
    ], function(){
        Route::resource('/modules/sitemap', 'SitemapController');
    }
);

//Site routes
Route::group([
    'namespace' => 'App\Cms\Controllers',
    'middleware' => ['web'],
    ], function(){
        Route::get('/sitemap.xml', '\App\Cms\Modules\sitemap\Controllers\SitemapController@sitemap');
    }
);
