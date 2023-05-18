<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\relation;
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
    return view('welcome');
});
Route::get('relation', [relation::class, 'get_order']);
Route::get('relationproduct', [relation::class, 'get_product_orders']);
Route::get('relationadd', [relation::class, 'add_product_to_order']);
Route::get('relationupdate', [relation::class, 'update_product_to_order']);
Route::get('relationupdatestill', [relation::class, 'update_still_product_to_order']);
