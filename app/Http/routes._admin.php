<?php

Route::group(['prefix' => 'cp'], function($router)
{
    Route::resource('/', 'Admin\HomeController');

    Route::resource('offers', 'Admin\OffersController');

    View::composer('admin.parts.aside', function($view){
        $admin = Auth::user();
        $view->with(compact('admin'));
    });
    View::composer('admin.parts.header', function($view){
        $admin = Auth::user();
        $view->with(compact('admin'));
    });
});