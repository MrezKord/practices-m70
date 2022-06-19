<?php

use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('/', function () {
    return redirect()->route('register');
});


Route::get('/reserve/{reserve}/showResultRequest', [ReserveController::class, 'showResultRequest'])->name('reserve.showResultRequest');
Route::get('/reserve/{reserve}/editTime', [ReserveController::class, 'editTime'])->name('reserve.editTime');
Route::post('/reserve/{reserve}/firstEdit', [ReserveController::class, 'firstEdit'])->name('reserve.firstEdit');
Route::put('/reserve/{user}/updateName', [ReserveController::class, 'updateName'])->name('reserve.updateName');
Route::get('/reserve/setTime', [ReserveController::class, 'setTime'])->name('reserve.setTime');
Route::post('/reserve/firstStore', [ReserveController::class, 'firstStore'])->name('reserve.firstStore');

Route::resource('/reserve', ReserveController::class);



Route::delete('/user/{user}/deleteService', [UserController::class, 'deleteService'])->name('user.deleteService');
Route::put('/user/{user}/updateService', [UserController::class, 'updateService'])->name('service.updateService');
Route::post('/user/Services', [UserController::class, 'storeService'])->name('user.storeService');
Route::get('/user/Services', [UserController::class, 'Services'])->name('user.Services');
Route::get('/user/showReserves', [UserController::class, 'showReserves'])->name('user.showReserves');
Route::post('/user/handelServiceTypeReserve', [UserController::class, 'handelServiceTypeReserve'])->name('user.handelServiceTypeReserve');
Route::resource('/user', UserController::class);


require __DIR__.'/auth.php';
