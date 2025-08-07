# Tarea 03: Implementación de la Lógica CRUD para el Recurso 'Agricultores'

**Objetivo:** Desarrollar la funcionalidad completa (Crear, Leer, Actualizar, Eliminar) para el recurso `Agricultores` `Fincas` `Animales` `Vegetales` `Preparados`, incluyendo validación robusta de datos. Este servirá de plantilla para los demás.

**Requisitos Previos:**
* Haber completado la Tarea 02.

**Pasos a Seguir:**

1.  **Editar `Api/V1/AgricultorController.php`:** Implementa la lógica para cada uno de los métodos generados.
    * **`index()`:** Devolver una lista paginada.
    * **`store()`:** Validar los datos de entrada y crear el nuevo registro.
    * **`show()`:** Encontrar y devolver un único agricultor, cargando sus relaciones.
    * **`update()`:** Validar y actualizar un registro existente.
    * **`destroy()`:** Eliminar un registro.

2.  **Añadir el código al controlador:** Usa el código de la respuesta anterior como base, asegurando que las reglas de validación coincidan con tu esquema de base de datos.
    ```php
    // Implementar aquí el código completo del AgricultorController.php
    // (Incluir el uso de Validator, las respuestas JSON con códigos de estado correctos, etc.)
    ```

**Criterios de Aceptación:**
* `POST /api/v1/agricultores` con datos válidos crea un agricultor y devuelve `201 Created`.
* `POST /api/v1/agricultores` con datos inválidos (ej. `documento` duplicado) devuelve `422 Unprocessable Entity` con la lista de errores.
* `GET /api/v1/agricultores/{id}` devuelve los datos del agricultor correcto.
* `PUT /api/v1/agricultores/{id}` actualiza los datos correctamente.
* `DELETE /api/v1/agricultores/{id}` elimina el agricultor y devuelve `204 No Content`.