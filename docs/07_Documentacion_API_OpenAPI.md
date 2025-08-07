# Tarea 07: Generación de la Documentación con Estándar OpenAPI

**Objetivo:** Crear un archivo de especificación OpenAPI 3.0 (antes Swagger) que documente de forma clara y estandarizada todos los endpoints de la API.

**Requisitos Previos:**
* Haber completado la Tarea 05. La funcionalidad de la API debe estar finalizada y estable.

**Pasos a Seguir:**

1.  **Crear el Archivo de Especificación:** Crea un archivo llamado `openapi.yaml` en la raíz de tu proyecto o en un directorio `docs/`.

2.  **Definir la Estructura Base:** Comienza con la información general, servidores y esquemas de seguridad.

    ```yaml
    openapi: 3.0.3
    info:
      title: AMCA - Sistema de Gestión Agropecuaria API
      description: API RESTful para la gestión de recursos agropecuarios del sistema AMCA.
      version: "1.0.0"
    servers:
      - url: [http://amca.test/api/v1](http://amca.test/api/v1)
        description: Servidor de Desarrollo
    components:
      securitySchemes:
        bearerAuth:
          type: http
          scheme: bearer
          bearerFormat: JWT
    security:
      - bearerAuth: []
    tags:
      - name: Agricultores
        description: Operaciones sobre los agricultores
      - name: Fincas
        description: Operaciones sobre las fincas
      # ... agregar tags para los otros recursos
    ```

3.  **Documentar un Recurso Completo (Paths):** El siguiente paso es describir cada `path` (endpoint). Aquí un ejemplo detallado para `/agricultores`.

    ```yaml
    paths:
      /agricultores:
        get:
          tags:
            - Agricultores
          summary: Obtiene una lista paginada de agricultores
          responses:
            '200':
              description: OK. Operación exitosa.
              content:
                application/json:
                  schema:
                    type: object # Aquí se define la estructura del objeto de paginación
        post:
          tags:
            - Agricultores
          summary: Crea un nuevo agricultor
          requestBody:
            required: true
            content:
              application/json:
                schema:
                  type: object
                  properties:
                    nombres:
                      type: string
                      example: "Policarpa"
                    apellidos:
                      type: string
                      example: "Salavarrieta"
                    documento:
                      type: string
                      example: "1098765432"
          responses:
            '201':
              description: Creado.
            '422':
              description: Error de validación.

      /agricultores/{id}:
        get:
          tags:
            - Agricultores
          summary: Obtiene un agricultor por su ID
          parameters:
            - name: id
              in: path
              required: true
              schema:
                type: integer
          responses:
            '200':
              description: OK.
            '404':
              description: Recurso no encontrado.
    ```

4.  **Replicar para todos los Endpoints:** Usando el ejemplo anterior como plantilla, documenta todos los demás `paths` y métodos (`GET`, `POST`, `PUT`, `DELETE`) para todos los recursos (`Fincas`, `Animales`, etc.) y las rutas de relaciones (`/agricultores/{id}/fincas/{id}`).

**Criterios de Aceptación:**
* Existe un archivo `openapi.yaml` completo y válido.
* El archivo puede ser cargado en un editor o visor de OpenAPI (como Swagger Editor o Stoplight Studio) sin errores de sintaxis.
* La documentación generada es clara, legible y refleja con precisión el funcionamiento de cada endpoint de la API.