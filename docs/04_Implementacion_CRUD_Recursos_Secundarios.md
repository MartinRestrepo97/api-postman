# Tarea 04: Implementación de la Lógica CRUD para Recursos Secundarios

**Objetivo:** Desarrollar la funcionalidad completa (Crear, Leer, Actualizar, Eliminar) para los recursos restantes: `Fincas`, `Animales`, `Vegetales` y `Preparados`.

**Requisitos Previos:**
* Haber completado la Tarea 03. La implementación de `AgricultorController` es el patrón a seguir.

**Pasos a Seguir:**

1.  **Replicar el Patrón CRUD:** La lógica para los recursos secundarios es muy similar a la ya implementada para `Agricultores`. El proceso consiste en editar cada controlador (`FincaController`, `AnimalController`, etc.) y adaptar la lógica de validación y creación a los campos específicos de cada modelo.

2.  **Ejemplo Completo para `FincaController`:** A continuación, se muestra la implementación completa para `FincaController.php` como guía directa.

    ```php
    // En: app/Http/Controllers/Api/V1/FincaController.php

    <?php

    namespace App\Http\Controllers\Api\V1;

    use App\Http\Controllers\Controller;
    use App\Models\Finca;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class FincaController extends Controller
    {
        public function index()
        {
            return response()->json(Finca::paginate(15));
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:300',
                'ubicacion' => 'required|string|max:300',
                'imagen' => 'nullable|string', // o 'image|max:2048' si subes archivos
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $finca = Finca::create($validator->validated());
            return response()->json($finca, 201);
        }

        public function show(Finca $finca)
        {
            return response()->json($finca);
        }

        public function update(Request $request, Finca $finca)
        {
            $validator = Validator::make($request->all(), [
                'nombre' => 'sometimes|required|string|max:300',
                'ubicacion' => 'sometimes|required|string|max:300',
                'imagen' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $finca->update($validator->validated());
            return response()->json($finca);
        }

        public function destroy(Finca $finca)
        {
            $finca->delete();
            return response()->json(null, 204);
        }
    }
    ```

3.  **Implementar los Controladores Restantes:**
    * Abre `AnimalController.php`, `VegetalController.php` y `PreparadoController.php`.
    * Replica la estructura del `FincaController`.
    * **Crucial:** Ajusta las reglas de `Validator::make()` en los métodos `store` y `update` para que coincidan con los campos de cada modelo (`Animal`, `Vegetal`, `Preparado`) según se define en el documento de análisis original.

**Criterios de Aceptación:**
* El CRUD completo (POST, GET, GET por ID, PUT, DELETE) funciona correctamente para el endpoint `/api/v1/fincas`.
* El CRUD completo funciona correctamente para el endpoint `/api/v1/animales`.
* El CRUD completo funciona correctamente para el endpoint `/api/v1/vegetales`.
* El CRUD completo funciona correctamente para el endpoint `/api/v1/preparados`.
* Las validaciones de datos para cada recurso devuelven errores `422` cuando se envían datos incorrectos.