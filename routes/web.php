<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;


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



Route::get('/show-profitloss',[DashboardController::class,'index'])->name('show-profitloss');
Route::get('/',[DashboardController::class,'showProfitLossScript']);

