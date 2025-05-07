<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Inicio extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        
        helper('funciones');
    }

    public function index()
    {
        $session = session();

        $registrado = $session->get('registrado');
        
        if ($registrado == null) {
            return redirect()->to(site_url('admin/login'));
        }
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $usuariosModel = model('UsuariosModel');
        $idUsuario = $session->get('usuario');
        
        $usuario = $usuariosModel->find($idUsuario);
        $nombre = $usuario->Nombre;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
        ];
        
        
		return view('paginas/admin/inicio', $data);
    }
}
