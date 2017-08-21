<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('menus', 'MenuAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('permissions', 'PermissionAPIController');

Route::resource('settings', 'SettingAPIController');

Route::resource('pages', 'PageAPIController');

Route::resource('components', 'ComponentAPIController');



Route::resource('regulations', 'RegulationAPIController');

Route::resource('information', 'InformationAPIController');

Route::resource('requests', 'RequestAPIController');

Route::resource('exceptions', 'ExceptionAPIController');

Route::resource('responses', 'ResponseAPIController');

Route::resource('faqs', 'FaqAPIController');

Route::get('admin/types', 'Admin\TypeAPIController@index');
Route::post('admin/types', 'Admin\TypeAPIController@store');
Route::get('admin/types/{types}', 'Admin\TypeAPIController@show');
Route::put('admin/types/{types}', 'Admin\TypeAPIController@update');
Route::patch('admin/types/{types}', 'Admin\TypeAPIController@update');
Route::delete('admin/types{types}', 'Admin\TypeAPIController@destroy');

Route::get('admin/types', 'Admin\TypeAPIController@index');
Route::post('admin/types', 'Admin\TypeAPIController@store');
Route::get('admin/types/{types}', 'Admin\TypeAPIController@show');
Route::put('admin/types/{types}', 'Admin\TypeAPIController@update');
Route::patch('admin/types/{types}', 'Admin\TypeAPIController@update');
Route::delete('admin/types{types}', 'Admin\TypeAPIController@destroy');

Route::get('admin/categories', 'Admin\CategoryAPIController@index');
Route::post('admin/categories', 'Admin\CategoryAPIController@store');
Route::get('admin/categories/{categories}', 'Admin\CategoryAPIController@show');
Route::put('admin/categories/{categories}', 'Admin\CategoryAPIController@update');
Route::patch('admin/categories/{categories}', 'Admin\CategoryAPIController@update');
Route::delete('admin/categories{categories}', 'Admin\CategoryAPIController@destroy');

Route::get('admin/archives', 'Admin\ArchiveAPIController@index');
Route::post('admin/archives', 'Admin\ArchiveAPIController@store');
Route::get('admin/archives/{archives}', 'Admin\ArchiveAPIController@show');
Route::put('admin/archives/{archives}', 'Admin\ArchiveAPIController@update');
Route::patch('admin/archives/{archives}', 'Admin\ArchiveAPIController@update');
Route::delete('admin/archives{archives}', 'Admin\ArchiveAPIController@destroy');

Route::get('admin/formats', 'Admin\FormatAPIController@index');
Route::post('admin/formats', 'Admin\FormatAPIController@store');
Route::get('admin/formats/{formats}', 'Admin\FormatAPIController@show');
Route::put('admin/formats/{formats}', 'Admin\FormatAPIController@update');
Route::patch('admin/formats/{formats}', 'Admin\FormatAPIController@update');
Route::delete('admin/formats{formats}', 'Admin\FormatAPIController@destroy');

Route::get('admin/origins', 'Admin\OriginAPIController@index');
Route::post('admin/origins', 'Admin\OriginAPIController@store');
Route::get('admin/origins/{origins}', 'Admin\OriginAPIController@show');
Route::put('admin/origins/{origins}', 'Admin\OriginAPIController@update');
Route::patch('admin/origins/{origins}', 'Admin\OriginAPIController@update');
Route::delete('admin/origins{origins}', 'Admin\OriginAPIController@destroy');