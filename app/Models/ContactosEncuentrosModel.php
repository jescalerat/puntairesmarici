<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactosEncuentrosModel extends Model
{
    
    protected $table         = 'contactos_encuentros';
    protected $primaryKey    = 'IdContacto';
    protected $returnType    = 'array';
    protected $allowedFields = ['IdContacto','IdEncuentro'];
    
    public function getContactosEncuentrosParams($idEncuentro){
        
        $db = \Config\Database::connect();
        $builder = $db->table('contactos_encuentros');
        $builder->select('*');
        $builder->join('contactos', 'contactos.IdContacto = contactos_encuentros.IdContacto', 'left');
        $builder->where('contactos_encuentros.IdEncuentro', $idEncuentro);

        $query = $builder->get()->getResult();

        return $query;
    }

    public function getContactosMunicipiosParams($idMunicipio){
        
        $db = \Config\Database::connect();
        $builder = $db->table('contactos_encuentros');
        $builder->select('*');
        $builder->join('contactos', 'contactos.IdContacto = contactos_encuentros.IdContacto', 'left');
        $builder->join('encuentros', 'encuentros.IdEncuentro = contactos_encuentros.IdEncuentro', 'left');
        $builder->join('municipios', 'municipios.IdMunicipio = encuentros.IdMunicipio', 'left');
        $builder->where('municipios.IdMunicipio', $idMunicipio);

        $query = $builder->get()->getResult();

        return $query;
    }

    public function deleteCE($idContacto, $idEncuentro){
        
        $db = \Config\Database::connect();
        $builder = $db->table('contactos_encuentros');
        $builder->where('IdContacto', $idContacto);
        $builder->where('IdEncuentro', $idEncuentro);
        $builder->delete();

        return null;
    }

    
}