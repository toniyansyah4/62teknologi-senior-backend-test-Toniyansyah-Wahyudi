<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::group(['middleware' => ['decoder', 'RemoteAuth']], function () {
    Route::get('business/index', [BusinessController::class, 'index'])->name('index');
    Route::post('business/create', [BusinessController::class, 'store'])->name('create');
    Route::delete('business/destroy/{tableId}', [BusinessController::class, 'destroy'])->name('destroy');
    Route::put('business/update/{tableId}', [BusinessController::class, 'update'])->name('update');
    Route::get('business/show/{tableId}', [BusinessController::class, 'show'])->name('show');
    Route::get('business/search', [BusinessController::class, 'search'])->name('search');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

