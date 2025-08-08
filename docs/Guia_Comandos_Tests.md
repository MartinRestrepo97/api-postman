# Guía de Comandos para Pruebas (Windows PowerShell)

Esta guía explica cómo ejecutar las pruebas del proyecto (PHPUnit / Artisan) y, opcionalmente, la colección Postman.

## Requisitos previos
- PHP instalado (>= 8.3)
- Composer instalado
- Dependencias del proyecto instaladas: `composer install`

Base de datos de pruebas configurada en `phpunit.xml`:
- `DB_CONNECTION=sqlite`
- `DB_DATABASE=:memory:`

## Comandos básicos

- Ejecutar toda la suite con PHPUnit:
  ```powershell
  vendor\bin\phpunit.bat
  ```

- Ejecutar toda la suite con Artisan (equivalente):
  ```powershell
  php artisan test
  ```

## Ejecutar por suites

- Solo pruebas Unit:
  ```powershell
  vendor\bin\phpunit.bat --testsuite Unit
  ```
- Solo pruebas Feature:
  ```powershell
  vendor\bin\phpunit.bat --testsuite Feature
  ```

## Ejecutar por archivo, clase o método

- Por archivo (ruta relativa dentro de `tests/`):
  ```powershell
  vendor\bin\phpunit.bat tests\Feature\Api\V1\AgricultorCrudTest.php
  ```

- Por clase (usando filtro):
  ```powershell
  vendor\bin\phpunit.bat --filter AgricultorCrudTest
  ```

- Por método específico:
  ```powershell
  vendor\bin\phpunit.bat --filter test_can_create_agricultor_when_authenticated
  ```

- Varias clases/métodos por patrón:
  ```powershell
  vendor\bin\phpunit.bat --filter CrudTest
  ```

## Opciones útiles

- Modo detallado (verbose):
  ```powershell
  vendor\bin\phpunit.bat -v
  ```

- Detener al primer fallo:
  ```powershell
  vendor\bin\phpunit.bat --stop-on-failure
  ```

- Mostrar tiempo de pruebas y memoria (ya habilitado por defecto en salida):
  No requiere parámetros adicionales.

## Artisan test (alternativas comunes)

- Con ocultación de reportes de Deprecations/Warnings:
  ```powershell
  php artisan test --no-ansi
  ```

- Ejecutar Feature tests solamente con Artisan:
  ```powershell
  php artisan test --testsuite=Feature
  ```

## Datos de prueba (factories)

El proyecto incluye `database/factories/` para generar datos. Durante las pruebas se usa SQLite en memoria y `RefreshDatabase`, por lo que las migraciones se ejecutan automáticamente al inicio de cada caso de prueba.

## Variables de entorno en pruebas

- Definidas en `phpunit.xml`. Si necesitas sobreescribir temporalmente:
  ```powershell
  $env:APP_ENV = "testing"
  $env:DB_CONNECTION = "sqlite"
  $env:DB_DATABASE = ":memory:"
  vendor\bin\phpunit.bat
  ```

## Ejecutar colección Postman (opcional)

Si deseas validar la colección Postman (`docs/AMCA_API_V1.postman_collection.json`) con Newman:

1) Instalar Newman globalmente (Node requerido):
```powershell
npm install -g newman
```

2) Ejecutar colección:
```powershell
newman run .\docs\AMCA_API_V1.postman_collection.json
```

3) Con reporte HTML (requiere reporter):
```powershell
npm install -g newman-reporter-htmlextra
newman run .\docs\AMCA_API_V1.postman_collection.json -r htmlextra --reporter-htmlextra-export .\newman-report.html
```

## Notas
- En Windows PowerShell, evita usar `&&` en una sola línea (no es un separador válido). Ejecuta comandos en líneas separadas.
- Si ves errores 404 en endpoints `/api/...` al correr pruebas, asegúrate de que `bootstrap/app.php` registra `api: __DIR__.'/../routes/api.php'`.
- Si usas otra base de datos para pruebas, actualiza `phpunit.xml` acorde.
