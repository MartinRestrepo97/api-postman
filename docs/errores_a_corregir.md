# Errores, Inconsistencias y Tareas a Corregir

Estado: abierto

## 1) Pivotes Eloquent no coinciden con migraciones
- **Síntoma**: En los modelos `Agricultor`, `Finca`, `Animal`, `Vegetal`, `Preparado` las relaciones `belongsToMany` apuntan a pivotes `agricultor_finca`, `agricultor_animal`, etc.
- **Hecho en migraciones**: Las tablas creadas son `agricultores_fincas`, `agricultores_animales`, `agricultores_vegetales`, `agricultores_preparados`, con columnas `id_agricultor` y `id_*`.
- **Impacto**: Fallos al consultar/adjuntar relaciones (Eloquent buscará otra tabla y campos `agricultor_id`, `finca_id`, etc.).
- **Acción propuesta**:
  - Opción A (recomendada): Actualizar modelos para especificar tabla pivote y claves personalizadas, p.ej.:
    - `belongsToMany(Finca::class, 'agricultores_fincas', 'id_agricultor', 'id_finca')`
  - Opción B: Renombrar tablas y columnas de migraciones a convención Laravel (`agricultor_finca` con `agricultor_id`, `finca_id`).

## 2) `AnimalController::show()` carga relaciones inexistentes
- **Código**: `AnimalController::show()` hace `$animal->load('fincas', 'animales', 'vegetales', 'preparados');`
- **Problema**: El modelo `Animal` solo define relación `agricultores()`. No existen `fincas`, `animales`, `vegetales`, `preparados` en `Animal`.
- **Impacto**: Excepción al intentar cargar relaciones no definidas.
- **Acción**: Reemplazar por `$animal->load('agricultores');` o definir relaciones reales si se requieren.

## 3) Rutas de relaciones Many-to-Many sin middleware de autenticación
- **Código**: Rutas `attach*/detach*` bajo `Route::prefix('v1')` sin `auth:sanctum`.
- **Impacto**: Permite modificar relaciones sin autenticación.
- **Acción**: Mover estas rutas dentro del grupo protegido por `->middleware('auth:sanctum')` o aplicar middleware a cada ruta.

## 4) Inconsistencia Vite vs Laravel Mix
- **Archivos**: `vite.config.js` presente, pero `package.json` usa scripts y dependencias de `laravel-mix` (webpack) antiguos.
- **Impacto**: Conflictos de build; `npm run build` del README no coincide con scripts actuales.
- **Acción**: Unificar a Vite (recomendado con Laravel 12):
  - Actualizar `package.json` con scripts Vite (`vite`, `vite build`, `vite dev`) y dependencias modernas (axios, tailwind, etc. si aplica).
  - Eliminar `laravel-mix` y dependencias relacionadas.
  - Ajustar README para comandos Vite.

## 5) Falta de estructura del proyecto en README
- **Estado**: Se ha agregado sección "Estructura del Proyecto" para cumplir con la norma del repositorio.
- **Acción futura**: Mantenerla actualizada al crear/modificar/eliminar archivos y carpetas.

## 6) `docs/tasks.md` desactualizado
- **Contenido**: Muestra un árbol `docs/tasks/...` que no coincide exactamente con la estructura real.
- **Acción**: Actualizar para reflejar `docs/` actual o referenciar la nueva sección de estructura en `README.md`.

## 7) Validaciones y tipos de columnas de `imagen`
- **Observación**: Migraciones usan `text('imagen')` para varios recursos; validación en controladores exige `string`.
- **Impacto**: No es crítico, pero inconsistente. Si se almacenan URLs largas/base64, mantener `text`; si son rutas cortas, podría ser `string` con límite.
- **Acción**: Alinear validación con tamaño real esperado o ajustar tipo de columna.

## 8) Semántica de `documento` única en `agricultores`
- **Estado**: OK, validación `unique` está presente en `store` y `update` (ignora el ID actual).
- **Acción**: Sin cambios. Solo verificar índice único en migración (ya está).

## 9) Scripts de Composer dev
- **Observación**: Script `dev` en `composer.json` usa `npx concurrently` y mezcla `php artisan serve`, `queue:listen`, `pail`, y `npm run dev`.
- **Impacto**: En Windows sin `concurrently` global puede fallar; además mezcla toolings (Mix vs Vite) descritos en el punto 4.
- **Acción**: Revisar o eliminar script `dev` de Composer; preferir `php artisan serve` y `npm run dev` por separado con Vite.

## 10) Seguridad: login sin rate limiting ni respuestas homogéneas
- **Código**: `/api/login` devuelve mensaje de error específico en email; no aplica throttling.
- **Impacto**: Posible user enumeration y brute force.
- **Acción**: Agregar `ThrottleRequests` y respuesta genérica; considerar `Fortify` o middleware de rate limit.

## 11) Versionado de dependencias
- **Observación**: `laravel/framework:^12`, `php:^8.2` correctos; `phpunit:^11.5.3` ok.
- **Acción**: Verificar compatibilidad de `filament/filament:^3.2` con Laravel 12; revisar `laravel/ui` necesidad real.

## 12) Tests
- **Observación**: Solo ejemplos base; no hay pruebas para endpoints CRUD ni relaciones.
- **Acción**: Añadir pruebas Feature para CRUD y attach/detach, incluyendo errores 401/422/404.

## 13) API no registrada en Laravel 12 (bootstrap)
- **Problema**: `routes/api.php` no estaba registrado en `bootstrap/app.php` (Laravel 12 usa `Application::configure()->withRouting`).
- **Impacto**: Endpoints `/api/...` no existían (404) al correr tests/entorno.
- **Acción**: Registrar `api: __DIR__.'/../routes/api.php'` en `bootstrap/app.php`. Estado: corregido.

---

## Checklist de corrección
- [x] Armonizar pivotes en modelos (o renombrar migraciones y columnas).
- [x] Corregir `AnimalController::show()`.
- [x] Proteger rutas de attach/detach con `auth:sanctum`.
- [x] Migrar `package.json` a Vite y remover Mix.
- [x] Actualizar `docs/tasks.md`.
- [ ] Evaluar tipo y validación de `imagen`.
- [x] Mejorar seguridad del login (rate limit y mensajes).
- [x] Añadir pruebas Feature y Unit para API (CRUD y relaciones principales).
- [ ] Ampliar cobertura de pruebas (errores 404/422 detallados y casos límite).
