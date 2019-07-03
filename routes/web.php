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
    return \Hash::make('123123');
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
        Route::get('{id}/edit', 'UserController@showEditUserForm');
        Route::put('{id}/update', 'UserController@update');
        Route::delete('{id}', 'UserController@delete');
        Route::match(['GET', 'POST'],'{id}/changeStatus', 'UserController@changeStatus');
    });

    Route::prefix('projects')->group(function () {
        Route::get('/', 'ProjectController@index');
        Route::get('add', 'ProjectController@showAddProjectForm');
        Route::post('/', 'ProjectController@insert');
        Route::get('{id}/edit', 'ProjectController@showProjectDetailForm');
        Route::post('{id}/update', 'ProjectController@update');
        Route::match(['GET', 'POST'],'{id}/changeStatus', 'ProjectController@changeStatus');
        Route::post('{id}/users', 'ProjectController@addUser');
        Route::match(['GET', 'POST'],'{id}/users/{userId}/del', 'ProjectController@delUser');
        Route::post('{id}/documents', 'ProjectController@addFile');
        Route::match(['GET', 'POST'], '{id}/documents/{projectId}/del', 'ProjectController@delFile');
    });

    Route::prefix('technologies')->group(function () {
        Route::get('/', 'TechnologyController@index');
        Route::get('add', 'TechnologyController@showAddTechnologyForm');
        Route::post('/', 'TechnologyController@insert');
        Route::get('{id}/edit', 'TechnologyController@showEditTechnologyForm');
        Route::post('{id}/update', 'TechnologyController@update');
        Route::delete('{id}', 'TechnologyController@delete');
    });
});

