<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Tecnico;
use App\Models\Dispositivo;

/**
 * Controlador para la asignación de equipos y gestión de usuarios, técnicos y dispositivos.
 */
class AsignacionController extends Controller
{
    /**
     * Carga la vista principal sin usuarios desde la BD, ya que estos se consultarán vía API.
     *
     * @return \Illuminate\View\View Vista de la página de administración.
     */
    public function index()
    {
        $tecnicos = Tecnico::all(); // Obtener todos los técnicos desde la BD
        $dispositivos = Dispositivo::all(); // Obtener todos los dispositivos desde la BD

        return view('admi', compact('tecnicos', 'dispositivos'));
    }

    /**
     * Obtiene la información de un usuario desde una API externa.
     *
     * @param int $id ID del usuario a buscar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con los datos del usuario o un mensaje de error.
     */
    public function getUsuario($id)
    {
        $apiUrl = "http://127.0.0.1:8000/SnowGetUserId?UserId={$id}";

        try {
            $response = file_get_contents($apiUrl);

            if ($response === FALSE) {
                return response()->json(['error' => 'Usuario no encontrado en la API'], 404);
            }

            return response()->json(json_decode($response));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al conectar con la API'], 500);
        }
    }

    /**
     * Obtiene la información de un técnico desde la base de datos.
     *
     * @param int $id ID del técnico a buscar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con los datos del técnico o un mensaje de error.
     */
    public function getTecnico($id)
    {
        $tecnico = Tecnico::find($id);

        if (!$tecnico) {
            return response()->json(['error' => 'Técnico no encontrado'], 404);
        }

        return response()->json($tecnico);
    }

    /**
     * Obtiene la información de un dispositivo desde la base de datos.
     *
     * @param int $id ID del dispositivo a buscar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con los datos del dispositivo o un mensaje de error.
     */
    public function getDispositivo($id)
    {
        $dispositivo = Dispositivo::find($id);

        if (!$dispositivo) {
            return response()->json(['error' => 'Dispositivo no encontrado'], 404);
        }

        return response()->json($dispositivo);
    }
}
