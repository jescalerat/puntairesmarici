<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Contactar extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        helper('funciones');

        $session = session();
        $idiom = $session->get('language');

        $lang = service('language');
        $lang->setLocale($idiom); 
        
    }

    public function index(): string
    {
        $session = session();
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);
        $contactaCorrecto = null;

        $data = [
            'contador'   => $contador,
            'contactaCorrecto'   => $contactaCorrecto,
        ];
        
		return view('paginas/contactar', $data);
    }

    public function mensaje(): string
    {
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $mensaje = $this->request->getPost('mensaje');

        $contactaCorrecto = "OK";

        $correoModel = model('CorreoModel');
        $IP = getRealIP();
        $dataInsert = array(
            'IP' => $IP,
            'Nombre'  => $nombre,
            'Email'  => $correo,
            'Mensaje'  => $mensaje
        );
        $correoModel->insert($dataInsert);


        $data = [
            'contador'   => $contador,
            'contactaCorrecto'   => $contactaCorrecto,
        ];
        
		return view('paginas/contactar', $data);

    }
    
}
