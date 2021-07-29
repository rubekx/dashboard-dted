<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

// Route::get('/dashboard', function () {    return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'indexTable'])->middleware(['auth'])->name('dashboard');

Route::get('/criados', [DashboardController::class, 'index'])->middleware(['auth'])->name('criados');

Route::get('/dashboard/tickets/table', [DashboardController::class, 'ticketsTableAjax'])->middleware(['auth'])->name('dashboard.tickets.table');

Route::get('/dashboard/thread/entry/{thread_id}', [DashboardController::class, 'threadEntryAjax'])->name('dashboard.thread.entry');

// Route::get('/dashboard/thread/entry/{thread_id}', [DashboardController::class, 'threadEntryAjax'])->middleware(['auth'])->name('dashboard.thread.entry');
// Route::get('/total', [DashboardController::class, 'json2'])->middleware(['auth'])->name('dashboard.thread.total');
// Route::get('/tabela', [DashboardController::class, 'json1'])->middleware(['auth'])->name('dashboard.thread.tabela');

require __DIR__.'/auth.php';
