<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactosModel extends Model
{
    
    protected $table         = 'contactos';
    protected $primaryKey    = 'IdContacto';
    protected $returnType    = 'array';
    protected $allowedFields = ['Contacto'];
    
    public function getContactosParams($idEncuentro){
        
        $builder = $this->query($idEncuentro);
        $query = $builder->get()->getResult();

        return $query;
    }

    public function countContactosParams($idEncuentro){
        
        $builder = $this->query($idEncuentro);
        $query = $builder->countAllResults();

        return $query;
    }

    public function query($idEncuentro){
        $db = \Config\Database::connect();
        $builder = $db->table('contactos');
        $builder->select('*');
        $builder->join('contactos_encuentros', 'contactos.IdContacto = contactos_encuentros.IdContacto', 'left');
        $builder->where('contactos_encuentros.IdEncuentro', $idEncuentro);

        return $builder;
    }
    
}