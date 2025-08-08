# Memo de Pruebas

- Proyecto: API Postman (Laravel)
- Ubicación: `C:\laragon\www\api-postman`
- Fecha: 2025-08-08

## Objetivo
Documentar una guía de comandos para ejecutar las pruebas automatizadas (PHPUnit/Artisan Test) y, opcionalmente, la colección Postman.

## Alcance
- PHPUnit y `php artisan test` (Windows PowerShell).
- Ejecución por suite, archivo, clase y método.
- Filtros, verbose, stop-on-failure, cobertura.
- Nota de base de datos de pruebas (SQLite en memoria vía `phpunit.xml`).
- Ejecución opcional de Postman con Newman.

## Plan
1. Verificar configuración de pruebas en `phpunit.xml` (DB y suites).
2. Redactar comandos básicos y avanzados para ejecutar tests.
3. Añadir ejemplos prácticos para los tests de API v1 existentes.
4. Añadir sección opcional para ejecutar colección Postman con Newman.
5. Actualizar `README.md` para referenciar la guía.

## Progreso
- `phpunit.xml` verificado: `DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:`.
- Guía de comandos redactada en `docs/Guia_Comandos_Tests.md`.
- `README.md` actualizado para incluir la guía.
