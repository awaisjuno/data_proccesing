<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatasetController;

Route::get('/signup', [AuthController::class, 'showSignupForm']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/signin', [AuthController::class, 'showSigninForm']);
Route::post('/signin', [AuthController::class, 'signin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    if (!Session::has('user_id')) return redirect('/signin');
    return view('dashboard');
});

Route::middleware('web')->group(function () {

    Route::match(['get', 'post'], '/datasets', [DatasetController::class, 'index'])->name('datasets.index');
    Route::post('/datasets/update/{id}', [DatasetController::class, 'update'])->name('datasets.update');
    Route::get('/datasets/delete/{id}', [DatasetController::class, 'delete'])->name('datasets.delete');
    
    Route::get('/user/search', [DatasetController::class, 'searchUser'])->name('user.search');
    Route::post('/access/grant', [DatasetController::class, 'grantAccess'])->name('access.grant');

    Route::get('/datasets/access/{id}', [DatasetController::class, 'access'])->name('datasets.access');
    Route::get('/datasets/{id}/edit', [DatasetController::class, 'edit'])->name('datasets.edit');

});