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

Route::get('/', 'PropertyController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/properties/{id}/{property}', 'PropertyController@show')->name('properties.show');
Route::get('/properties/{id}/{property}/addphotos', 'PropertyController@addphotos')->name('properties.addphotos');
Route::post('/propertyphoto/add', 'PropertyController@propertyphoto')->name('property.photo');
//company
Route::get('/company/{id}/{company}', 'CompanyController@index')->name('company.index');
Route::get('/company/create', 'CompanyController@create');
// Company View
Route::View('register/company','register-company')->name('register.company');
Route::post('company/register', 'CompanyRegisterController@companyRegister')->name('company.register');
// User Profile
Route::get('user/profile', 'UserController@index');
Route::post('user/profile/create', 'UserController@store')->name('profile.create');
Route::post('user/coverletter', 'UserController@coverletter')->name('cover.letter');
Route::post('user/avatar', 'UserController@avatar')->name('avatar');
