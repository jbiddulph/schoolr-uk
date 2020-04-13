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

//Administration
Route::get('/admin', 'AdministrationController@index');

//company
Route::get('/company/{id}/{company}', 'CompanyController@index')->name('company.index');
Route::get('/company/create', 'CompanyController@create')->name('company.view');
Route::post('/company/create', 'CompanyController@store')->name('company.store');
Route::post('/company/coverphoto', 'CompanyController@coverPhoto')->name('cover.photo');
Route::post('/company/logo', 'CompanyController@companyLogo')->name('company.logo');
Route::post('/company/branding', 'CompanyController@companyBrand')->name('company.branding');

// Company View
Route::View('register/company','register-company')->name('register.company');
Route::post('company/register', 'CompanyRegisterController@companyRegister')->name('company.register');

// User Profile
Route::get('user/profile', 'UserController@profile')->name('user.view');
Route::post('user/profile/create', 'UserController@profilestore')->name('profile.create');
Route::post('user/coverletter', 'UserController@coverletter')->name('cover.letter');
Route::post('user/identification', 'UserController@identification')->name('identification');
Route::post('user/avatar', 'UserController@avatar')->name('avatar');

// Properties
Route::get('/properties/{id}/edit', 'PropertyController@edit')->name('property.edit');
Route::post('/properties/{id}/edit', 'PropertyController@update')->name('property.update');
//Route::post('/properties/{id}/edit', 'PropertyController@toggleLive')->name('property.togglelive');
Route::get('/changeStatus', 'PropertyController@toggleLive')->name('property.togglelive');
Route::get('/properties/{id}/uploads-edit', 'PropertyController@propuploadsedit')->name('property.uploadsedit');
Route::post('/properties/{id}/uploads-edit', 'PropertyController@propImageUpdate')->name('property.propImageUpdate');
//Route::post('/properties/{id}/uploads-edit', 'PropertyController@brochureUpdate')->name('property.brochureUpdate');
//Route::post('/properties/{id}/uploads-edit', 'PropertyController@floorplanUpdate')->name('property.floorplanUpdate');
Route::get('/properties/{id}/{property}', 'PropertyController@show')->name('properties.show');
Route::get('/properties/{id}/{property}/addphotos', 'PropertyController@addphotos')->name('properties.addphotos');
Route::post('/propertyphoto/add', 'PropertyController@propertyPhoto')->name('property.photo');
Route::get('/property/create', 'PropertyController@create')->name('property.create')->middleware(['auth','check-subscription']);
Route::get('/property/my-property', 'PropertyController@myProperty')->name('property.myproperty');
Route::get('/properties/all-properties', 'PropertyController@allProperties')->name('allproperties');
Route::post('/property/create', 'PropertyController@store')->name('property.store');
Route::post('/property/interest/{id}', 'PropertyController@interest')->name('property.interest');
Route::get('/properties/applications', 'PropertyController@applicant')->name('applicants');

//Venues
Route::get('/venues/all', 'VenueController@index')->name('venues.show');
Route::post('/venues/all', 'VenueController@index')->name('venues');
Route::get('/venues/towns/{town}', 'VenueController@town')->name('venues.town');
Route::get('/venues/{town}/{name}/{id}', 'VenueController@venue')->name('venue.name');

//Save and unsave property
Route::post('/saveproperty/{id}', 'FavouriteController@saveProperty');
Route::post('/unsaveproperty/{id}', 'FavouriteController@unsaveProperty');

//Subscribe
Route::get('/subscribe', 'SubscriptionController@payment');
Route::post('/subscribe', 'SubscriptionController@subscribe');


Route::group(['middleware'=>'role:super-admin'], function (){
    Route::resource('admin/permission', 'Admin\\PermissionController');
    Route::resource('admin/role', 'Admin\\RoleController');
    Route::resource('admin/user', 'UserController');
});


