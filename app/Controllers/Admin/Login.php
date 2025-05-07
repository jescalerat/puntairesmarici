<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        helper('funciones');
        
    }

    public function index(): string
    {
        $session = session();
        
        $error = null;
        $nombre = null;

        $data = [ 
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/login', $data);
    }

    public function comprobar()
    {
        $session = session();
        
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $usuariosModel = model('UsuariosModel');
        $existeUsuario = $usuariosModel->countUsuariosParams($usuario, $password);

        if ($existeUsuario > 0){
            $usuario = $usuariosModel->getUsuariosParams($usuario, $password);

            $session->set('registrado',1);
            $session->set('usuario',$usuario->IdUsuario);
            return redirect()->to(site_url('admin/inicio'));
        } else {
            $error="Usuario no existente";
            $data = [ 
                'error'    => $error,
            ];
            return view('paginas/admin/login', $data);
        }
    }
}
