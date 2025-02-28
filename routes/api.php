<?php

use App\Http\Controllers\Api\EndPointController;

Route::get('endpoints',[EndPointController::class,'index'])->name('endpoints.index');
Route::get('endpoints/{endpoint}',[EndPointController::class,'show'])->name('endpoints.show');
