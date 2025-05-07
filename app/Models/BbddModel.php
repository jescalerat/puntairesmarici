<?php

namespace App\Models;

use CodeIgniter\Model;

class BbddModel extends Model
{

    public function ejecutarQuery($query){
        
        $db = \Config\Database::connect();
        
        if ($db->simpleQuery($query)) {
            $error = 'Correcto';
        } else {
            $error = 'KO';
        }
        return $error;
    }

    
}