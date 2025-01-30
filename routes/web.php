<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AsignacionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web de la aplicación.
|
*/

// Página de bienvenida (puedes cambiarla según tu proyecto)
Route::get('/', function () {
    return view('welcome');
});

// Redirección a Google para autenticación
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});

// Callback de Google (manejo de autenticación)
Route::get('/auth/callback/google', function () {
    try {
        $googleUser = Socialite::driver('google')->user(); // Eliminamos stateless() si causa problemas

        // Buscar al usuario en la base de datos o crearlo si no existe
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('default_password'), // Solo porque es requerido
            ]
        );

        // Autenticar al usuario en Laravel
        Auth::login($user);

        return redirect('/dashboard'); // Redirige al dashboard después de iniciar sesión

    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error al autenticar con Google.');
    }
});

// Ruta protegida para el Dashboard (solo usuarios autenticados)
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return "Bienvenido, " . Auth::user()->name . "!";
    }
    return redirect('/');
})->middleware('auth');

// Cerrar sesión
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/admin', function () {
    return view('admi');
});
//usuario
Route::get('/usuario/{id}', [UsuarioController::class, 'obtenerUsuario']);

route::get('/admin', [AsignacionController::class, 'index']);