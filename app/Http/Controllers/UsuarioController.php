<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function obtenerUsuario($id) {
            $usuario = Usuario::find($id);
            return response()->json($usuario);
        }
}
