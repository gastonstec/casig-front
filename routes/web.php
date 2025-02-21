<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EndUserController;
use App\Http\Controllers\DeviceAssignmentController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file registers the web routes of the application.
| It defines routes for Google authentication, session management,
| and user data retrieval, among other functionalities.
|
*/

/**
 * Home route.
 * Loads the welcome view.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Redirects to Google for authentication using OAuth2.
 * Uses Socialite to handle the Google authentication process.
 */
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});

/**
 * Callback route after Google authentication.
 * Retrieves authenticated user data, registers them in the database if they do not exist,
 * and logs them into the Laravel session before redirecting them to the dashboard.
 */
Route::get('/auth/callback/google', function () {
    try {
        // Retrieve authenticated user data from Google
        $googleUser = Socialite::driver('google')->user();

        // Find or create the user in the database
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()], // Search criteria
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('default_password'), // Default password (not used)
            ]
        );

        // Log the user into Laravel
        Auth::login($user);

        // Redirect to the dashboard
        return redirect('/dashboard');

    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error authenticating with Google.');
    }
});

/**
 * Dashboard route.
 * Accessible only to authenticated users.
 */
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return "Welcome, " . Auth::user()->name . "!";
    }
    return redirect('/');
})->middleware('auth');

/**
 * Logs out the user and redirects them to the homepage.
 */
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

/**
 * Admin panel route.
 * Loads the administrator view without querying the database.
 */
Route::get('/admin', function () {
    return view('admi');
});

/**
 * Retrieves a user from the API by their ID.
 * Calls the `getUserById` method in `EndUserController`.
 */
Route::get('/SnowGetUserId', [EndUserController::class, 'getUserById']);

/**
 * Retrieves a specific user from the database by their ID.
 * Calls the `getUser` method in `DeviceAssignmentController`.
 */
Route::get('/user/{id}', [DeviceAssignmentController::class, 'getUser']);

/**
 * Route for the equipment assignment view.
 * Loads the assignment view without database interaction.
 */
Route::get('/assignment', function () {
    return view('admi');
});

/**
 * Route for the DSS user interface.
 */
Route::get('/dss', function () {
    return view('dss');
});

/**
 * Route for the regular user interface.
 */
Route::get('/user', function () {
    return view('user');
});
