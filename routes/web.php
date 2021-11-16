<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::resource('note', App\Http\Controllers\NoteController::class);
Route::get('mynotes', 'App\Http\Controllers\NoteController@mynotes')->name('mynotes');
Route::get('liked', 'App\Http\Controllers\NoteController@liked')->name('liked');
Route::get('share/create/{note}', 'App\Http\Controllers\NoteController@sharecreate')->name('share.create');
Route::post('share/store/{note}', 'App\Http\Controllers\NoteController@share')->name('share.store');
Route::get('shared', 'App\Http\Controllers\NoteController@shared')->name('shared');
Route::get('like/{note}', 'App\Http\Controllers\NoteController@like')->name('like');
Route::post('filterbyTag', 'App\Http\Controllers\TagController@filter')->name('filter');
Route::resource('tag', App\Http\Controllers\TagController::class);
Route::get('profil', 'App\Http\Controllers\UserController@index')->name('profil');

//
