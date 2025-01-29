<?php

namespace App\Models;

use CodeIgniter\Model;

class CartelesModel extends Model
{
    
    protected $table         = 'carteles';
    protected $primaryKey    = 'IdCartel';
    protected $returnType    = 'array';
    protected $allowedFields = ['IdEncuentro', 'Carteles'];

    public function getCartelesParams($idEncuentro){
        
        $builder = $this->query($idEncuentro);
        $query = $builder->get()->getResult();

        return $query;
    }

    public function countListaCartelesParams($idEncuentro){
        
        $builder = $this->query($idEncuentro);
        $query = $builder->countAllResults();

        return $query;
    }

    public function query($idEncuentro){
        $db = \Config\Database::connect();
        $builder = $db->table('carteles');
        $builder->select('*');
        $builder->where('IdEncuentro', $idEncuentro);

        return $builder;
    }
    
}