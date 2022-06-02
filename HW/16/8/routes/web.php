<?php

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

Route::get('/{title}/{id}/{cat}', function ($title, $id, $cat) {

    return view('index', compact('title', 'id', 'cat'));

})->whereAlpha('title')
  ->whereNumber('id')
  ->whereIn('cat', ['sport', 'economy', 'values']);
