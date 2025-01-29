<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Home extends BaseController
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
        $this->detalle();
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $cuenta = $contador['Contador'] + 1;

        $dataUpdate = [ 
            'Contador'    => $cuenta,
        ];
        
        $contadorModel->update(1, $dataUpdate);

        $contador = $contadorModel->find(1);

        $paginasVistasModel = model('PaginasVistasModel');

        
        $IP = getRealIP();
        $dataInsert = array(
            'IP' => $IP,
            'Hora'  => date("H:i:s"),
            'Fecha'  => date("Y-m-d"),
            'Pagina'  => 1,
            'Observaciones'  => ''
        );
        $paginasVistasModel->insert($dataInsert);

        $visitasModel = model('VisitasModel');

        $idiomaIni = $session->get('language');
 
        $idiomaId = idiomaPaginaId($idiomaIni);    
        $dataInsert = array(
            'IP' => $IP,
            'Hora'  => date("H:i:s"),
            'Fecha'  => date("Y-m-d"),
            'Idioma'  => $idiomaId
        );
        $visitasModel->insert($dataInsert);

        $mes=date("m");
        $ano=date("Y");
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
        $mes = "";
        $ano = "";

        $data = [
            'contador'   => $contador,
            'dia'   => $dia,
            'mes'   => $mes,
            'ano'   => $ano,
            'fechasfiestames'   => $fechasfiestames,
        ];
        
		return view('paginas/home', $data);
    }

    public function indexAdmin(): string
    {
        
        $this->detalle();

        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $data = [
            'contador'   => $contador,
            'dia'   => $dia,
            'mes'   => $mes,
            'ano'   => $ano,
        ];
        
		return view('paginas/home', $data);
    }

    private function detalle()
    {
        $session = session();

        $idiom = $session->get('cambioIdioma');

        if ($idiom == null) {
            $idiomas = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);            
            if (substr($idiomas[0], 0, 2) == "es"){$idiomaIni = 'es';}
            else if (substr($idiomas[0], 0, 2) == "en"){$idiomaIni = 'en';}
            else if (substr($idiomas[0], 0, 2) == "ca"){$idiomaIni = 'ca';}
            else {$idiomaIni = 'es';}
        } else {
            if ($idiom == "spanish"){$idiomaIni = 'es';}
            else if ($idiom == "english"){$idiomaIni = 'en';}
            else if ($idiom == "catalan"){$idiomaIni = 'ca';}
            else {$idiomaIni = 'es';}
        }

        $session->set('language',$idiomaIni);
        $idiom = $session->get('language');

        $lang = service('language');
        $lang->setLocale($idiom);   
    }
}
