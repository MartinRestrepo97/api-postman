# Tarea 06: Creación de la Colección de Pruebas en Postman

**Objetivo:** Construir una colección de pruebas completa y reutilizable en Postman para validar todos los aspectos de la API, incluyendo casos de éxito y de error.

**Requisitos Previos:**
* Haber completado la Tarea 05. La API debe estar completamente funcional.
* Tener Postman instalado.

**Pasos a Seguir:**

1.  **Configurar el Entorno en Postman:**
    * Crea un nuevo "Environment" en Postman.
    * Añade una variable `baseUrl` con el valor de tu URL de desarrollo (ej: `http://amca.test`).
    * Añade una variable `authToken` y déjala vacía por ahora.

2.  **Crear la Petición de Login:**
    * Crea una petición `POST` a `{{baseUrl}}/api/login`.
    * En la pestaña "Body", añade el email y password de un usuario de prueba.
    * En la pestaña "Tests", añade el siguiente script para capturar el token automáticamente:
        ```javascript
        var jsonData = pm.response.json();
        pm.environment.set("authToken", jsonData.token);
        ```
    * Al ejecutar esta petición, la variable `authToken` en tu entorno se poblará automáticamente.

3.  **Configurar la Autenticación de la Colección:**
    * Crea una nueva "Collection" llamada "AMCA API V1".
    * En la pestaña "Authorization" de la colección, selecciona "Bearer Token" y en el campo "Token" escribe `{{authToken}}`. Todas las peticiones dentro de la colección heredarán esta autenticación.

4.  **Crear Peticiones de Prueba:**
    * Crea carpetas para cada recurso (`Agricultores`, `Fincas`, `Relaciones`, etc.).
    * Dentro de cada carpeta, añade las peticiones para cada acción (CRUD).
        * **Ejemplo: Crear Agricultor**
            * **Método:** `POST`
            * **URL:** `{{baseUrl}}/api/v1/agricultores`
            * **Body (raw, JSON):** Rellena con datos de prueba.
            * **Tests:** Añade aserciones para verificar la respuesta.
                ```javascript
                pm.test("Status code is 201 Created", function () {
                    pm.response.to.have.status(201);
                });
                pm.test("Response has an ID", function () {
                    var jsonData = pm.response.json();
                    pm.expect(jsonData.id).to.not.be.empty;
                });
                ```

5.  **Añadir Pruebas de Casos Negativos:**
    * Crea peticiones duplicadas para probar los errores.
    * **Ejemplo: Crear Agricultor con datos duplicados.** Espera un status `422`.
    * **Ejemplo: Obtener Finca sin Token.** Desactiva la autorización para esta petición específica y espera un status `401`.
    * **Ejemplo: Obtener un Recurso con ID inexistente.** Usa un ID como `9999` y espera un status `404`.

**Criterios de Aceptación:**
* Existe una colección de Postman que cubre todos los endpoints de la API.
* El "Collection Runner" de Postman ejecuta todas las pruebas de casos de éxito sin fallos (en verde).
* Las pruebas para los casos de error (401, 404, 422) también pasan, validando que la API responde correctamente a situaciones anómalas.