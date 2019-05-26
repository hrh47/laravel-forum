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


Route::get('/', 'GroupsController@index');

Route::resource('groups', 'GroupsController');
Route::post('/groups/{group}/join', ['as' => 'groups.join', 'uses' => 'GroupsController@join']);
Route::post('/groups/{group}/quit', ['as' => 'groups.quit', 'uses' => 'GroupsController@quit']);

Route::resource('groups.posts', 'PostsController');

Auth::routes();