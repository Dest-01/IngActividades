<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizaciones extends Model
{
    protected $fillable = ['id','nombre', 'telefono', 'correo'];
}
