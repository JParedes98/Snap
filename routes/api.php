<?php

use Illuminate\Support\Facades\Route;

//IMPORT CONTROLLERS CLASS
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;

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

//AUTH ROUTES
Route::group([ 'prefix' => 'auth' ], function () {
    Route::post('/login',       [ AuthController::class, 'login'            ]);
    Route::post('/register',    [ AuthController::class, 'register'         ]);
    Route::post('/logout',      [ AuthController::class, 'logout'           ]);
});

//PUBLIC RESOURCES ROUTES
Route::get('/GetAllLinks',      [ PublicController::class, 'GetAllLinks'    ]);
Route::get('/GetAllFiles',      [ PublicController::class, 'GetAllFiles'    ]);
Route::get('/GetAllSnippets',   [ PublicController::class, 'GetAllSnippets' ]);

Route::group([ 'prefix' => 'admin' ], function () {
    Route::get('/{resource}',   [ AdminController::class, 'GetResource'     ]);
    Route::post('/{resource}',  [ AdminController::class, 'StoreResource'   ]);
    Route::put('/{resource}',   [ AdminController::class, 'UpdateResource'  ]);
    Route::delete('/{resource}',[ AdminController::class, 'DeleteResource'  ]);
});
