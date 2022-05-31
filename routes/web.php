<?php


use App\Http\Controllers\User\UserAccountController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::controller(UserAccountController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/store', 'store')->name('users.accounts.store');
        Route::post('/add-money', 'addMoney')->name('users.accounts.addMoney');
        Route::post('/subtract-money', 'subtractMoney')->name('users.accounts.subtractMoney');

    });
});
