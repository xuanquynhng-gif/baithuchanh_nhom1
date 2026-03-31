<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AccountController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/sach', 'App\Http\Controllers\ViduLayoutController@sach');
Route::get('/sach/theloai/{id}', 'App\Http\Controllers\ViduLayoutController@theloai');
Route::get('/sach/chitiet/{id}', 'App\Http\Controllers\ViduLayoutController@chitiet');

Route::get('/book/create', 'App\Http\Controllers\BookController@bookcreate')
    ->middleware('auth')->name("bookcreate");
Route::get('/book/edit/{id}', 'App\Http\Controllers\BookController@bookedit')
    ->middleware('auth')->name("bookedit");
Route::post('/book/save/{action}', 'App\Http\Controllers\BookController@booksave')
    ->middleware('auth')->name("booksave");
Route::post('/book/delete', 'App\Http\Controllers\BookController@bookdelete')
    ->middleware('auth')->name("bookdelete");
Route::get('/book/list', 'App\Http\Controllers\BookController@booklist')
    ->middleware('auth')->name("booklist");
    
Route::get('/accountpanel', 'App\Http\Controllers\AccountController@accountpanel')
    ->middleware('auth')->name("account");
Route::post('/account/save', [AccountController::class, 'saveaccountinfo'])->name('saveaccount');   
