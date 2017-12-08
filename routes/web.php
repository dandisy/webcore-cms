<?php

use App\Models\Page;
//use App\Models\MenuItem;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Contracts\Filesystem\Filesystem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('home');
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', function () {
//     return MenuItem::renderAsHtml();
// });

Route::get('/admin', function () {
    //if(Laratrust::hasRole(['administrator','superadministrator'])) {
        return redirect('admin/home');
    /*} else {
        return redirect('home');
    }*/
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('home', 'HomeController@index');

    Route::get('menus', function () {
        return view('admin.menus.index');
    });

    Route::group(['middleware' => ['role:superadministrator|administrator|verificator|user']], function () {
        Route::resource('posts', 'PostController');
        // Route::post('importPost', 'PostController@import');

        Route::resource('pages', 'PageController');

        Route::resource('users', 'UserController');
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

Route::get('/img/{path}', function(Filesystem $filesystem, $path) {
    $server = ServerFactory::create([
        'response' => new LaravelResponseFactory(app('request')),
        'source' => $filesystem->getDriver(),
        'cache' => $filesystem->getDriver(),
        'cache_path_prefix' => '.cache',
        'base_url' => 'img',
    ]);

    return $server->getImageResponse($path, request()->all());

})->where('path', '.*');

Route::get('/{uri}/{all?}', 'PageController@index')
    ->where('uri', '(?!filemanager)(?!admin)(?!register$)(?!login$)(?!logout$)([A-Za-z0-9\-]+)')
    ->where('all', '.*');
