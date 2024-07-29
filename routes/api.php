<?php

use Illuminate\Support\Facades\Route;

Route::get('/generate', [\App\Http\Controllers\RespondentController::class, 'generate']);
