<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    protected $fillable = ['id','nombre','fecha','hora','descripcion','cantParticipantes','imagen','listaParticipantes','idvoluntarios'];
}
