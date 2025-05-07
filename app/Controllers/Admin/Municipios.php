<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Municipios extends BaseController
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

        $error = null;
        $municipio = null;
        $idMunicipio = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'municipio'    => $municipio,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/municipios', $data);
    }

    public function actualizar()
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
        
        $municipiosModel = model('MunicipiosModel');

        $error = null;

        
        $nuevomunicipio = $this->request->getPost('municipio');
        $comunidad = $this->request->getPost('comunidadSelect');
        $provincia = $this->request->getPost('provinciaSelect');
        $idMunicipio = $this->request->getPost('idMunicipio');

        if ($nuevomunicipio == "")
  		{
  			$error = "<p class=\"text-center text-danger\">Municipio no valido</p>";
  		}
  		else
  		{
            if ($idMunicipio == ""){
            
                $maxMunicipio = $municipiosModel->getMaxMunicipio();
                $idMunicipio = $maxMunicipio->IdMunicipio + 1;

                $dataInsert = array(
                    'IdMunicipio' => $idMunicipio,
                    'IdProvincia'  => $provincia,
                    'Municipio'  => $nuevomunicipio
                );
                $municipiosModel->insert($dataInsert);
            } else {
                $dataUpdate = array(
                    'Municipio'  => $nuevomunicipio
                );
                $municipiosModel->update($idMunicipio, $dataUpdate);
            }
            echo $municipiosModel->getLastQuery();
  			
            $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";
            $municipio = null;
            $idMunicipio = null;
        }
        
        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'municipio'    => $municipio,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/municipios', $data);
    }

    public function recarga(): string
    {
        $idComunidad = $this->request->getPost('comunidadelegida');
        if ($idComunidad != null){
            $comunidadesModel = model('ComunidadesModel');
            $comunidad = $comunidadesModel->find($idComunidad);
        }
        $idProvincia = $this->request->getPost('provinciaelegida');
        if ($idProvincia != null){
            $provinciasModel = model('ProvinciasModel');
            $provincia = $provinciasModel->find($idProvincia);
        }
        $idMunicipio = $this->request->getPost('municipioelegido');
        if ($idMunicipio != null){
            $municipiosModel = model('MunicipiosModel');
            $municipio = $municipiosModel->find($idMunicipio);
        }

        $municipiosModelList = model('MunicipiosModel');
        $listaMunicipios = $municipiosModelList->getMunicipiosAdminParams($idProvincia);

        $data = [
            'listaMunicipios'   => $listaMunicipios,
            'idComunidad'   => $idComunidad,
            'idProvincia'   => $idProvincia
        ];
        
		return view('paginas/admin/municipios_recarga', $data);
    }

    public function eliminar($idMunicipio)
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

        $municipiosModel = model('MunicipiosModel');
        $municipiosModel->delete($idMunicipio);
        echo $municipiosModel->getLastQuery();

        $municipio = null;
        $idMunicipio = null;
        $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'municipio'    => $municipio,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/municipios', $data);
    }

    public function modificar($idMunicipio)
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

        $municipiosModel = model('MunicipiosModel');
        $municipioM = $municipiosModel->find($idMunicipio);

        $municipio = $municipioM->Municipio;
        $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'municipio'    => $municipio,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/municipios', $data);
    }
    
}
