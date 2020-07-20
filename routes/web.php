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

Route::get('/employees.index', [
    'uses' => 'HomeController@index',
    'as'   => 'employees.index'
]);

Route::get('/employees.index', [
    'uses' => 'EmployeeController@index',
    'as'   => 'employees.index'
]);

Route::post('/employees.store', [
    'uses' => 'EmployeeController@store',
    'as'   => 'employees.store'
]);

Route::post('/employees.update/{id}', [
    'uses' => 'EmployeeController@update',
    'as'   => 'employees.update'
]);

Route::get('/employees.destroy/{id}', [
    'uses' => 'EmployeeController@destroy',
    'as'   => 'employees.destroy'
]);


Route::get('/companies.index', [
    'uses' => 'CompaniesController@index',
    'as'   => 'companies.index'
]);

Route::post('/companies.store', [
    'uses' => 'CompaniesController@store',
    'as'   => 'companies.store'
]);

Route::post('/companies.update/{id}', [
    'uses' => 'CompaniesController@update',
    'as'   => 'companies.update'
]);

Route::get('/companies.destroy/{id}', [
    'uses' => 'CompaniesController@destroy',
    'as'   => 'companies.destroy'
]);