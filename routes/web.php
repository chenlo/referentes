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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
    	$users = Referentes\User::all();
        return view('home')->with('users', $users);;
   });
});
Route::get('/home', function () {
    $users = Referentes\User::all();
    return view('home')->with('users', $users);
});

Route::get('referentes/user', 'ReferenteController@indexByUser');
Route::resource('referentes', 'ReferenteController');

Route::resource('lenguas', 'LenguaController');

Route::resource('tipos', 'TipoController');

Route::get('cambios/create/{id}', 'CambioController@create');
Route::resource('cambios', 'CambioController');


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');