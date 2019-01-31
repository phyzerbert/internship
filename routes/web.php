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

Route::get('/', 'WelcomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::get('/register/{role}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register/{role}', 'Auth\RegisterController@register');


Route::get('/search', 'PupilController@searchView')->name('pupil.searchView');
Route::post('/search', 'PupilController@search');
Route::get('/search/{company}', 'PupilController@apply')->name('pupil.apply');
Route::get('/companies', 'PupilController@companyView')->name('pupil.companyView');
Route::get('/pupils/profile', 'PupilController@profileView')->name('pupil.profileView');
Route::get('/pupils/profile/edit', 'PupilController@profileEdit')->name('pupil.profileEdit');
Route::put('/pupils/profile', 'PupilController@profileUpdate');
Route::post('/pupils/requesthours', 'PupilController@requesthours')->name('pupil.requesthours');

Route::get('/requests', 'CompanyController@requestsView')->name('company.requestsView');
Route::get('/requests/{companyPupil}', 'CompanyController@accept')->name('company.accept');
Route::get('/requests/{companyPupil}/decline', 'CompanyController@decline')->name('company.decline');
Route::get('/hours/{companyPupil}', 'CompanyController@accepthour')->name('company.accepthours');
Route::get('/hours/{companyPupil}/decline', 'CompanyController@declinehour')->name('company.declinehours');


Route::get('/hours', 'CompanyController@hoursView')->name('company.hoursView');
Route::get('/companies/pupils', 'CompanyController@pupilsView')->name('company.pupilsView');
Route::get('/companies/profile', 'CompanyController@profileView')->name('company.profileView');
Route::get('/companies/profile/edit', 'CompanyController@profileEdit')->name('company.profileEdit');
Route::put('/companies/profile', 'CompanyController@profileUpdate');

Route::get('/pupils', 'TeacherController@pupilsView')->name('teacher.pupilsView');
Route::get('/teachers/profile', 'TeacherController@profileView')->name('teacher.profileView');
Route::get('/teachers/profile/edit', 'TeacherController@profileEdit')->name('teacher.profileEdit');
Route::put('/teachers/profile', 'TeacherController@profileUpdate');
