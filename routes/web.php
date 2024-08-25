<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\IPAddressController;
use App\Http\Controllers\LoginController;
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
Route::middleware('guest')->group(function () {
    Route::get('/login', function() {
        return Inertia('Auth/Login');
    })->name('login');
    
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'destroy']);

    Route::get('/', function () {
        return Inertia('App/IPAddress/List');
    })->name('app.ipaddress.list');

    Route::get('/audit-logs', [AuditLogController::class, 'index']);
    Route::get('/audit-logs/{id}/ip-address', [AuditLogController::class, 'ipAddresses']);

    Route::apiResources([
        'ip_address' => IPAddressController::class,
    ]);
});
