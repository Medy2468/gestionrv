<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\RendezvousController;

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

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');


//les routes

/**
 *
 *
 */
Route::get('/medecin/add',[MedecinController::class,'add'])->name('addmedecin');
Route::get('/medecin/edit{id}',[MedecinController::class,'edit'])->name('editmedecin');
Route::post('/medecin/update',[MedecinController::class,'update'])->name('updatemedecin');
Route::get('/medecin/delete{id}',[MedecinController::class,'delete'])->name('deletemedecin');
Route::get('/medecin/getAll',[MedecinController::class,'getall'])->name('getallmedecin');
Route::post('/medecin/persist',[MedecinController::class,'persist'])->name('persistmedecin');

//route rendevous
Route::get('/rendezvous/add',[RendezvousController::class,'add'])->name('addrendezvous');
Route::get('/rendezvous/edit{id}',[RendezvousController::class,'edit'])->name('editrendezvous');
Route::post('/rendezvous/update',[RendezvousController::class,'update'])->name('updaterendezvous');
Route::get('/rendezvous/delete{id}',[RendezvousController::class,'delete'])->name('deleterendezvous');
Route::get('/rendezvous/getAll',[RendezvousController::class,'getall'])->name('getallrendezvous');
Route::post('/rendezvous/persist',[RendezvousController::class,'persist'])->name('persistrendezvous');
//require _DIR_.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');