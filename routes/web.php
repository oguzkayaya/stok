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

Route::get('/suppliers', 'SupplierController@index');
Route::post('/suppliers', 'SupplierController@store');
// Route::delete('/suppliers/{supplier}', 'SupplierController@delete');
Route::post('/deleteSupplier', 'SupplierController@delete');

Route::get('/expenses', 'ExpenseController@index');
Route::get('/expenses/create', 'ExpenseController@create');
Route::post('/expenses', 'ExpenseController@store');
Route::get('/expenses/{expense}', 'ExpenseController@show');
Route::post('/expenses/{expense}', 'ExpenseController@update');


Route::post('/getExpenseProducts', 'ProductController@getExpenseProducts');
Route::post('/deleteExpenseProducts/', 'ProductController@deleteExpenseProduct');


Route::get('/customers', 'CustomerController@index');
Route::get('/getCustomers', 'CustomerController@getCustomers');
Route::delete('/customers/{id}', 'CustomerController@delete');
Route::post('/customers', 'CustomerController@store');

Route::get('/incomes', 'IncomeController@index');
Route::get('/incomes/{any}', 'IncomeController@index')->where('any', '.*');
Route::get('/getIncomes', 'IncomeController@getIncomes');
Route::post('/incomes', 'IncomeController@store');
Route::delete('/incomes/{id}', 'IncomeController@delete');
Route::get('/getIncome', 'IncomeController@getIncome');
Route::post('/updateIncomes', 'IncomeController@update');

Route::get('/getProducts', 'ProductController@getProducts');


Route::get('/status', 'StatusController@index');
Route::get('/getStatus', 'StatusController@getStatus');

Route::get('/personnels', 'PersonnelController@index');
Route::get('/getPersonnels', 'PersonnelController@getPersonnels');
Route::delete('/personnels/{id}', 'PersonnelController@delete');
Route::post('/personnels', 'PersonnelController@store');
Route::get('/personnel/{any}', 'PersonnelController@index')->where('any', '.*');
Route::get('/getPayments', 'PersonnelController@getPayments');
Route::delete('/payments/{id}', 'PersonnelController@deletePayment');
Route::post('/payments', 'PersonnelController@paymentStore');


