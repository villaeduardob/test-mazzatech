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

// Route::get('/', 'LoginController@index')->name('login');

Route::get('patients', 'PatientsController@index')->name('patients');
Route::post('patients/store', 'PatientsController@store')->name('patients.store');
Route::get('patients/{id}', 'PatientsController@edit')->name('patients.edit');
Route::put('patients/update', 'PatientsController@update')->name('patients.update');
Route::get('patients/delete/{id}', 'PatientsController@destroy')->name('patients.destroy');
