<?php
//CMS routes
Route::group([
    'namespace' => 'App\Cms\Controllers',
    'middleware' => ['web'],
    'prefix' => env('CMS_URL', 'panel'),
    ], function(){
        Route::resource('/pages', 'PageController');
        Route::post('/pages/create', 'PageController@store')->name('pages.save');
        Route::post('/pages/create/{curpage}', 'PageController@store')->name('pages.save');
        Route::get('/pages/create/{curpage}', 'PageController@create')->name('pages.create');
        Route::post('/pages/delete', 'PageController@deletePage')->name('page.delete');
        Route::post('/pages/sortable', 'PageController@sortable');

        Route::resource('/account', 'AccountController');
        Route::get('/filemanager', 'FileController@index');

        if(config("cms.multilanguage") == 'on'){
          Route::resource('/languages', 'LanguagesController');
          Route::post('/languages/create', 'LanguagesController@store');
          Route::post('/languages/change', 'LanguagesController@changeContentLanguage')->name('language.change');
          Route::post('/languages/delete', 'LanguagesController@deleteLanguage')->name('language.delete');
        }

        Route::get('/', 'HomeController@index');
        Auth::routes();
    }
);

$middleware = array_merge(\Config::get('lfm.middlewares', []), [
    '\UniSharp\LaravelFilemanager\Middlewares\MultiUser',
    '\UniSharp\LaravelFilemanager\Middlewares\CreateDefaultFolder',
]);
$prefix = \Config::get('lfm.url_prefix', \Config::get('lfm.prefix', 'laravel-filemanager'));
$as = 'unisharp.lfm.';
$namespace = '\UniSharp\LaravelFilemanager\Controllers';

// make sure authenticated
Route::group(compact('middleware', 'prefix', 'as', 'namespace'), function () {

    // Show LFM
    Route::get('/', [
        'uses' => 'LfmController@show',
        'as' => 'show',
    ]);

    // Show integration error messages
    Route::get('/errors', [
        'uses' => 'LfmController@getErrors',
        'as' => 'getErrors',
    ]);

    // upload
    Route::any('/upload', [
        'uses' => 'UploadController@upload',
        'as' => 'upload',
    ]);

    // list images & files
    Route::get('/jsonitems', [
        'uses' => 'ItemsController@getItems',
        'as' => 'getItems',
    ]);

    // folders
    Route::get('/newfolder', [
        'uses' => 'FolderController@getAddfolder',
        'as' => 'getAddfolder',
    ]);
    Route::get('/deletefolder', [
        'uses' => 'FolderController@getDeletefolder',
        'as' => 'getDeletefolder',
    ]);
    Route::get('/folders', [
        'uses' => 'FolderController@getFolders',
        'as' => 'getFolders',
    ]);

    // crop
    Route::get('/crop', [
        'uses' => 'CropController@getCrop',
        'as' => 'getCrop',
    ]);
    Route::get('/cropimage', [
        'uses' => 'CropController@getCropimage',
        'as' => 'getCropimage',
    ]);
    Route::get('/cropnewimage', [
        'uses' => 'CropController@getNewCropimage',
        'as' => 'getCropimage',
    ]);

    // rename
    Route::get('/rename', [
        'uses' => 'RenameController@getRename',
        'as' => 'getRename',
    ]);

    // scale/resize
    Route::get('/resize', [
        'uses' => 'ResizeController@getResize',
        'as' => 'getResize',
    ]);
    Route::get('/doresize', [
        'uses' => 'ResizeController@performResize',
        'as' => 'performResize',
    ]);

    // download
    Route::get('/download', [
        'uses' => 'DownloadController@getDownload',
        'as' => 'getDownload',
    ]);

    // delete
    Route::get('/delete', [
        'uses' => 'DeleteController@getDelete',
        'as' => 'getDelete',
    ]);

    // Route::get('/demo', 'DemoController@index');
});

Route::group(compact('prefix', 'as', 'namespace'), function () {
    // Get file when base_directory isn't public
    $images_url = '/' . \Config::get('lfm.images_folder_name') . '/{base_path}/{image_name}';
    $files_url = '/' . \Config::get('lfm.files_folder_name') . '/{base_path}/{file_name}';
    Route::get($images_url, 'RedirectController@getImage')
        ->where('image_name', '.*');
    Route::get($files_url, 'RedirectController@getFile')
        ->where('file_name', '.*');
});

//Site routes
Route::group([
    'middleware' => ['web', 'multilang-site'],
    'namespace' => 'App\Cms\Controllers',
    ], function(){
        Route::get('setlocale/{locale}', 'SiteController@setLocale');
        Route::get('/{pages}', 'SiteController@show')->where('pages', '[^ ]+');
        Route::get('/', 'SiteController@index');
    }
);
