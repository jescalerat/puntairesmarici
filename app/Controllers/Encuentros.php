<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Encuentros extends BaseController
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

    public function index($dia, $mes, $any, $mostrarVolver): string
    {
        $session = session();
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $encuentrosModel = model('EncuentrosModel');
        $idComunidad = null;
        $idProvincia = null;
        $idMunicipio = null;

        $idiomaIni = $session->get('language');
        $idiomaId = idiomaPaginaId($idiomaIni); 

        $tipofiesta=cambiarAcentos(lang('Traductor.encuentrosdia'));
        $lugar = fecha($dia, $mes, $any, $idiomaId);
        $titulo = $tipofiesta.$lugar;
        $buscador = false;

        $listaencuentros = $encuentrosModel->getListaEncuentrosParams($dia, $mes, $any, $idComunidad, $idProvincia, $idMunicipio, $buscador);
        $total = $encuentrosModel->countListaEncuentrosParams($dia, $mes, $any, $idComunidad, $idProvincia, $idMunicipio, $buscador);

        $data = [
            'contador'   => $contador,
            'titulo'   => $titulo,
            'total'   => $total,
            'buscador'   => $buscador,
            'idiomaId'   => $idiomaId,
            'listaencuentros'   => $listaencuentros,
            'mostrarVolver'   => $mostrarVolver,
            'dia'   => $dia,
            'mes'   => $mes,
            'any'   => $any,
        ];
        
		return view('paginas/encuentros', $data);
    }

}
