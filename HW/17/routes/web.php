<?php

use App\Http\Controllers\ReserveController;
use App\Models\Reserve;
use App\Models\Station1;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Cast;

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
    return redirect('/reserve');
});


Route::get('/reserve/{reserve}/editTime', [ReserveController::class, 'editTime'])->name('reserve.editTime');
Route::post('/reserve/{reserve}/firstEdit', [ReserveController::class, 'firstEdit'])->name('reserve.firstEdit');
Route::put('/reserve/{reserve}/updateName', [ReserveController::class, 'updateName'])->name('reserve.updateName');
Route::post('/reserve/trackCodeCheck', [ReserveController::class, 'trackCodeCheck'])->name('reserve.trackCodeCheck');
Route::get('/reserve/trackCode', [ReserveController::class, 'trackCode'])->name('reserve.trackCode');
Route::get('/reserve/setTime', [ReserveController::class, 'setTime'])->name('reserve.setTime');
Route::post('/reserve/firstStore', [ReserveController::class, 'firstStore'])->name('reserve.firstStore');
Route::resource('/reserve', ReserveController::class);


    
    
    
//     // $end = Carbon::parse($request->date . ' ' . $request->time);
//     // $current = Carbon::now();
//     // $dt = Carbon::createFromDate('21', '00');
//     // return date('H:i', $dt->diffInHours($current));
//     // $current->subHour();
//     // return $current->format('h:i');

//     // $length = $end->diffInDays($current);
//     // dd($length);
// });
