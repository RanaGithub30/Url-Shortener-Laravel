<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortenLinkController;

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
    $url = "";
    $message = "";
    return view('home', compact('url', 'message'));
});

Route::post('shorten-url', [ShortenLinkController::class, 'shorten_url']);
Route::get('/{no}', [ShortenLinkController::class, 'get_url']);