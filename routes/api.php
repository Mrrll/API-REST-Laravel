<?php

use App\Http\Controllers\API\PacienteController;
use App\Models\Paciente;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('pacientes',[PacienteController::class,'index']);
Route::post('pacientes',[PacienteController::class,'store']);
Route::get('pacientes/{paciente}',[PacienteController::class,'show']);
Route::put('pacientes/{paciente}',[PacienteController::class,'update']);
