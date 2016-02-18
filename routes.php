<?php


Route::get('login', 'JetCMS\User\Http\Controllers\LoginController@getLogin');
Route::post('login', 'JetCMS\User\Http\Controllers\LoginController@postLogin');

Route::get('registration', 'JetCMS\User\Http\Controllers\RegistrationController@getLogin');
Route::post('registration', 'JetCMS\User\Http\Controllers\RegistrationController@postLogin');