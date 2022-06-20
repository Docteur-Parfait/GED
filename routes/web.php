<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// Authentification
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/','UtilisateurController@login')->name('login');


// Les routes pour l'admin 
Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
Route::get('corbeille','DocumentController@corbeille')->name('documents.corbeille');
Route::resource('utilisateur', 'UtilisateurController');
Route::resource('documents', 'DocumentController');

// Deconnexion
Route::get('logout', function(){
    Session::flush();

    return redirect(route('login'));
})->name('logout');

// Les routes pour l'utilisateur 
Route::get('liste-des-documents', 'DocumentController@userIndex')->name('document.user.index');