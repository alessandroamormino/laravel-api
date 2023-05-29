<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PageController::class, 'index'])->name('home.index');
// Route::get('admin/login', [PageController::class, 'login'])->name('admin.login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// creo le rotte di per le pagine di amministrazione
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function(){
    // inserisco le rotte che avranno il prefisso 'admin' nell'URI e nome della rotta preceduta da 'admin'
    Route::resource('projects', ProjectController::class)->parameters(['projects'=>'project:slug']);

    // richiamo il typecontroller 
    Route::resource('types', TypeController::class)->parameters(['types'=>'type:slug']);

    // richiamo il technology controller
    Route::resource('technologies', TechnologyController::class)->parameters(['technologies'=>'technology:slug']);

    // richiamo la pagina dashboard della cartella admin
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');

});

require __DIR__.'/auth.php';
