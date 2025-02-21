<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model representing an end user within the system.
 *
 * This model manages the information of users registered in the database.
 */
class EndUser extends Model
{
    use HasFactory;
    
    /**
     * Name of the database table associated with this model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Attributes that can be mass-assigned.
     *
     * These fields can be filled using `EndUser::create([...])` or `fill([...])`.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',        // User's name
        'supervisor',  // Assigned supervisor's name
        'center',      // User's work center
        'email',       // Email address
        'location'     // User's physical location within the company
    ];
}