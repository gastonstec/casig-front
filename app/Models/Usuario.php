<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo que representa a un usuario dentro del sistema.
 *
 * Este modelo gestiona la información de los usuarios registrados en la base de datos.
 */
class Usuario extends Model
{
    use HasFactory;
    
    /**
     * Nombre de la tabla en la base de datos asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Atributos que pueden ser asignados masivamente.
     *
     * Estos campos pueden ser llenados con `Usuario::create([...])` o `fill([...])`.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',     // Nombre del usuario
        'supervisor', // Nombre del supervisor asignado
        'centro',     // Centro de trabajo del usuario
        'correo',     // Dirección de correo electrónico
        'ubicacion'   // Ubicación física del usuario dentro de la empresa
    ];
}
