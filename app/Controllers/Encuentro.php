<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Encuentro extends BaseController
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

    public function index($idEncuentro, $mostrarVolver): string
    {
        $session = session();
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $encuentrosModel = model('EncuentrosModel');
        $encuentro = $encuentrosModel->find($idEncuentro);
        $titulo = $encuentro['Descripcion'];
        $dia = $encuentro['Dia'];
        $mes = $encuentro['Mes'];
        $any = $encuentro['Anyo'];

        $municipiosModel = model('MunicipiosModel');
        $municipio = $municipiosModel->find($encuentro['IdMunicipio']);

        $provinciasModel = model('ProvinciasModel');
        $provincia = $provinciasModel->find($municipio->IdProvincia);

        $cartelesModel = model('CartelesModel');
        $listacarteles = $cartelesModel->getCartelesParams($idEncuentro);

        $total_carteles = $cartelesModel->countListaCartelesParams($idEncuentro);

        $contactosModel = model('ContactosModel');
        $listacontactos = $contactosModel->getContactosParams($idEncuentro);

        $total_contactos = $contactosModel->countContactosParams($idEncuentro);

        
        $data = [
            'contador'   => $contador,
            'titulo'   => $titulo,
            'municipio'   => $municipio,
            'provincia'   => $provincia,
            'listacarteles'   => $listacarteles,
            'total_carteles'   => $total_carteles,
            'listacontactos'   => $listacontactos,
            'total_contactos'   => $total_contactos,
            'provincia'   => $provincia,
            'mostrarVolver'   => $mostrarVolver,
            'dia'   => $dia,
            'mes'   => $mes,
            'any'   => $any,
        ];
        
		return view('paginas/encuentro', $data);
    }

}
