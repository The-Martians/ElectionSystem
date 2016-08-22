<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//User
Route::get('/', 'User\UserController@election');

Route::get('/select/{id}', 'User\UserController@electionSelect');
Route::post('/select/', 'User\UserController@electionSelectPost');

///
Route::get('/view/{id}', 'ScoreController@election');

Route::get('/page/{id}','User\UserController@page');
//Auth
Route::get('/admin', 'Admin\AdminController@index');

Route::get('/admin/login', 'Admin\AuthController@login');
Route::post('/admin/login', 'Admin\AuthController@loginPost');

Route::get('/admin/register', 'Admin\AuthController@registerAdmin');
Route::post('/admin/register', 'Admin\AuthController@registerAdminPost');

Route::get('/admin/logout', 'Admin\AuthController@logout');

//AdminPanel
Route::get('/admin/setting', 'Admin\AdminController@setting');
Route::post('/admin/setting', 'Admin\AdminController@settingPost');

Route::get('/admin/students', 'Admin\AdminController@students');

Route::get('/admin/students/add', 'Admin\AdminController@studentsAdd');
Route::post('/admin/students/add', 'Admin\AdminController@studentsAddPost');

Route::get('/admin/students/edit/{id}', 'Admin\AdminController@studentsEdit');
Route::post('/admin/students/edit/', 'Admin\AdminController@studentsEditPost');

Route::get('/admin/students/delete/{id}', 'Admin\AdminController@studentsDelete');
Route::post('/admin/students/delete/', 'Admin\AdminController@studentsDeletePost');

Route::get('/admin/users', 'Admin\AdminController@users');

Route::get('/admin/users/add', 'Admin\AdminController@usersAdd');
Route::post('/admin/users/add', 'Admin\AdminController@usersAddPost');

Route::get('/admin/users/edit/{id}', 'Admin\AdminController@usersEdit');
Route::post('/admin/users/edit/', 'Admin\AdminController@usersEditPost');

Route::get('/admin/users/delete/{id}', 'Admin\AdminController@usersDelete');
Route::post('/admin/users/delete/', 'Admin\AdminController@usersDeletePost');

Route::get('/admin/election/add', 'Admin\AdminController@electionsAdd');
Route::post('/admin/election/add', 'Admin\AdminController@electionsAddPost');

Route::get('/admin/election/edit/{id}', 'Admin\AdminController@electionsEdit');
Route::post('/admin/election/edit/', 'Admin\AdminController@electionsEditPost');

Route::get('/admin/election/delete/{id}', 'Admin\AdminController@electionsDelete');
Route::post('/admin/election/delete/', 'Admin\AdminController@electionsDeletePost');

Route::get('/admin/election/addpeople/{id}', 'Admin\AdminController@electionsAddpeople');
Route::post('/admin/election/addpeople/', 'Admin\AdminController@electionsAddpeoplePost');

Route::get('/admin/election/addpeople/{idE}/delete/{idS}', 'Admin\AdminController@electionsDeletepeoplePost');

//Auth

Route::get('/login', 'User\AuthController@login');
Route::post('/login', 'User\AuthController@loginPost');

Route::get('/logout', 'User\AuthController@logout');


Route::get('/admin/election/view/{id}', 'ScoreController@election');

