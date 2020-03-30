<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/matiere/{matiere}', 'HomeController@matiereShow')->middleware('can:isTeacher')->name('matiere.show');
Route::get('/filiere/{filiere}/matiere/{matiere}', 'HomeController@filiereShow')->middleware('can:isTeacher')->name('filiere.show');
Route::post('/filiere/{filiere}/matiere/{matiere}', 'HomeController@storeAbsence')->middleware('can:isTeacher')->name('absence.store');
Route::post('/student', 'StudentController@find')->name('student.find');
Route::get('/student/{student}', 'StudentController@show')->name('student.show');

Route::resource('/users', 'UserController');