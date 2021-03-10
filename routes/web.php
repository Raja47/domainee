<?php

use Illuminate\Support\Facades\Route;
    
    Route::get('/', 'Site\HomeController@leads')->name('leads');
    
    Route::get('/admin/login', 'Cms\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Cms\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Cms\LoginController@logout')->name('admin.logout');
    
  
    Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin'], function () {
        
        Route::get('/dashboard','Cms\HomeController@index' )->name('admin.dashboard');
       
        Route::group(['prefix' => 'leads'], function () {
            Route::get('/', 'Cms\LeadController@index')->name('admin.leads.index');
            Route::get('/create', 'Cms\LeadController@create')->name('admin.leads.create');
            Route::post('/store', 'Cms\LeadController@store')->name('admin.leads.store');
            Route::get('/edit/{id}', 'Cms\LeadController@edit')->name('admin.leads.edit');
            Route::get('/{id}/delete', 'Cms\LeadController@delete')->name('admin.leads.delete');
            Route::post('/update', 'Cms\LeadController@update')->name('admin.leads.update');
        });
        
        Route::group(['prefix'  =>   'categories'], function() {
            Route::get('/', 'Cms\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Cms\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Cms\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Cms\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/update', 'Cms\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Cms\CategoryController@delete')->name('admin.categories.delete');
        });
});







