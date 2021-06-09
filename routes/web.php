<?php

use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\MyAccountsController;
use App\Http\Controllers\UserManagementsController;

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // DASHBOARD ROUTE
    Route::get('/dashboard', [DashboardsController::class, 'index'])->name('dashboard');

    // MY ACCOUNT ROUTE
    Route::get('/account', [MyAccountsController::class, 'index'])->name('my-account');
    Route::post('/account/update/{id}', [MyAccountsController::class, 'update'])->name('update-account');
    
    // USER MANAGEMENT ROUTE
    Route::get('/user', [UserManagementsController::class, 'index'])->name('user-management');
    Route::get('/user/add', [UserManagementsController::class, 'add'])->name('add-user');
    Route::post('/user/store', [UserManagementsController::class, 'store'])->name('store-user');
    Route::get('/user/{id}', [UserManagementsController::class, 'edit'])->name('edit-user');
    Route::post('/user/update/{id}', [UserManagementsController::class, 'update'])->name('update-user');
    Route::post('/user/delete/{id}', [UserManagementsController::class, 'delete'])->name('delete-user');
    
    // CONTACT ROUTE
    Route::get('/contact', [ContactsController::class, 'index'])->name('contact');
    Route::get('/contact/add', [ContactsController::class, 'add'])->name('add-contact');
    Route::post('/contact/store', [ContactsController::class, 'store'])->name('store-contact');
    Route::get('/contact/edit/{id}', [ContactsController::class, 'edit'])->name('edit-contact');
    Route::post('/contact/update/{id}', [ContactsController::class, 'update'])->name('update-contact');
    Route::post('/contact/delete/{id}', [ContactsController::class, 'delete'])->name('delete-contact');
    Route::get('/contact/delete/image/{id}', [ContactsController::class, 'delete_image'])->name('delete-image-contact');
});