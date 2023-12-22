<?php

use App\Http\Controllers\ClientRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CostController;
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
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    Route::resource('projects', ProjectController::class);

    Route::resource('projects.costs', CostController::class)->except('show');

    Route::get('projects/{id}/costs/export', [CostController::class, 'export'])->name('projects.costs.export');

    Route::resource('client_requests', ClientRequestController::class)->except('store');

    Route::post('/requests/mark_all_as_read', [ClientRequestController::class, 'markAllAsRead']);
});

Route::post('client_requests/store', [ClientRequestController::class, 'store'])->name('client_requests.store');

require __DIR__.'/auth.php';
