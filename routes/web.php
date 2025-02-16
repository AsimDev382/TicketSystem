<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\EmailController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use App\Http\Resources\User;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


// Routes for authenticated users with the 'admin' role
Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class)->only(['index', 'show', 'create', 'destroy']);
    Route::post('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    Route::post('/tickets/{ticket}/assign', [TicketController::class, 'assignToAdmin'])->name('tickets.assignToAdmin');
// });

// Routes for authenticated users with the 'user' role
// Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('tickets', TicketController::class)->only(['index', 'show', 'create', 'store']);
    Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store'])->name('replies.store');

    Route::get('/filter-tickets', [TicketController::class, 'filter'])->name('filter.tickets');


});






require __DIR__.'/auth.php';
