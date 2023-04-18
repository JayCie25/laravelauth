<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravelauth;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('logout', function(){auth()->logout(); Session()->flush(); return Redirect::to('/');})->name('logout');
Route::get('/firstpage', [laravelauth::class, 'firstpage'])->name('home');
Route::get('/firstpage2', [laravelauth::class, 'firstpage2'])->name('homee');
Route::post('/save-item', [laravelauth::class, 'saveItem'])->name('saveItem');
Route::post('/save-post', [laravelauth::class, 'savePost'])->name('savePost');
Route::get('/delete-item{id}', [laravelauth::class, 'deleteItem'])->name('deleteItem');
Route::get('/delete-post{id}', [laravelauth::class, 'deletePost'])->name('deletePost');
Route::get('/firstpage{id}', [laravelauth::class, 'updateItem'])->name('updateItem');
Route::get('/firstpage2{id}', [laravelauth::class, 'updateItem'])->name('updateItemm');
Route::post('/save-update', [laravelauth::class, 'saveUpdate'])->name('saveUpdate');
Route::post('/save-update-post', [laravelauth::class, 'saveUpdatePost'])->name('saveUpdatePost');
Route::get('/posts', [laravelauth::class, 'secpage'])->name('home2');
Route::post('/firstpage2/search',[laravelauth::class,'showEmployee'])->name('firstpage2.search');

Auth::routes();

Route::get('/chat', [HomeController::class, 'index'])->name('chat');
Route::get('/message/{id}', [HomeController::class,'getMessage'])->name('message');
Route::post('message', [HomeController::class,'sendMessage']);