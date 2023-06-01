<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit',
    [ContactController::class, 'submit']
)->name('contact-form');

Route::get('/contact/all-messages',
    [ContactController::class, 'allData']
)->name('contact-data');

Route::get('/contact/all-messages/{id}',
    [ContactController::class, 'showOneMessage']
)->name('contact-data-one');

Route::get('/contact/all-messages/{id}/update',
    [ContactController::class, 'updateMessage']
)->name('contact-update');

Route::post('/contact/all-messages/{id}/update',
    [ContactController::class, 'updateMessageSubmit']
)->name('contact-update-submit');

Route::get('/contact/all-messages/{id}/delete',
    [ContactController::class, 'deleteMessage']
)->name('contact-delete');
