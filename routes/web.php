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

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'middleware' => 'can:isAdmin'], function () {
    
    Route::group(['prefix' => 'filiere'], function () {
        Route::get('{filiere}', 'FiliereController@show')->name('filieres.show');
        Route::get('', 'FiliereController@create')->name('filieres.create');
        Route::post('', 'FiliereController@store')->name('filieres.store');
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('create', 'StudentController@create')->name('students.create');
        Route::post('', 'StudentController@store')->name('students.store');
        Route::get('{student}/edit', 'StudentController@edit')->name('students.edit');
        Route::put('{student}/edit', 'StudentController@update')->name('students.update');
        Route::delete('{student}', 'StudentController@destroy')->name('students.destroy');
    });
    
    Route::group(['prefix' => 'module'], function () {
        Route::get('create', 'ModuleController@create')->name('modules.create');
        Route::post('', 'ModuleController@store')->name('modules.store');
    });
});

Route::group(['prefix' => 'management', 'middleware' => 'can:isManager'], function () {
    Route::get('', 'UserController@managerIndex')->name('manager.index');
    Route::get('/filiere/{filiere}', 'UserController@mShowFiliere')->name('manager.filiere.show');
    
    Route::group(['prefix' => 'student'], function () {
        Route::get('{student}', 'UserController@mShowstudent')->name('manager.student.show');
    Route::put('{student}', 'UserController@mJustifyAbsence')->name('manager.justify');
    });
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/matiere/{matiere}', 'HomeController@matiereShow')->middleware('can:isTeacher')->name('matiere.show');
Route::get('/filiere/{filiere}/matiere/{matiere}', 'HomeController@filiereShow')->middleware('can:isTeacher')->name('filiere.show');
Route::post('/filiere/{filiere}/matiere/{matiere}', 'HomeController@storeAbsence')->middleware('can:isTeacher')->name('absence.store');
Route::post('/student', 'StudentController@find')->name('student.find');
Route::get('/student/{student}', 'StudentController@show')->name('student.show');

Route::resource('/users', 'UserController')->except('show');