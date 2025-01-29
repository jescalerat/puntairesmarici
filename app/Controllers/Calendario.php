<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Calendario extends BaseController
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

    public function index($mes, $ano): string
    {
        $session = session();
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $encuentrosModel = model('EncuentrosModel');
        $encuentros = $encuentrosModel->getEncuentrosParams($mes, $ano);
        
        //Inicializar array para saber los dias de fiesta
        for ($x=1;$x<=31;$x++)
        {
            $fechasfiestames[$x][0]=0;
            $idencuentromes[$x][0]=0;
        }

        foreach ($encuentros as $row){
            $encuentrosDia = $row->Dia;
            $fechasfiestames[$encuentrosDia][0]=1;
            $idencuentromes[$encuentrosDia][0].=$row->IdEncuentro.", ";
	    }

        $dia = "";
        $data = [
            'contador'   => $contador,
            'dia'   => $dia,
            'mes'   => $mes,
            'ano'   => $ano,
            'fechasfiestames'   => $fechasfiestames,
        ];
        
		return view('paginas/home', $data);
    }

}
