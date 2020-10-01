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


Route::group(['as'=>'user.'],function ()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return view('user.home');
    });
    Route::get('/about-journal',[\App\Http\Controllers\JournalController::class,'index']);
    Route::get('/last-number',[\App\Http\Controllers\JournalController::class,'last_number']);

    Route::get('/editorial-staff',[\App\Http\Controllers\MainController::class,'editorial_staff']);
    Route::get('/founders',[\App\Http\Controllers\MainController::class,'founders']);
    Route::get('/archive',[\App\Http\Controllers\MainController::class,'archive']);
    Route::get('/from-editor-in-chief',[\App\Http\Controllers\MainController::class,'from_editor_in_chief']);
    Route::get('/search',[\App\Http\Controllers\MainController::class,'search']);

}
);

Route::group(['prefix' => 'admin'], function() {
    Route::auth();
});








