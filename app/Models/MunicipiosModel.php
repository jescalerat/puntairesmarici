<?php

namespace App\Models;

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
    
    protected $table         = 'municipios';
    protected $primaryKey    = 'IdMunicipio';
    protected $returnType    = 'object';
    protected $allowedFields = ['IdMunicipio', 'IdProvincia', 'Municipio'];
    
    public function getMunicipiosParams($idProvincia){
        
        $db = \Config\Database::connect();
        $builder = $db->table('municipios');
        $builder->select('*');
        $builder->where('IdProvincia', $idProvincia);

        $query = $builder->get()->getResult();

        return $query;
    }

    public function getMunicipiosAdminParams($idProvincia){
        $db = \Config\Database::connect();
        $builder = $db->table('municipios');
        $builder->select('*');
        $builder->join('provincias', 'provincias.IdProvincia = municipios.IdProvincia', 'left');
        if ($idProvincia != null){
            $builder->where('provincias.IdProvincia', $idProvincia);
        }

        $builder->orderBy('municipios.Municipio', 'ASC');

        $query = $builder->get()->getResult();

        return $query;
    }

    public function getMaxMunicipio(){
        $db = \Config\Database::connect();
        $builder = $db->table('municipios');
        $builder->select('*');
        
        $builder->orderBy('IdMunicipio', 'DESC');

        $query = $builder->get()->getRow();

        return $query;
    }
}