<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

class AsignacionController extends Controller
{
    public function index()
        {
            $usuarios = Usuario::all(); // Obtener todos los usuarios desde la base de datos
            return view('admi', compact('usuarios')); // Enviar los usuarios a la vista
        }
}
