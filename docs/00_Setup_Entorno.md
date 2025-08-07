# Tarea 00: Configuración y Preparación del Entorno

**Objetivo:** Asegurar que el proyecto base de Laravel esté actualizado y tenga instaladas las dependencias fundamentales para el desarrollo del API y el panel de administración.

**Requisitos Previos:**
* Un proyecto Laravel existente (basado en el análisis de AMCA).
* Composer y Node.js instalados en el entorno de desarrollo.

**Pasos a Seguir:**

1.  **Actualizar Laravel (Recomendado):** Para compatibilidad con paquetes modernos, asegúrate de estar en una versión LTS como Laravel 10+. Sigue la guía oficial de actualización de Laravel si es necesario.

2.  **Instalar Laravel Sanctum:** Este paquete gestionará la autenticación de nuestra API.
    ```bash
    composer require laravel/sanctum
    ```

3.  **Publicar Archivos de Sanctum:** Expone la configuración y la migración de Sanctum.
    ```bash
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    ```

4.  **Instalar Filament (Panel de Administración):**
    ```bash
    composer require filament/filament:"^3.2" -W
    php artisan filament:install --panels
    ```

5.  **Ejecutar Migraciones:** Aplica las migraciones pendientes, incluyendo la de Sanctum.
    ```bash
    php artisan migrate
    ```

**Criterios de Aceptación:**
* El comando `composer install` se ejecuta sin errores.
* El panel de Filament es accesible en `/admin` (o la URL que hayas configurado).
* La tabla `personal_access_tokens` existe en la base de datos.