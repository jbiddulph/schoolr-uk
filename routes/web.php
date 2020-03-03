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

//company
Route::get('/company/{id}/{company}', 'CompanyController@index')->name('company.index');
Route::get('/company/create', 'CompanyController@create')->name('company.view');
Route::post('/company/create', 'CompanyController@store')->name('company.store');
Route::post('/company/coverphoto', 'CompanyController@coverPhoto')->name('cover.photo');
Route::post('/company/logo', 'CompanyController@companyLogo')->name('company.logo');

// Company View
Route::View('register/company','register-company')->name('register.company');
Route::post('company/register', 'CompanyRegisterController@companyRegister')->name('company.register');

// User Profile
Route::get('user/profile', 'UserController@index')->name('user.view');
Route::post('user/profile/create', 'UserController@store')->name('profile.create');
Route::post('user/coverletter', 'UserController@coverletter')->name('cover.letter');
Route::post('user/avatar', 'UserController@avatar')->name('avatar');

// Properties
Route::get('/properties/{id}/edit', 'PropertyController@edit')->name('property.edit');
Route::get('/properties/{id}/{property}', 'PropertyController@show')->name('properties.show');
Route::get('/properties/{id}/{property}/addphotos', 'PropertyController@addphotos')->name('properties.addphotos');
Route::post('/propertyphoto/add', 'PropertyController@propertyPhoto')->name('property.photo');
Route::get('/property/create', 'PropertyController@create')->name('property.create');
Route::get('/property/my-property', 'PropertyController@myProperty')->name('property.myproperty');
Route::post('/property/create', 'PropertyController@store')->name('property.store');

