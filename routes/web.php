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
})->name('home')->middleware('auth');



Route::get('/register', 'LoginController@register');
Route::post('/register', 'LoginController@singup');
Route::get('/logout', 'LoginController@logout');
Route::get('/login', 'LoginController@loginPage')->name('login');
Route::post('/login', 'LoginController@login');

Route::get('/companies/create', 'CompanyController@create');
Route::post('/companies', 'CompanyController@store');

Route::get('/products', 'ProductController@index');
Route::post('/products', 'ProductController@store');
Route::delete('/products/{product}', 'ProductController@delete');
