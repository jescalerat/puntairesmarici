<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Visitas extends BaseController
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

        $visitasModel = model('VisitasModel');
        $listaVisitas = $visitasModel->getAll();
        $fecha_actual = $visitasModel->getFechaActual();
        

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listavisitas'    => $listaVisitas,
            'fecha_actual'    => $fecha_actual->Fecha,
        ];
        
        
		return view('paginas/admin/visitas', $data);
    }

    public function eliminar($idVisita)
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

        $visitasModel = model('VisitasModel');
        $visitasModel->delete($idVisita);

        $listaVisitas = $visitasModel->getAll();
        $fecha_actual = $visitasModel->getFechaActual();
        
        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listavisitas'    => $listaVisitas,
            'fecha_actual'    => $fecha_actual->Fecha,
        ];
        
        
		return view('paginas/admin/visitas', $data);
    }

    
}
