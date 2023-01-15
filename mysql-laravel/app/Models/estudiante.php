<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    protected $table = 'estudiante';
    public $timestamps = false;
    protected $fillable = ['id', 'nombres', 'apellidos', 'telefono'];
}
