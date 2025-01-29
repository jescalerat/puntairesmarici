<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Buscador extends BaseController
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

    public function index(): string
    {
        $session = session();
        
        $contadorModel = model('ContadorModel');
        $contador = $contadorModel->find(1);

        $encuentrosModel = model('EncuentrosModel');
        $listaAnyos = $encuentrosModel->getAnyosEncuentros();

        $data = [
            'contador'   => $contador,
            'listaAnyos'   => $listaAnyos,
        ];
        
		return view('paginas/buscador', $data);
    }

    public function recarga(): string
    {
        $session = session();

        $idiomaIni = $session->get('language');
        $idiomaId = idiomaPaginaId($idiomaIni);
        
        $tipofiesta = ""; 
        $lugar = "";
    
        $dia = null;
        $mes = null;
        $anyo = $this->request->getPost('anyoelegido');
        if ($anyo == 0){
            $anyo = null;
        }
        if ($anyo != null){
            $tipofiesta=cambiarAcentos(lang('Traductor.encuentrosdia'));
            $lugar = $anyo;
        }
        $idComunidad = $this->request->getPost('comunidadelegida');
        if ($idComunidad != null){
            $tipofiesta=cambiarAcentos(lang('Traductor.encuentroscomunidad'));
            $comunidadesModel = model('ComunidadesModel');
            $comunidad = $comunidadesModel->find($idComunidad);
            $lugar=cambiarAcentos($comunidad->Comunidad);
        }
        $idProvincia = $this->request->getPost('provinciaelegida');
        if ($idProvincia != null){
            $tipofiesta=cambiarAcentos(lang('Traductor.encuentrosprovincia'));
            $provinciasModel = model('ProvinciasModel');
            $provincia = $provinciasModel->find($idProvincia);
            $lugar=cambiarAcentos($provincia->Provincia);
        }
        $idMunicipio = $this->request->getPost('municipioelegido');
        if ($idMunicipio != null){
            $tipofiesta=cambiarAcentos(lang('Traductor.encuentrosmunicipio'));
            $municipiosModel = model('MunicipiosModel');
            $municipio = $municipiosModel->find($idMunicipio);
            $lugar=cambiarAcentos($municipio->Municipio);
        }
        $buscador = true;   
        $mostrarVolver = 0;     

        $titulo = $tipofiesta.$lugar;
        $encuentrosModel = model('EncuentrosModel');
        $listaEncuentros = $encuentrosModel->getListaEncuentrosParams($dia, $mes, $anyo, $idComunidad, $idProvincia, $idMunicipio, $buscador);
        $total = $encuentrosModel->countListaEncuentrosParams($dia, $mes, $anyo, $idComunidad, $idProvincia, $idMunicipio, $buscador);

        $data = [
            'titulo'   => $titulo,
            'total'   => $total,
            'listaencuentros'   => $listaEncuentros,
            'buscador'   => $buscador,
            'idiomaId'   => $idiomaId,
            'mostrarVolver'   => $mostrarVolver
        ];
        
		return view('paginas/municipios_recarga', $data);
    }

}
