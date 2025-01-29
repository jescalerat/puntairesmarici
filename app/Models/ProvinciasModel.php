<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinciasModel extends Model
{
    
    protected $table         = 'provincias';
    protected $primaryKey    = 'IdProvincia';
    protected $returnType    = 'object';
    protected $allowedFields = ['IdComunidad', 'Provincia'];
    
    public function getProvinciasParams($idComunidad){
        
        $db = \Config\Database::connect();
        $builder = $db->table('provincias');
        $builder->select('*');
        $builder->where('IdComunidad', $idComunidad);

        $query = $builder->get()->getResult();

        return $query;
    }
}