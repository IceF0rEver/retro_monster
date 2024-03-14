<?php
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{user}/{slug}', [UserController::class, 'show'])->name('users.show');
});

Route::prefix('/monsters')->group(function () {
    Route::get('/', [MonsterController::class, 'index'])->name('monsters.index');
    Route::get('/{monster}/{slug}', [MonsterController::class, 'show'])->name('monsters.show');
});

Route::get('/search-text', [MonsterController::class, 'searchByText'])->name('search.text');
Route::get('/search-criteres', [MonsterController::class, 'searchByCriteria'])->name('search.criteria');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    
    Route::prefix('/monsters')->group(function () {
        Route::get('/deck', [MonsterController::class, 'deck'])->name('monsters.deck');

        Route::get('/edit/{monster}/{slug}', [MonsterController::class, 'edit'])->name('monsters.edit');
        Route::put('/{monster}/{slug}', [MonsterController::class, 'update'])->name('monsters.update');
        Route::delete('/{monster}/{slug}', [MonsterController::class, 'destroy'])->name('monsters.destroy');
        
        Route::get('/create', [MonsterController::class, 'create'])->name('monsters.create');
        Route::post('/', [MonsterController::class, 'store'])->name('monsters.store');

        Route::patch('/{monster}/toggle-favorite', [MonsterController::class, 'toggleFavorite'])->name('toggle.favorite');
    });
});

require __DIR__.'/auth.php';