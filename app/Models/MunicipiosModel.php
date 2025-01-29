<?php

namespace App\Models;

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
    
    protected $table         = 'municipios';
    protected $primaryKey    = 'IdMunicipio';
    protected $returnType    = 'object';
    protected $allowedFields = ['IdProvincia', 'Municipio'];
    
    public function getMunicipiosParams($idProvincia){
        
        $db = \Config\Database::connect();
        $builder = $db->table('municipios');
        $builder->select('*');
        $builder->where('IdProvincia', $idProvincia);

        $query = $builder->get()->getResult();

        return $query;
    }
}