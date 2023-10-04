<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\LoginController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:admin'])->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {


        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/forms', [FormController::class, 'index'])->name('forms');
        Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
        Route::post('/forms/store', [FormController::class, 'store'])->name('forms.store');
        Route::get('/forms/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');
        Route::post('/forms/update/{id}', [FormController::class, 'update'])->name('forms.update');
        Route::delete('/forms/destroy/{id}', [FormController::class, 'destroy'])->name('forms.destroy');
    });
});

Route::get('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('admin/auth', [LoginController::class, 'doLogin'])->name('admin.auth');
