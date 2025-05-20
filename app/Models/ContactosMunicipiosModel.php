<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactosMunicipiosModel extends Model
{
    
    protected $table         = 'contactos_municipios';
    protected $primaryKey    = 'IdContacto';
    protected $returnType    = 'array';
    protected $allowedFields = ['IdContacto','IdMunicipio'];
    
    public function getContactosMunicipiosParams($idMunicipio){
        
        $db = \Config\Database::connect();
        $builder = $db->table('contactos_municipios');
        $builder->select('*');
        $builder->join('contactos', 'contactos.IdContacto = contactos_municipios.IdContacto', 'left');
        $builder->where('contactos_municipios.IdMunicipio', $idMunicipio);

        $query = $builder->get()->getResult();

        return $query;
    }

    public function deleteCM($idContacto, $idMunicipio){
        
        $db = \Config\Database::connect();
        $builder = $db->table('contactos_municipios');
        $builder->where('IdContacto', $idContacto);
        $builder->where('IdMunicipio', $idMunicipio);
        $builder->delete();

        return null;
    }

    
}