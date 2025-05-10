<?php

namespace App\Models;

use CodeIgniter\Model;

class EncuentrosModel extends Model
{
    
    protected $table         = 'encuentros';
    protected $primaryKey    = 'IdEncuentro';
    protected $returnType    = 'object';
    protected $allowedFields = ['IdEncuentro', 'IdMunicipio', 'Descripcion', 'Dia', 'Mes', 'Anyo'];
    
    public function getEncuentrosParams($mes, $ano){
        $db = \Config\Database::connect();
        $builder = $db->table('encuentros');
        $builder->select('*');
        $builder->where('Mes', $mes);
        $builder->where('Anyo', $ano);

        $query = $builder->get()->getResult();

        return $query;
    }

    public function getListaEncuentrosParams($dia, $mes, $ano, $idComunidad, $idProvincia, $idMunicipio, $buscador){
        
        $builder = $this->query($dia, $mes, $ano, $idComunidad, $idProvincia, $idMunicipio, $buscador);
        $query = $builder->get()->getResult();

        return $query;
    }

    public function countListaEncuentrosParams($dia, $mes, $ano, $idComunidad, $idProvincia, $idMunicipio, $buscador){
        
        $builder = $this->query($dia, $mes, $ano, $idComunidad, $idProvincia, $idMunicipio, $buscador);
        $query = $builder->countAllResults();

        return $query;
    }

    public function query($dia, $mes, $ano, $idComunidad, $idProvincia, $idMunicipio, $buscador){
        $db = \Config\Database::connect();
        $builder = $db->table('encuentros');
        $builder->select('*');
        $builder->join('municipios', 'municipios.IdMunicipio = encuentros.IdMunicipio', 'left');
        $builder->join('provincias', 'provincias.IdProvincia = municipios.IdProvincia', 'left');
        $builder->join('comunidades', 'comunidades.IdComunidad = provincias.IdComunidad', 'left');
        if ($ano != null){
            $builder->where('encuentros.Anyo', $ano);
        }
        if ($idComunidad != null){
            $builder->where('comunidades.IdComunidad', $idComunidad);
        }
        if ($idProvincia != null){
            $builder->where('provincias.IdProvincia', $idProvincia);
        }
        if ($idMunicipio != null){
            $builder->where('municipios.IdMunicipio', $idMunicipio);
        }
        if (!$buscador){
            $builder->where('encuentros.Dia', $dia);
            $builder->where('encuentros.Mes', $mes);
            $builder->where('encuentros.Anyo', $ano);
        }

        $builder->orderBy('encuentros.Anyo', 'ASC');
        $builder->orderBy('encuentros.Mes', 'ASC');
        $builder->orderBy('encuentros.Dia', 'ASC');
        $builder->orderBy('municipios.Municipio', 'ASC');

        return $builder;
    }

    public function getAnyosEncuentros(){
        $db = \Config\Database::connect();
        $builder = $db->table('encuentros');
        $builder->select('Anyo');
        $builder->distinct();
        $builder->orderBy('Anyo', 'DESC');

        $query = $builder->get()->getResult();

        return $query;
    }

    public function getEncuentro($idEncuentro){
        $db = \Config\Database::connect();
        $builder = $db->table('encuentros');
        $builder->select('*');
        $builder->join('municipios', 'municipios.IdMunicipio = encuentros.IdMunicipio', 'left');
        $builder->where('encuentros.IdEncuentro', $idEncuentro);

        $query = $builder->get()->getRow();

        return $query;
    }

    public function getMaxEncuentro(){
        $db = \Config\Database::connect();
        $builder = $db->table('encuentros');
        $builder->select('*');
        
        $builder->orderBy('IdEncuentro', 'DESC');

        $query = $builder->get()->getRow();

        return $query;
    }
}