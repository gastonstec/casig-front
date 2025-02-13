<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

/**
 * Controlador para la gestión de usuarios.
 */
class UsuarioController extends Controller
{
    /**
     * Obtiene la información de un usuario basado en su ID.
     *
     * Este método busca un usuario en la base de datos y retorna sus datos en formato JSON.
     * 
     * @param int $id El ID del usuario a buscar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con la información del usuario,
     *                                      o `null` si el usuario no existe.
     */
    public function obtenerUsuario($id) 
    {
        $usuario = Usuario::find($id);

        return response()->json($usuario);
    }
}

