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
Route::get('/', 'App\Http\Controllers\UserController@index')->name('login');
Route::get('/login', 'App\Http\Controllers\UserController@index')->name('login');
Route::post('/login/run', 'App\Http\Controllers\UserController@Login');
Route::get('/logout', 'App\Http\Controllers\UserController@Logout');


// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/callback', 'App\Http\Controllers\PaymentsController@callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/payments', 'App\Http\Controllers\PaymentsController@index')->name("home");;
    Route::get('/payment/create', 'App\Http\Controllers\CreatePaymentController@index');
    Route::post('/payment/store', 'App\Http\Controllers\CreatePaymentController@store');
    Route::post('/payment/store', 'App\Http\Controllers\CreatePaymentController@store');
    Route::get('/payment/test', 'App\Http\Controllers\CreatePaymentController@test');
    Route::post('/payment/success', 'App\Http\Controllers\PaymentsController@success');
    Route::get('/payment/error', 'App\Http\Controllers\PaymentsController@error');


    Route::get('/accounts', 'App\Http\Controllers\AccountsController@index');
    Route::get('/account/create', 'App\Http\Controllers\AccountsController@create');
    Route::get('/account/detail/{id}', 'App\Http\Controllers\AccountsController@detail');
    Route::post('/account/update/{id}', 'App\Http\Controllers\AccountsController@update');
    Route::post('/account/store', 'App\Http\Controllers\AccountsController@store');
    Route::get('/account/delete/{id}', 'App\Http\Controllers\AccountsController@delete');

    
    Route::get('/cards', 'App\Http\Controllers\CardsController@index');
    Route::get('/card/create', 'App\Http\Controllers\CardsController@create');
    Route::get('/card/detail/{id}', 'App\Http\Controllers\CardsController@detail');
    Route::post('/card/update/{id}', 'App\Http\Controllers\CardsController@update');
    Route::post('/card/store', 'App\Http\Controllers\CardsController@store');
    Route::get('/card/delete/{id}', 'App\Http\Controllers\CardsController@delete');


    
});

