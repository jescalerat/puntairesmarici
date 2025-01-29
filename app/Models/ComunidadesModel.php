<?php

namespace App\Models;

use CodeIgniter\Model;

class ComunidadesModel extends Model
{
    
    protected $table         = 'comunidades';
    protected $primaryKey    = 'IdComunidad';
    protected $returnType    = 'object';
    protected $allowedFields = ['Comunidad'];
    
}