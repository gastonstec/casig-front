<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model representing a technician in the system.
 *
 * This model manages the information of technicians registered in the database.
 */
class Technician extends Model
{
    use HasFactory;

    /**
     * Name of the database table associated with this model.
     *
     * @var string
     */
    protected $table = 'tecnicos'; // Ensure the table name matches your database schema

    /**
     * Attributes that can be mass-assigned.
     *
     * These fields can be filled using `Technician::create([...])` or `fill([...])`.
     *
     * @var array<string>
     */
    protected $fillable = [
        'email' // Technician's email address
    ];
}

