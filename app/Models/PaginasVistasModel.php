<?php

namespace App\Models;

use CodeIgniter\Model;

class PaginasVistasModel extends Model
{
    
    protected $table         = 'paginas_vistas';
    protected $primaryKey    = 'IdPaginasVistas';
    protected $returnType    = 'object';
    protected $allowedFields = ['IP', 'Hora', 'Fecha', 'Pagina', 'Observaciones'];
    
    public function getPaginasVistasParams($ip, $fecha){
        
        $builder = $this->query($ip, $fecha);
        $query = $builder->get()->getResult();

        return $query;
    }

    public function countPaginasVistasParams($ip, $fecha){
        
        $builder = $this->query($ip, $fecha);
        $query = $builder->countAllResults();

        return $query;
    }

    public function query($ip, $fecha){
        $db = \Config\Database::connect();
        $builder = $db->table('paginas_vistas');
        $builder->select('*');
        if ($ip != null){
            $builder->where('IP', $ip);
        }
        if ($fecha != null){
            $builder->where('Fecha', $fecha);
        }   
        $builder->orderBy('Fecha', 'DESC');
        $builder->orderBy('Hora', 'ASC');
        $builder->orderBy('IP', 'ASC');
        $builder->limit(500);

        return $builder;
    }
}