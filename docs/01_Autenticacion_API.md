# Tarea 01: Implementación de Autenticación para la API

**Objetivo:** Configurar Laravel Sanctum para proteger los endpoints de la API y permitir la generación de tokens para los usuarios.

**Requisitos Previos:**
* Haber completado la Tarea 00.

**Pasos a Seguir:**

1.  **Configurar el Modelo `User`:** Asegúrate de que tu modelo `User` (`app/Models/User.php`) use el trait `HasApiTokens`.
    ```php
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;
        // ...
    }
    ```

2.  **Crear un Endpoint de Autenticación (Login):** Este no será parte de la API `v1` protegida, sino la puerta de entrada. Añade esto a `routes/api.php`:
    ```php
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;

    Route::post('/login', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken
        ]);
    });
    ```

**Criterios de Aceptación:**
* Enviar una petición `POST` a `/api/login` con credenciales de usuario válidas devuelve un token de API.
* Enviar credenciales incorrectas devuelve un error `422` con un mensaje claro.