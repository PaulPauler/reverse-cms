<?php
Route::group([
    'namespace' => 'App\Cms\Modules\feedback\Controllers',
    'middleware' => ['web', 'multilang-cms'],
    'prefix' => env('CMS_URL', 'panel'),
    ], function(){
        Route::resource('/modules/feedback', 'FeedbackController');
        Route::post('/modules/feedback/delete', 'FeedbackController@deleteFeedback')->name('feedback.delete');
        Route::post('/modules/feedback/truncate', 'FeedbackController@truncateFeedbackTable')->name('feedback.truncate');
        Route::get('/modules/feedback/answer/{message_id}', 'FeedbackController@answer');
        Route::post('/modules/feedback/answer', 'FeedbackController@sendAnswer')->name('feedback.answer');
    }
);

//Site routes
Route::group([
    'namespace' => 'App\Cms\Modules\feedback\Controllers',
    'middleware' => ['web'],
    ], function(){
        Route::post('/feedback', 'FeedbackSiteController@store');
    }
);
