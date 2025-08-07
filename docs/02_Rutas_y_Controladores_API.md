# Tarea 02: Creación de Rutas y Controladores de la API (V1)

**Objetivo:** Generar la estructura base de los controladores y definir todas las rutas RESTful para los recursos principales del sistema.

**Requisitos Previos:**
* Haber completado la Tarea 01.
* Tener los modelos (`Agricultor`, `Finca`, `Animal`, etc.) creados en `app/Models/`.

**Pasos a Seguir:**

1.  **Generar Controladores de API:** Crea un controlador por cada recurso principal, usando el flag `--api` para la estructura RESTful.
    ```bash
    php artisan make:controller Api/V1/AgricultorController --api --model=Agricultor
    php artisan make:controller Api/V1/FincaController --api --model=Finca
    php artisan make:controller Api/V1/AnimalController --api --model=Animal
    php artisan make:controller Api/V1/VegetalController --api --model=Vegetal
    php artisan make:controller Api/V1/PreparadoController --api --model=Preparado
    ```

2.  **Definir las Rutas en `routes/api.php`:** Agrupa todas las rutas de la API bajo un prefijo `v1` y protégelas con el middleware `auth:sanctum`.
    ```php
    // En routes/api.php, después de la ruta /login

    use App\Http\Controllers\Api\V1\AgricultorController;
    use App\Http\Controllers\Api\V1\FincaController;
    use App\Http\Controllers\Api\V1\AnimalController;
    use App\Http\Controllers\Api\V1\VegetalController;
    use App\Http\Controllers\Api\V1\PreparadoController;

    Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
        Route::apiResource('agricultores', AgricultorController::class);
        Route::apiResource('fincas', FincaController::class);
        Route::apiResource('animales', AnimalController::class);
        Route::apiResource('vegetales', VegetalController::class);
        Route::apiResource('preparados', PreparadoController::class);
    });
    ```

**Criterios de Aceptación:**
* El comando `php artisan route:list | grep api/v1` muestra una lista completa de rutas (index, store, show, update, destroy) para cada uno de los 5 recursos.
* Intentar acceder a `GET /api/v1/agricultores` sin un token de autenticación devuelve un error `401 Unauthorized`.
* Acceder a la misma ruta con un token válido devuelve una respuesta `200 OK` (aunque el cuerpo de la respuesta esté vacío por ahora).