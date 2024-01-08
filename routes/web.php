<?php

use App\Http\Controllers\ClientRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\ProblemController;
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

//Vadītāju pieejas
Route::middleware('role:1')->group(function (){
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}',  [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/accept', [UserController::class, 'accept'])->name('users.accept');
    Route::post('/users/{user}/deny', [UserController::class, 'deny'])->name('users.deny');

    Route::get('projects/create/{clientRequest}', [ProjectController::class, 'createWithClient'])->name('projects.create-with-client');
    Route::resource('projects.costs', CostController::class)->except('show');
    Route::get('projects/{id}/costs/export', [CostController::class, 'export'])->name('projects.costs.export');
    
    Route::post('/client_requests/mark_as_read/{clientRequest}', [ClientRequestController::class, 'markAsRead'])->name('client_requests.mark_as_read');
    Route::post('/client_requests/{client_request}/accept', [ClientRequestController::class, 'accept'])->name('client_requests.accept');
    Route::post('/client_requests/{client_request}/deny', [ClientRequestController::class, 'deny'])->name('client_requests.deny');

    Route::resource('client_requests', ClientRequestController::class)->except('store');

    Route::put('/problems/{problem}/close', [ProblemController::class, 'close'])->name('problems.close');

});

Route::middleware('auth')->group(function () {

    Route::resource('projects', ProjectController::class);
    Route::resource('projects.problems', ProblemController::class);
});

Route::post('client_requests/store', [ClientRequestController::class, 'store'])->name('client_requests.store');

require __DIR__.'/auth.php';
