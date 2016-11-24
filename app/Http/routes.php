<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/'                   , 'home@index'   )->name('home');
Route::get('/admin'              , 'admin@index'  )->middleware('AuthUser')->name('admin');

Route::post('/signin'             , 'admin@signIn' )->name('signIn');
Route::get('/signout'             , 'admin@signOut' )->name('signOut');

Route::get('/admin/create'        , 'admin@createOrganization'  )->middleware('AuthUser')->name('adminOrganizationCreate');
Route::post('/admin/create'       , 'admin@saveNewOrganization' )->middleware('AuthUser')->name('adminOrganizationSaveNew');


Route::get('/admin/edit/{organization_id}'   , 'admin@editOrganization'        )->middleware('AuthUser')->name('adminOrganizationEdit');
Route::post('/admin/edit/{id}'               , 'admin@saveEditOrganization'    )->middleware('AuthUser')->name('adminSaveOrganizationEdit');

