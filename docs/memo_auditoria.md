# Memo de Auditoría del Proyecto

- **Proyecto**: API Postman (Laravel)
- **Ubicación**: `C:\laragon\www\api-postman`
- **Fecha**: 2025-08-07

## Objetivo
Realizar una revisión técnica del proyecto para detectar errores, inconsistencias y riesgos, y documentarlos como tareas a solucionar.

## Alcance
- Código de controladores, modelos y rutas (`app/`, `routes/`).
- Migraciones y esquema de BD (`database/migrations/`).
- Configuración de dependencias y build (`composer.json`, `package.json`, `vite.config.js`).
- Documentación (`README.md`, `docs/`).

## Plan
1. Leer `README.md` y verificar si incluye sección de estructura del proyecto.
2. Revisar rutas (`routes/api.php`) y controladores API V1.
3. Revisar modelos y relaciones Eloquent con migraciones.
4. Revisar configuración de build (Vite vs Mix) y dependencias.
5. Verificar consistencia de documentación en `docs/`.
6. Documentar hallazgos en `docs/errores_a_corregir.md` y actualizar `README.md` con estructura.

## Progreso
- Estructura listada y archivos clave revisados.
- Hallazgos críticos identificados (ver `docs/errores_a_corregir.md`).

## Hallazgos (resumen muy breve)
- Desalineación entre tablas pivote en migraciones y `belongsToMany` en modelos.
- Carga de relaciones inexistentes en `AnimalController::show()`.
- Rutas de attach/detach sin `auth:sanctum`.
- Inconsistencia entre Vite (`vite.config.js`) y `package.json` (Laravel Mix).
- `README.md` sin sección de estructura; `docs/tasks.md` desactualizado respecto al árbol real.

## Próximos pasos
- Mantener esta bitácora sincronizada al ir cerrando cada tarea documentada en `docs/errores_a_corregir.md`.

## Progreso (actualización)
- Ajustadas relaciones `belongsToMany` en modelos para alinear con tablas pivote reales (`agricultores_*` y claves `id_*`).
- Corregido `AnimalController::show()` para cargar solo `agricultores`.
- Protegidas rutas de attach/detach con `auth:sanctum`.
- Unificado frontend a Vite actualizando `package.json` (scripts y dependencias) acorde a `vite.config.js` existente.
- Endurecido `/api/login` con throttle y respuesta genérica.
- Actualizado `docs/tasks.md` para reflejar estructura real de `docs/`.
- Añadidas factories para datos de prueba (`database/factories/*`).
- Añadidas pruebas Feature de API para CRUD y relaciones en `tests/Feature/Api/V1/*` y de login.
- README actualizado con referencias a `database/factories/` y estructura de tests.

- Registrado `routes/api.php` en `bootstrap/app.php` para Laravel 12.
- Habilitadas factories en modelos (`HasFactory`) y fijados nombres de tablas.
- Configurado phpunit para usar SQLite en memoria en entorno de pruebas.
- Pruebas CRUD y relaciones ejecutándose; restan ajustes de aserciones de respuesta y borrado según negocio.
