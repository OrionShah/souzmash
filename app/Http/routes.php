<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('register', 'IndexController@getRegister');
// Route::post('login', 'IndexController@postLogin');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin']], function () {
    Route::controller('/news', "NewsController");
    Route::controller('/pages', "PagesController");
    Route::controller('/users', "UsersController");
    Route::controller('/', "AdminController");
});
Route::group(['middleware' => ['static', 'web']], function () {
    Route::get('/{link}', 'StaticPagesController@getStaticPage');
});
Route::group(['middleware' => ['web']], function () {
    Route::controller('/post/{id}', 'IndexPostController');
    Route::controller('/', 'IndexController');
});

