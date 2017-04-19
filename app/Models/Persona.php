<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    protected $table='personas';
   	protected $primaryKey='PER_id';
   	
    protected $fillable = [
        'PER_nombre', 'PER_apellido_p', 'PER_apellido_m',
    ];

}
