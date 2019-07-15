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

Route::prefix('profile')->group(function () {
    Route::get('', 'ProfileController@index')->name('profile');

    Route::post('/update', 'ProfileController@updateProfile')->name('profile.update');
    
    Route::get('/{profileId}/follow', 'UserController@followUser')->name('user.follow');
    
});

Route::get('/{profileId}/unfollow', 'UserController@unFollowUser')->name('user.unfollow');

Route::prefix('question')->group(function (){
    Route::post('/storeQuestion', 'CategoryController@storeQuestion');

    Route::get('/addQuestion', 'CategoryController@addQuestion');

    Route::get('/addChoice', 'CategoryController@addChoice');

    Route::post('/storeChoice', 'CategoryController@storeChoice');
});

Route::prefix('category')->group(function () {

    Route::patch('{category}', 'CategoryController@edit');

    Route::post('quiz/store','UserController@store')->name('quiz.store');

    Route::get('edit', 'CategoryController@change');

    Route::delete('/destroy/{category}', 'CategoryController@destroy');

    Route::get('create', 'CategoryController@create');

    Route::post('store', 'CategoryController@store');
});

Route::post('/results/store','ResultsController@storeResults');

Route::prefix('user')->group(function () {
    Route::get('viewProfile/{userId}', 'UserController@viewProfile');

    Route::get('userProfile', 'UserController@userProfile');

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
