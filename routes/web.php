<?php

use App\Http\Controllers\Auth\loginController;
use App\Http\Livewire\Home\Home;
use App\Http\Livewire\Registros\Registros;
use App\Http\Livewire\Registros\Welcome;
use Illuminate\Support\Facades\Route;

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
Route::get('/', Welcome::class)->name('welcome')->middleware('guest');
Route::get('/registros/{id}', Registros::class)->name('registro')->middleware('guest');
Route::get('/iniciar', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/iniciar', [loginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', Home::class)->name('home')->middleware('auth');

