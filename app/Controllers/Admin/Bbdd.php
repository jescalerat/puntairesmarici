<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Bbdd extends BaseController
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

        $error = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/bbdd', $data);
    }

    public function actualizar()
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

        
        $mensaje = $this->request->getPost('mensaje');

        $bbddModel = model('BbddModel');
        $error = $bbddModel->ejecutarQuery($mensaje);
        
        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/bbdd', $data);
    }

    
}
