<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * Define un comando de consola 'inspire' que muestra una cita motivacional.
 * 
 * Este comando utiliza la clase `Inspiring` de Laravel para obtener una 
 * cita aleatoria y mostrarla en la terminal cuando se ejecuta.
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
