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

Route::get('requests/index', 'RequestController@index');
Route::get('requests/create', 'RequestController@create');
Route::post('requests/create', 'RequestController@create');
Route::post('requests/store', 'RequestController@store');

Route::get('exceptions/index', 'ExceptionController@index');
Route::get('exceptions/create', 'ExceptionController@create');
Route::post('exceptions/create', 'ExceptionController@create');
Route::post('exceptions/store', 'ExceptionController@store');

Route::get('profiles/create', 'ProfileController@create');
Route::post('profiles/create', 'ProfileController@create');
Route::post('profiles/store', 'ProfileController@store');
Route::get('profiles/{id}', 'ProfileController@show');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('home', 'HomeController@index');

    Route::resource('menus', 'MenuController');

    Route::group(['middleware' => ['role:superadministrator|administrator|verificator|user']], function () {
        Route::resource('information', 'InformationController');
        Route::post('importInformation', 'InformationController@import');

        Route::resource('regulations', 'RegulationController');
        Route::post('importRegulation', 'RegulationController@import');

        Route::resource('archives', 'ArchiveController');
        Route::post('importArchive', 'ArchiveController@import');

        Route::resource('pages', 'PageController');

        /*Route::resource('components', 'ComponentController');*/

        Route::resource('requests', 'RequestController');

        Route::resource('exceptions', 'ExceptionController');

        Route::resource('responses', 'ResponseController');
        Route::post('importResponse', 'ResponseController@import');

        Route::resource('faqs', 'FaqController');
        Route::post('importFaq', 'FaqController@import');

        Route::resource('types', 'TypeController');
        Route::post('importType', 'TypeController@import');

        Route::resource('categories', 'CategoryController');
        Route::post('importCategory', 'CategoryController@import');

        Route::resource('formats', 'FormatController');
        Route::post('importFormat', 'FormatController@import');

        Route::resource('origins', 'OriginController');
        Route::post('importOrigin', 'OriginController@import');

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
