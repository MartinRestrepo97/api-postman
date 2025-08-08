<?php
// ...existing code...
use App\Models\User;
use App\Http\Controllers\Api\V1\AgricultorController;
use App\Http\Controllers\Api\V1\FincaController;
use App\Http\Controllers\Api\V1\AnimalController;
use App\Http\Controllers\Api\V1\VegetalController;
use App\Http\Controllers\Api\V1\PreparadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Credenciales inválidas.'
        ], 401);
    }

    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken
    ]);
})->middleware('throttle:10,1');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('agricultores', AgricultorController::class);
    Route::apiResource('fincas', FincaController::class);
    Route::apiResource('animales', AnimalController::class);
    Route::apiResource('vegetales', VegetalController::class);
    Route::apiResource('preparados', PreparadoController::class);
});

// Rutas para gestionar las relaciones Many-to-Many
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // ...otras rutas...

    // Fincas
    Route::post('agricultores/{agricultor}/fincas/{finca}', [AgricultorController::class, 'attachFinca']);
    Route::delete('agricultores/{agricultor}/fincas/{finca}', [AgricultorController::class, 'detachFinca']);

    // Animales
    Route::post('agricultores/{agricultor}/animales/{animal}', [AgricultorController::class, 'attachAnimal']);
    Route::delete('agricultores/{agricultor}/animales/{animal}', [AgricultorController::class, 'detachAnimal']);

    // Vegetales
    Route::post('agricultores/{agricultor}/vegetales/{vegetal}', [AgricultorController::class, 'attachVegetal']);
    Route::delete('agricultores/{agricultor}/vegetales/{vegetal}', [AgricultorController::class, 'detachVegetal']);

    // Preparados
    Route::post('agricultores/{agricultor}/preparados/{preparado}', [AgricultorController::class, 'attachPreparado']);
    Route::delete('agricultores/{agricultor}/preparados/{preparado}', [AgricultorController::class, 'detachPreparado']);
});

// ...existing code...