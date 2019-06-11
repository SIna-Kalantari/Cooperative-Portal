<?php

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
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::match(['GET', 'POST'], 'logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('add', 'UserController@showAddUserForm');
        Route::post('/', 'UserController@insert');
        Route::get('edit/{id}', 'UserController@showEditUserForm');
        Route::post('update/{id}', 'UserController@update');
        Route::match(['GET', 'POST'],'changeStatus/{id}', 'UserController@changeStatus');
    });
});