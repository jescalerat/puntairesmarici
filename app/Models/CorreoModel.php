<?php

namespace App\Models;

use CodeIgniter\Model;

class CorreoModel extends Model
{
    
    protected $table         = 'correo';
    protected $primaryKey    = 'IdCorreo';
    protected $returnType    = 'object';
    protected $allowedFields = ['Nombre', 'Email', 'Mensaje', 'IP'];
    
}