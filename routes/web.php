<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/event/create', [EventController::class, 'create'])->middleware('auth')->name('events.create');
Route::post('/events/', [EventController::class, 'store'])->middleware('auth')->name('events.store');
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth')->name('events.dashboard');
Route::delete('/events/{id}', [EventController::class,'destroy'])->middleware('auth')->name('events.destroy');
Route::put('/events/update/{id}', [EventController::class,'update'])->middleware('auth')->name('events.update');
Route::post('/event/join/{id}', [EventController::class,'joinEvent'])->middleware('auth')->name('events.join');
Route::delete('/events/leave/{id}', [EventController::class,'leaveEvent'])->middleware('auth')->name('events.leave');
