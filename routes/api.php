<?php

use App\Http\Controllers\api\ApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ApplicationController::class)->prefix('organizations')->group(function (){
    Route::get('/{organization}/find','getOrganization');
    Route::get('/saved-repositories', 'getSavedRepositories');
});
