<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DashboardController;

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
    return redirect()->route('login');
})->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'indexTable'])->middleware(['auth'])->name('dashboard');

Route::get('/criados', [DashboardController::class, 'index'])->middleware(['auth'])->name('criados');

Route::get('/dashboard/tickets/table', [DashboardController::class, 'ticketsTableAjax'])->middleware(['auth'])->name('dashboard.tickets.table');

Route::get('/dashboard/thread/entry/{thread_id}', [DashboardController::class, 'threadEntryAjax'])->middleware(['auth'])->name('dashboard.thread.entry');

Route::get('/emails', [EmailController::class, 'index'])->middleware(['auth'])->name('emails');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
