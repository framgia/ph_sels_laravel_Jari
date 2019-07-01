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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/routes', 'HomeController@admin')->middleware('admin');

Route::get('/admin/register', 'HomeController@adminRegister');

Route::resource('projects', 'ProjectsController');

Route::patch('/tasks/{task}', 'ProjectTasksController@update');


Route::prefix('category')->group(function () {

    Route::get('show', 'CategoryController@show');

    Route::delete('{category}', 'CategoryController@destroy');
    
    Route::patch('{category}', 'CategoryController@edit');

    Route::get('create', 'CategoryController@create');

    Route::post('', 'CategoryController@store');
});