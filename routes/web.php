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
Auth::routes();

Route::get('/notes', function (){
    return view('notes');
});


Route::get('/', 'homeController@index' );
Route::get('/dashboard', 'DashbordController@index' );


Route::get('/test/{quiz}','TestController@index');

Route::post('/userAnswer', 'UserAnswerController@add');

Route::get('/answers/{id}/edit','AnswersController@edit');
Route::get('/answers/{id}/delete','AnswersController@destroy');
Route::PATCH('/answers/{id}/update','AnswersController@update');


Route::post('/categories','CategoriesController@store');
Route::get('/categories', 'CategoriesController@index');
Route::get('/categories/{id}/delete','CategoriesController@destroy');



Route::post('/questions','QuestionsController@store');
Route::get('/questions', 'QuestionsController@index');
Route::get('/questions/create', 'QuestionsController@create');
Route::get('/questions/{id}/details', 'QuestionsController@show');

Route::get('/questions/{id}/edit', 'QuestionsController@edit');
Route::patch('/questions/{id}/update','QuestionsController@update');
Route::get('/questions/{id}/delete','QuestionsController@destroy');



Route::get('/admin', 'AdminController@index');

Route::post('/quizzes','QuizzesController@store');
Route::get('/quizzes/{quiz}/details', 'QuizzesController@details');
Route::get('/quizzes/create', 'QuizzesController@create');
Route::get('/quizzes/{quiz}/edit', 'QuizzesController@edit');
Route::get('/quizzes/{quiz}/preview/{questionId?}', 'QuizzesController@preview');
Route::post('/quizzes/{question_id}/setAnswer','QuizzesController@setAnswer');


Route::patch('/quizzes/{quiz}/update', 'QuizzesController@update');
Route::post('/quizzes/{quiz}/addQuestions', 'QuizzesController@addQuestions');
Route::post('/quizzes/question/attach', 'QuizzesController@addQuestions');
Route::post('/quizzes/question/detach', 'QuizzesController@removeQuestions');
Route::get('/quizzes/getQuestion', 'QuizzesController@getQuestion');
Route::get('/assessment', 'QuizzesController@assessment');



Route::get('/home', 'HomeController@index')->name('home');
/*
Route::get('/admin', function(){
    echo "Hello Admin";
})->middleware('auth','admin');
*
Route::get('/visitor', function(){

    echo "Hello Visitor";
})->middleware('auth','visitor');


Route::get('/cadet', function(){
    echo "Hello Cadet";
})->middleware('auth','cadet');
*/
