<?php

use App\Http\Controllers\BookAuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookGenreController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Generos
    Route::get('/Generos', [BookGenreController::class, 'index'])->name('generos.index');
    Route::get('/Generos/novo', [BookGenreController::class, 'create'])->name('generos.create');
    Route::post('/Generos', [BookGenreController::class, 'store'])->name('generos.store');
    Route::get('/Generos/{bookGenre}/edit', [BookGenreController::class, 'edit'])->name('generos.edit');
    Route::put('/Generos/{bookGenre}', [BookGenreController::class, 'update'])->name('generos.update');
    Route::delete('/Generos/{bookGenre}', [BookGenreController::class, 'destroy'])->name('generos.destroy');
    Route::put('/Generos/{bookGenre}', [BookGenreController::class, 'toggleStatus'])->name('generos.toggle-status');

    // Livros
    Route::get('/Autores', [BookAuthorController::class, 'index'])->name('autores.index');
    Route::get('/Autores/novo', [BookAuthorController::class, 'create'])->name('autores.create');
    Route::post('/Autores', [BookAuthorController::class, 'store'])->name('autores.store');
    Route::get('/Autores/{bookAuthor}/edit', [BookAuthorController::class, 'edit'])->name('autores.edit');
    Route::put('/Autores/{bookAuthor}', [BookAuthorController::class, 'update'])->name('autores.update');
    Route::delete('/Autores/{bookAuthor}', [BookAuthorController::class, 'destroy'])->name('autores.destroy');
});

require __DIR__ . '/auth.php';
