<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Combos extends BaseController
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

    public function comunidades(): string
    {

        $comunidadesModel = model('ComunidadesModel');
        $comunidades = $comunidadesModel->findAll();

        $seleccionar = lang('Traductor.bucadorseleccionar');
        $comunidadesCombo = '<option value="0">'.$seleccionar.'</option>';
        foreach ($comunidades as $row)
        {
            $comunidadesCombo .= '<option value="'.$row->IdComunidad.'">'.$row->Comunidad.'</option>';
        }

        return $comunidadesCombo;
    }

    public function provincias(): string
    {
        $idComunidad = $this->request->getPost('comunidadelegida');
       
        $provinciasModel = model('ProvinciasModel');
        if ($idComunidad != null){
            $provincias = $provinciasModel->getProvinciasParams($idComunidad);
        } else {
            $provincias = $provinciasModel->findAll();
        }

        $seleccionar = lang('Traductor.bucadorseleccionar');
        $provinciasCombo = '<option value="0">'.$seleccionar.'</option>';
        foreach ($provincias as $row)
        {
            $provinciasCombo .= '<option value="'.$row->IdProvincia.'">'.$row->Provincia.'</option>';
        }

        return $provinciasCombo;
    }

    public function municipios(): string
    {
        $idProvincia = $this->request->getPost('provinciaelegida');
       
        $municipiosModel = model('MunicipiosModel');
        if ($idProvincia != null){
            $municipios = $municipiosModel->getMunicipiosParams($idProvincia);
        } else {
            $municipios = $municipiosModel->findAll();
        }

        $seleccionar = lang('Traductor.bucadorseleccionar');
        $municipiosCombo = '<option value="0">'.$seleccionar.'</option>';
        foreach ($municipios as $row)
        {
            $municipiosCombo .= '<option value="'.$row->IdMunicipio.'">'.$row->Municipio.'</option>';
        }

        return $municipiosCombo;
    }

}
