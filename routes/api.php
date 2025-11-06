<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiController;
use App\Models\AppUser;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/register', [AuthController::class, 'register_user']);
    Route::post('/get_user_task', [ApiController::class, 'get_user_task']);
    Route::post('/perform_task', [ApiController::class, 'perform_task']);

});




Route::post('/login', [ApiController::class, 'login']);
Route::get('/get_profile/{id}', [ApiController::class, 'get_profile']);
Route::get('/get_areas', [ApiController::class, 'get_areas']);
Route::get('/get_time_slots/{id}', [ApiController::class, 'get_time_slots']);
Route::post('/complain', [ApiController::class, 'complain']);
Route::get('/get_complains/{id}', [ApiController::class, 'get_complains']);
Route::get('/get_parking_boys', [ApiController::class, 'get_parking_boys']);
Route::post('/update_profile/{id}', [ApiController::class, 'update_profile']);
