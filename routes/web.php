<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsignacionController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web de la aplicación.
| Se definen rutas para autenticación con Google, manejo de sesiones
| y consulta de usuarios, entre otros.
|
*/

/**
 * Ruta de inicio.
 * Carga la vista de bienvenida.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Redirección a Google para autenticación con OAuth2.
 * Usa Socialite para manejar la autenticación con Google.
 */
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});

/**
 * Callback de Google después de la autenticación.
 * Obtiene los datos del usuario autenticado y lo registra en la base de datos si no existe.
 * Luego, lo autentica en la sesión de Laravel y lo redirige al dashboard.
 */
Route::get('/auth/callback/google', function () {
    try {
        // Obtener datos del usuario autenticado en Google
        $googleUser = Socialite::driver('google')->user();

        // Buscar o crear el usuario en la base de datos
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()], // Criterio de búsqueda
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('default_password'), // Contraseña por defecto (no usada)
            ]
        );

        // Iniciar sesión en Laravel con el usuario autenticado
        Auth::login($user);

        // Redirigir al dashboard
        return redirect('/dashboard');

    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error al autenticar con Google.');
    }
});

/**
 * Ruta del Dashboard.
 * Solo accesible para usuarios autenticados.
 */
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return "Bienvenido, " . Auth::user()->name . "!";
    }
    return redirect('/');
})->middleware('auth');

/**
 * Cierra la sesión del usuario y lo redirige a la página de inicio.
 */
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

/**
 * Ruta de la vista de administrador.
 * Solo carga la vista sin consultar la base de datos.
 */
Route::get('/admin', function () {
    return view('admi');
});

/**
 * Obtiene un usuario desde la API por su ID.
 * Llama al método `getUserById` en `UserController`.
 */
Route::get('/SnowGetUserId', [UserController::class, 'getUserById']);

/**
 * Obtiene un usuario específico por su ID desde la base de datos.
 * Llama al método `getUsuario` en `AsignacionController`.
 */
Route::get('/usuario/{id}', [AsignacionController::class, 'getUsuario']);

/**
 * Ruta para la vista de asignación de equipos.
 * Solo carga la vista sin interactuar con la base de datos.
 */
Route::get('/asignacion', function () {
    return view('admi');
});