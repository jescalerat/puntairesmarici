<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    
    protected $table         = 'usuarios';
    protected $primaryKey    = 'IdUsuario';
    protected $returnType    = 'object';
    protected $allowedFields = ['IP', 'Nombre', 'Usuario', 'Password'];
    
    public function getUsuariosParams($usuario, $password){
        
        $builder = $this->query($usuario, $password);
        $query = $builder->get()->getRow();

        return $query;
    }

    public function countUsuariosParams($usuario, $password){
        
        $builder = $this->query($usuario, $password);
        $query = $builder->countAllResults();

        return $query;
    }

    public function query($usuario, $password){
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');
        $builder->select('*');
        $builder->where('Usuario', $usuario);
        $builder->where('Password', $password);

        return $builder;
    }
}