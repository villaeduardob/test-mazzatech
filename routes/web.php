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

// home
Route::get('/', 'HomeController@index')->name('home');

// patients
Route::get('patients', 'PatientsController@index')->name('patients');
Route::post('patients/store', 'PatientsController@store')->name('patients.store');
Route::get('patients/{id}', 'PatientsController@edit')->name('patients.edit');
Route::put('patients/update', 'PatientsController@update')->name('patients.update');
Route::get('patients/delete/{id}', 'PatientsController@destroy')->name('patients.destroy');

// doctors
Route::get('doctors', 'DoctorsController@index')->name('doctors');
Route::post('doctors/store', 'DoctorsController@store')->name('doctors.store');
Route::get('doctors/{id}', 'DoctorsController@edit')->name('doctors.edit');
Route::put('doctors/update', 'DoctorsController@update')->name('doctors.update');
Route::get('doctors/delete/{id}', 'DoctorsController@destroy')->name('doctors.destroy');

// schedules
Route::get('schedules', 'SchedulesController@index')->name('schedules');
Route::post('schedules/store', 'SchedulesController@store')->name('schedules.store');
Route::get('schedules/{id}', 'SchedulesController@edit')->name('schedules.edit');
Route::put('schedules/update', 'SchedulesController@update')->name('schedules.update');
Route::get('schedules/delete/{id}', 'SchedulesController@destroy')->name('schedules.destroy');
