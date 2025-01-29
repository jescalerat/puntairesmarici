<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class CambioIdioma extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        helper('funciones');
        
    }

    public function index($idioma)
    {
        $session = session();
        
        if ("es" == $idioma){
            $nuevoIdioma = "spanish";
        } else if ("en" == $idioma) {
            $nuevoIdioma = "english";
        } else if ("ca" == $idioma) {
            $nuevoIdioma = "catalan";
        } else {
            $nuevoIdioma = "spanish";
        }

        $session->set('cambioIdioma',$nuevoIdioma);

         
		return redirect()->to(site_url('/'));
    }

    
    
}
