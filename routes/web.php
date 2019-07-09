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

    Route::post('quiz/store','UserController@store')->name('quiz.store');

    Route::get('show', 'CategoryController@show');

    Route::delete('{category}', 'CategoryController@destroy');

    Route::patch('{category}', 'CategoryController@edit');

    Route::get('create', 'CategoryController@create');

    Route::post('store', 'CategoryController@store');
});

Route::post('/results/store','ResultsController@storeResults');

Route::prefix('user')->group(function () {
    Route::get('wordsLearned', 'UserController@wordsLearned');

    Route::get('check/', 'UserController@check')->name('quiz.check');

    Route::get('quiz/{categoryId}/{lessonId}', 'UserController@showQuiz');

    Route::get('lessons', 'UserController@showCategories');

    Route::get('quiz/{categoryId}/{lessonId}', 'UserController@showQuiz');

    Route::get('lessons', 'UserController@showCategories');

    Route::get('displayList', 'UserController@displayList');

    Route::get('{userId}', 'UserController@displayProfile');
});

Route::get('/makeLesson/{categoryid}', 'UserController@makeLesson');

Route::get('/profile/{profileId}/follow', 'UserController@followUser')->name('user.follow');
Route::get('/{profileId}/unfollow', 'UserController@unFollowUser')->name('user.unfollow');
