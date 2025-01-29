<?php

namespace App\Models;

use CodeIgniter\Model;

class PaginasVistasModel extends Model
{
    
    protected $table         = 'paginas_vistas';
    protected $primaryKey    = 'IdPaginasVistas';
    protected $returnType    = 'array';
    protected $allowedFields = ['IP', 'Hora', 'Fecha', 'Pagina', 'Observaciones'];
    
}