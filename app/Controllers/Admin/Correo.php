<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Correo extends BaseController
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

        $correoModel = model('CorreoModel');
        $listaCorreos = $correoModel->findAll();
        

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listacorreos'    => $listaCorreos,
        ];
        
        
		return view('paginas/admin/correo', $data);
    }

    public function eliminar($idCorreo)
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

        $correoModel = model('CorreoModel');
        $correoModel->delete($idCorreo);
        $listaCorreos = $correoModel->findAll();   

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listacorreos'    => $listaCorreos,
        ];
        
        
		return view('paginas/admin/correo', $data);
    }

    
}
