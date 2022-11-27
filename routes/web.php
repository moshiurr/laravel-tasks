<?php

use App\Models\Trademark;
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

use App\Models\Task;
use Illuminate\Http\Request;

/**
    * Show Task Dashboard
    */
Route::get('/', function () {
    error_log("INFO: get /");
    return view('welcome');
});


Auth::routes();

/**
    * Add New Task
    */
Route::post('/task', function (Request $request) {
    error_log("INFO: post /task");
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        error_log("ERROR: Add task failed.");
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
    * Delete Task
    */
Route::delete('/trademarks/{id}', [App\Http\Controllers\HomeController::class, 'delete']);
Route::delete('/delete-favorite/{id}', [App\Http\Controllers\HomeController::class, 'deleteFavorite']);
Route::put('/add-favorite/{id}', [\App\Http\Controllers\HomeController::class, 'addFavorite']);

Route::post('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search-yours');
Route::post('/search-all', [App\Http\Controllers\HomeController::class, 'searchAll'])->name('search-all');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/view-trademark/{id}', [App\Http\Controllers\HomeController::class, 'viewOtherTrademark'])->name('view-other-trademark');
Route::get('/register-trade', [App\Http\Controllers\HomeController::class, 'getRegisterTrade'])->name('register-trade');
Route::post('/register-trade', [App\Http\Controllers\HomeController::class, 'registerTrade'])->name('register-trade');
Route::get('/viewTrademark', [App\Http\Controllers\HomeController::class, 'viewTrademark'])->name('view-trademark');
Route::get('/viewFavTrademark', [App\Http\Controllers\HomeController::class, 'viewFavTrademark'])->name('view-fav-trademark');

