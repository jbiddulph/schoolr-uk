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
Route::post('/company/branding', 'CompanyController@companyBrand')->name('company.branding');

// Company View
Route::View('register/company','register-company')->name('register.company');
Route::post('company/register', 'CompanyRegisterController@companyRegister')->name('company.register');

// Landlord View
Route::View('register/landlord','register-company')->name('register.landlord');
Route::post('landlord/register', 'LandlordRegisterController@landlordRegister')->name('landlord.register');

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

//Events
Route::get('/events/all', 'EventController@index')->name('events.show');

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


Route::post('/admin/searchvenues', 'VenueController@searchVenues')->name('search.venues');
Route::post('/admin/searchvenuetowns', 'VenueController@searchVenueTowns')->name('search.venuetowns');

Route::group(['middleware'=>'role:super-agent'], function () {
    Route::get('/admin/properties/{id}/{property}/addphotos', 'AdministrationController@addphotos')->name('adminproperty.addphotos');
});

Route::group(['middleware'=>'role:super-admin'], function (){
    Route::get('/admin', 'AdministrationController@index');
    Route::get('/admin/property', 'AdministrationController@property')->name('admin.property');
    Route::get('/admin/venue', 'AdministrationController@venue')->name('admin.venue');
    Route::get('/admin/event', 'AdministrationController@event')->name('admin.event');
    Route::resource('admin/permission', 'Admin\\PermissionController');
    Route::resource('admin/role', 'Admin\\RoleController');
    Route::resource('admin/user', 'UserController');
    Route::get('/changePropertyStatus', 'AdministrationController@togglePropertyLive')->name('adminproperty.togglelive');
    Route::get('/changeVenueStatus', 'AdministrationController@toggleVenueLive')->name('adminvenue.togglelive');
    //Edit Venues
    Route::get('/admin/venues/create', 'AdministrationController@venueCreate')->name('adminvenue.create');
    Route::post('/admin/venues/create', 'AdministrationController@venueStore')->name('adminvenue.store');
    Route::get('/admin/venues/{id}/edit', 'AdministrationController@venueEdit')->name('adminvenue.edit');
    Route::post('/admin/venues/{id}/edit', 'AdministrationController@venueUpdate')->name('adminvenue.update');
    Route::get('/admin/venues/{id}/uploads-edit', 'AdministrationController@venueuploadsedit')->name('adminvenue.uploadsedit');
    Route::post('/admin/venues/{id}/uploads-edit', 'AdministrationController@venueImageUpdate')->name('adminvenue.venueImageUpdate');
    //Edit Events
    Route::get('/admin/events/create', 'AdministrationController@eventCreate')->name('adminevent.create');
    Route::post('/admin/events/create', 'AdministrationController@eventStore')->name('adminevent.store');
    Route::get('/admin/events/{id}/edit', 'AdministrationController@eventEdit')->name('adminevent.edit');
    Route::post('/admin/events/{id}/edit', 'AdministrationController@eventUpdate')->name('adminevent.update');
    Route::get('/admin/events/{id}/uploads-edit', 'AdministrationController@eventuploadsedit')->name('adminevent.uploadsedit');
    Route::post('/admin/events/{id}/uploads-edit', 'AdministrationController@eventImageUpdate')->name('adminevent.eventImageUpdate');

    //Delete Events
    Route::get('/admin/event/delete/{id}', 'EventController@permanentDelete')->name('perm.delete');
    Route::get('/admin/event/soft/{id}', 'EventController@softDelete');
    Route::get('/admin/event/withsoftdelete','EventController@eventsWithSoftDelete');
    Route::get('/admin/event/softdeleted','EventController@softDeleted')->name('events.deleted');
    Route::get('/admin/event/{id}','EventController@restoreDeletedEvent')->name('event.restoredelete');
    Route::get('/admin/event/deletesoft/{id}','EventController@permanentDeleteSoftDeleted')->name('event.permdelete');

    //Edit Properties
    Route::get('/admin/properties/create', 'AdministrationController@propertyCreate')->name('adminproperty.create');
    Route::post('/admin/properties/create', 'AdministrationController@propertyStore')->name('adminproperty.store');
    Route::get('/admin/properties/{id}/edit', 'AdministrationController@propertyEdit')->name('adminproperty.edit');
    Route::post('/admin/properties/{id}/edit', 'AdministrationController@propertyUpdate')->name('adminproperty.update');
    Route::get('/admin/properties/{id}/{property}/addphotos', 'AdministrationController@addphotos')->name('adminproperty.addphotos');
    Route::post('/admin/propertyphoto/add', 'AdministrationController@propertyPhoto')->name('adminproperty.photo');
    Route::get('/admin/properties/{id}/uploads-edit', 'AdministrationController@propuploadsedit')->name('adminproperty.uploadsedit');
    Route::post('/admin/properties/{id}/uploads-edit', 'AdministrationController@propImageUpdate')->name('adminproperty.propImageUpdate');
});


