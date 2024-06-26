<?php

use App\Http\Controllers\WebhookController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', [CompanyController::class, 'index'])->name('index');
Route::post('/', [CompanyController::class, "tariffStore"])->name('tariffStore');

Route::any('/webhook', [WebhookController::class, 'create'])->name('create');
