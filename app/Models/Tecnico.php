<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un técnico en el sistema.
 *
 * Este modelo gestiona la información de los técnicos registrados en la base de datos.
 */
class Tecnico extends Model
{
    /**
     * Nombre de la tabla en la base de datos asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'tecnicos';

    /**
     * Atributos que pueden ser asignados masivamente.
     *
     * Estos campos pueden ser llenados con `Tecnico::create([...])` o `fill([...])`.
     *
     * @var array
     */
    protected $fillable = [
        'correo' // Dirección de correo electrónico del técnico
    ];
}
