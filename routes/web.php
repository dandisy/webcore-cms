<?php

use App\Models\Admin\Page;
use App\Models\Admin\Menu;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', function () {
    //return redirect('home');

    return redirect('beranda');
});

//Route::get('home', 'HomeController@index');

Route::get('/admin', function () {
    //if(Laratrust::hasRole(['administrator','superadministrator'])) {
        return redirect('admin/home');
    /*} else {
        return redirect('beranda');
    }*/
});

Route::get('profiles/create', 'ProfileController@create');
Route::post('profiles/create', 'ProfileController@create');
Route::post('profiles/store', 'ProfileController@store');
Route::get('profiles/{id}', 'ProfileController@show');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('home', 'HomeController@index');

    Route::resource('menus', 'MenuController');

    Route::group(['middleware' => ['role:superadministrator|administrator|verificator|user']], function () {
        Route::resource('pages', 'PageController');

        Route::resource('categories', 'CategoryController');

        Route::resource('users', 'UserController');

        Route::resource('profiles', 'ProfileController');
    });

    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
        Route::resource('roles', 'RoleController');

        //Route::resource('permissions', 'PermissionController');

        Route::resource('settings', 'SettingController');
    });

    Route::group(['middleware' => ['role:superadministrator']], function () {
        //
    });
});

Route::get('/{slug}', 'PageController@index')
    ->where('slug', '(?!admin)(?!register$)(?!login$)(?!logout$)([A-Za-z0-9\-]+)');
