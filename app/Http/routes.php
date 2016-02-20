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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'ContactController@index');

Route::get('/contact/emailValidateUpdate/{email}/{id}', 'ContactController@validadeEmailUpdate');
Route::get('/contact/emailValidate/{email}', 'ContactController@validadeEmail');
Route::get('/contact/{id}/destroy', 'ContactController@destroy');
Route::resource('contact', 'ContactController', ['except' => ['destroy']]);

// https://laravel.com/docs/5.1/controllers#restful-resource-controllers
/*
GET	/contact	index	contact.index
GET	/contact/create	create	contact.create
POST	/contact	store	contact.store
GET	/contact/{contact}	show	contact.show
GET	/contact/{contact}/edit	edit	contact.edit
PUT/PATCH	/contact/{contact}	update	contact.update
DELETE	/contact/{contact}	destroy	contact.destroy
*/