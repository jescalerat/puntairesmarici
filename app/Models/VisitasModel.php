<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitasModel extends Model
{
    
    protected $table         = 'visitas';
    protected $primaryKey    = 'IdVisitas';
    protected $returnType    = 'object';
    protected $allowedFields = ['IP', 'Hora', 'Fecha', 'Idioma'];
    
    public function getAll(){
        
        $db = \Config\Database::connect();
        $builder = $db->table('visitas');
        $builder->select('*');
        $builder->join('idiomas', 'idiomas.IdIdioma = visitas.Idioma', 'left');
        $builder->orderBy('Fecha', 'DESC');
        $builder->orderBy('Hora', 'ASC');
        $builder->orderBy('IP', 'ASC');
        $builder->limit(500);
        
        $query = $builder->get()->getResult();

        return $query;
    }

    public function getFechaActual(){
        
        $db = \Config\Database::connect();
        $builder = $db->table('visitas');
        $builder->select('*');
        $builder->orderBy('Fecha', 'DESC');
        $builder->orderBy('Hora', 'ASC');
        $builder->orderBy('IP', 'ASC');
        $builder->limit(1);
        
        $query = $builder->get()->getRow();

        return $query;
    }

    public function getVisitasDia($fechaactual){
        
        $db = \Config\Database::connect();
        $builder = $db->table('visitas');
        $builder->select('*');
        $builder->where('Fecha', $fechaactual);
        
        $query = $builder->countAllResults();

        return $query;
    }

    public function getVisitasDiaDistintas($fechaactual){
        
        $db = \Config\Database::connect();
        $builder = $db->table('visitas');
        $builder->select('IP');
        $builder->distinct();
        $builder->where('Fecha', $fechaactual);
        
        $query = $builder->countAllResults();

        return $query;
    }
}