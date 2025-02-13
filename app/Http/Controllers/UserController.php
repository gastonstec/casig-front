<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para gestionar información de usuarios.
 */
class UserController extends Controller
{
    /**
     * Obtiene información de un usuario basado en los parámetros ingresados en la URL.
     * 
     * Este método simula la obtención de datos de un usuario proporcionando valores por defecto
     * en caso de que los parámetros no sean enviados en la solicitud.
     *
     * @param Request $request Objeto que contiene los parámetros de la solicitud.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con los datos del usuario.
     */
    public function getUserById(Request $request)
    {
        // Obtiene los valores de la URL, o deja vacíos los que no vengan
        $userId = $request->query('UserId', 'Aquí va el UserId');
        $name = $request->query('Name', 'Aquí va el nombre');
        $email = $request->query('Email', 'Aquí va el email');

        // Respuesta en JSON con valores dummy
        return response()->json([
            "UserId" => $userId,
            "Name" => $name,
            "Email" => $email,
            "Location" => "Aquí va la ubicación",
            "CallCenter" => "Aquí va el call center",
            "Position" => "Aquí va el puesto",
            "Supervisor" => "Aquí va el supervisor"
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
