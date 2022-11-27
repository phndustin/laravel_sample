<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    // return view('welcome');
    return 'ok';
});

// Route::get('/test', [AuthController::class, 'test']);

// Route::get('/sendmail', function (Request $request) {
//     $ip = $request->ip();
//     Mail::raw('Hi user, test sending mail ', function ($message) {
//         $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
//         $message->to('phanduy.ueter@gmail.com', 'phanduyueter');
//     });
// });