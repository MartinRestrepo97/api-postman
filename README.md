## Credenciales de Acceso (por defecto)

Al ejecutar los seeders, se crea un usuario de prueba para acceder al sistema y a la API:

- **Email:** test@example.com
- **Password:** password

Puedes modificar estos datos en el archivo `database/seeders/DatabaseSeeder.php` o crear nuevos usuarios desde el panel Filament.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## Lógica y Función del Proyecto

Este proyecto es una API RESTful desarrollada en Laravel, orientada a la gestión de recursos agrícolas. Permite administrar agricultores, fincas, animales, vegetales y preparados, así como sus relaciones. Incluye autenticación, validación, pruebas automatizadas y un panel administrativo con Filament.

### Recursos principales:
- **Agricultores**: CRUD completo, relaciones con fincas, animales, vegetales y preparados.
- **Fincas**: CRUD y asociación a agricultores.
- **Animales**: CRUD y asociación a agricultores.
- **Vegetales**: CRUD y asociación a agricultores.
- **Preparados**: CRUD y asociación a agricultores.

### Funcionalidades destacadas:
- Autenticación con token (login y protección de rutas).
- Validación de datos y manejo de errores (401, 404, 422).
- Pruebas automatizadas con Postman (ver carpeta `docs/AMCA_API_V1.postman_collection.json`).
- Panel administrativo con Filament para gestión visual de los recursos.

## Modo de Ejecución

### Requisitos previos
- PHP >= 8.3
- Composer
- MySQL
- Node.js y npm (opcional, para assets front-end)

### Instalación y ejecución
1. Clona el repositorio y accede a la carpeta del proyecto.
2. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno (DB, APP_URL, etc).
3. Instala dependencias:
   ```bash
   composer install
   ```
4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```
5. Ejecuta las migraciones y seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```
6. (Opcional) Compila los assets:
   ```bash
   npm install && npm run build
   ```
7. Inicia el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

### Acceso al panel Filament
Accede a `/admin` en tu navegador (por ejemplo: http://localhost:8000/admin) e inicia sesión con un usuario existente.

### Pruebas de la API
Importa la colección Postman desde `docs/AMCA_API_V1.postman_collection.json` y ejecuta las pruebas para validar todos los endpoints y casos de error.

---
El Laravel framework es open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
