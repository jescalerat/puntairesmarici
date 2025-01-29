<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitasModel extends Model
{
    
    protected $table         = 'visitas';
    protected $primaryKey    = 'IdVisitas';
    protected $returnType    = 'array';
    protected $allowedFields = ['IP', 'Hora', 'Fecha', 'Idioma'];
    
}