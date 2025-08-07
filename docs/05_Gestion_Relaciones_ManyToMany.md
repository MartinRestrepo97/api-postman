# Tarea 05: Gestión de Relaciones Many-to-Many

**Objetivo:** Implementar los endpoints y la lógica para asociar y desasociar recursos; por ejemplo, vincular una `Finca` a un `Agricultor`.

**Requisitos Previos:**
* Haber completado la Tarea 04. Los recursos deben poder crearse antes de poder relacionarlos.
* Los modelos de Eloquent (`Agricultor`, `Finca`, etc.) deben tener definidas las relaciones `belongsToMany`.

**Pasos a Seguir:**

1.  **Definir Rutas para las Relaciones:** Añade las nuevas rutas en `routes/api.php` dentro del grupo `v1` protegido. Usaremos como ejemplo la relación Agricultor-Finca.

    ```php
    // En routes/api.php, dentro del grupo Route::prefix('v1')...

    // Rutas para gestionar las relaciones (Many-to-Many)
    Route::post('agricultores/{agricultor}/fincas/{finca}', [AgricultorController::class, 'attachFinca']);
    Route::delete('agricultores/{agricultor}/fincas/{finca}', [AgricultorController::class, 'detachFinca']);

    // TODO: Añadir rutas similares para las otras relaciones
    // ej. Route::post('agricultores/{agricultor}/animales/{animal}', [AgricultorController::class, 'attachAnimal']);
    ```

2.  **Implementar la Lógica en el Controlador:** Añade los métodos para `attach` y `detach` en `AgricultorController.php`. Laravel se encargará de inyectar los modelos correspondientes gracias al *Route Model Binding*.

    ```php
    // Añadir estos métodos a: app/Http/Controllers/Api/V1/AgricultorController.php

    use App\Models\Finca; // Asegúrate de importar el modelo Finca

    /**
     * Asocia una finca existente a un agricultor.
     */
    public function attachFinca(Agricultor $agricultor, Finca $finca)
    {
        $agricultor->fincas()->syncWithoutDetaching([$finca->id]);
        return response()->json(['message' => 'Finca asociada correctamente.'], 200);
    }

    /**
     * Desasocia una finca de un agricultor.
     */
    public function detachFinca(Agricultor $agricultor, Finca $finca)
    {
        $agricultor->fincas()->detach($finca->id);
        return response()->json(['message' => 'Finca desasociada correctamente.'], 200);
    }
    ```

3.  **Replicar para Otras Relaciones:**
    * Añade las rutas correspondientes para `animales`, `vegetales` y `preparados`.
    * Añade los métodos `attachAnimal`/`detachAnimal`, `attachVegetal`/`detachVegetal`, etc., al `AgricultorController`. La lógica es idéntica, solo cambia el nombre de la relación y el modelo inyectado.

**Criterios de Aceptación:**
* Una petición `POST` a `/api/v1/agricultores/1/fincas/1` crea un registro en la tabla pivote `agricultores_fincas`.
* Una petición `DELETE` a `/api/v1/agricultores/1/fincas/1` elimina el registro correspondiente de la tabla pivote.
* El endpoint `GET /api/v1/agricultores/1` (modificado en la Tarea 03 para usar `$agricultor->load(...)`) ahora muestra las fincas asociadas en la respuesta JSON.
* El mismo comportamiento de asociar/desasociar funciona para las relaciones con Animales, Vegetales y Preparados.