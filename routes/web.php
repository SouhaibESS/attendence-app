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

Route::get('/admin/filiere/{filiere}', 'FiliereController@show')->middleware('can:isAdmin')->name('filieres.show');
Route::get('/admin/filiere/create', 'FiliereController@create')->middleware('can:isAdmin')->name('filieres.create');
Route::post('/admin/filiere', 'FiliereController@store')->middleware('can:isAdmin')->name('filieres.store');
Route::get('/admin/student', 'StudentController@create')->middleware('can:isAdmin')->name('students.create');
Route::post('/admin/student', 'StudentController@store')->middleware('can:isAdmin')->name('students.store');
Route::get('/admin/student/{student}/edit', 'StudentController@edit')->middleware('can:isAdmin')->name('students.edit');
Route::put('/admin/student/{student}/edit', 'StudentController@update')->middleware('can:isAdmin')->name('students.update');
Route::delete('/admin/student/{student}', 'StudentController@destroy')->middleware('can:isAdmin')->name('students.destroy');
Route::get('/admin/module/create', 'ModuleController@create')->middleware('can:isAdmin')->name('modules.create');
Route::post('/admin/module', 'ModuleController@store')->middleware('can:isAdmin')->name('modules.store');

Route::get('/management', 'UserController@managerIndex')->middleware('can:isManager')->name('manager.index');
Route::get('/management/filiere/{filiere}', 'UserController@mShowFiliere')->middleware('can:isManager')->name('manager.filiere.show');
Route::get('/management/student/{student}', 'UserController@mShowstudent')->middleware('can:isManager')->name('manager.student.show');
Route::put('/management/student/{student}', 'UserController@mJustifyAbsence')->middleware('can:isManager')->name('manager.justify');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/matiere/{matiere}', 'HomeController@matiereShow')->middleware('can:isTeacher')->name('matiere.show');
Route::get('/filiere/{filiere}/matiere/{matiere}', 'HomeController@filiereShow')->middleware('can:isTeacher')->name('filiere.show');
Route::post('/filiere/{filiere}/matiere/{matiere}', 'HomeController@storeAbsence')->middleware('can:isTeacher')->name('absence.store');
Route::post('/student', 'StudentController@find')->name('student.find');
Route::get('/student/{student}', 'StudentController@show')->name('student.show');

Route::resource('/users', 'UserController');