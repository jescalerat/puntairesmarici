<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Paginas extends BaseController
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

        $ip = null;
        $fecha = null;
        $paginasVistasModel = model('PaginasVistasModel');
        $listaPaginasVisitas = $paginasVistasModel->getPaginasVistasParams($ip, $fecha);
        
        $titulo = "";

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listapaginasvistas'    => $listaPaginasVisitas,
            'titulo'    => $titulo,
        ];
        
        
		return view('paginas/admin/paginas', $data);
    }

    public function buscar($fecha, $ip)
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

        if ($ip == 0){
            $ip = null;
            $titulo = "Fecha: ".devolverFechaBBDD($fecha);
        } else {
            $titulo = "Fecha: ".devolverFechaBBDD($fecha). " IP: ".$ip;
        }

        $paginasVistasModel = model('PaginasVistasModel');
        $listaPaginasVisitas = $paginasVistasModel->getPaginasVistasParams($ip, $fecha);
        
        

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listapaginasvistas'    => $listaPaginasVisitas,
            'titulo'    => $titulo,
        ];
        
        
		return view('paginas/admin/paginas', $data);
    }

    public function eliminar($idPaginaVista)
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

        $ip = null;
        $fecha = null;
        $paginasVistasModel = model('PaginasVistasModel');
        $paginasVistasModel->delete($idPaginaVista);
        $listaPaginasVisitas = $paginasVistasModel->getPaginasVistasParams($ip, $fecha);
        
        $titulo = "";

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'listapaginasvistas'    => $listaPaginasVisitas,
            'titulo'    => $titulo,
        ];
        
        
		return view('paginas/admin/paginas', $data);
    }

    
}
