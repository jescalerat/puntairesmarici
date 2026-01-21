<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

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
        $idMunicipio = null;
        $descripcion = null;
        $dia = null;
        $mes = null;
        $any = null;
        $idEncuentro = null;
        $idEncuentroNuevo = null;
        $municipio = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'idMunicipio'    => $idMunicipio,
            'descripcion'    => $descripcion,
            'dia'    => $dia,
            'mes'    => $mes,
            'any'    => $any,
            'idEncuentro'    => $idEncuentro,
            'idEncuentroNuevo'    => $idEncuentroNuevo,
            'municipioMod'    => $municipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/encuentros', $data);
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
        
        $encuentrosModel = model('EncuentrosModel');

        $error = null;
        $idEncuentroNuevo = null;

        
        $comunidad = $this->request->getPost('comunidadSelect');
        $provincia = $this->request->getPost('provinciaSelect');
        $idMunicipio = $this->request->getPost('municipioSelect');
        $idEncuentro = $this->request->getPost('idEncuentro');
        $descripcion = $this->request->getPost('descripcion');
        $dia = $this->request->getPost('dia');
        $mes = $this->request->getPost('mes');
        $any = $this->request->getPost('any');
        $duplicar = $this->request->getPost('duplicar');

        if ($duplicar != null){
            $encuentroDuplicado = $encuentrosModel->getEncuentro($idEncuentro);
            $idMunicipio = $encuentroDuplicado->IdMunicipio;
            $idEncuentro = "";
        }

        if ($idEncuentro == ""){
        
            $maxEncuentro = $encuentrosModel->getMaxEncuentro();
            $idEncuentro = $maxEncuentro->IdEncuentro + 1;
            $idEncuentroNuevo = $idEncuentro;

            $dataInsert = array(
                'IdEncuentro' => $idEncuentro,
                'IdMunicipio' => $idMunicipio,
                'Descripcion'  => $descripcion,
                'Dia'  => $dia,
                'Mes'  => $mes,
                'Anyo'  => $any
            );
            $encuentrosModel->insert($dataInsert);
        } else {
            $dataUpdate = array(
                'Descripcion'  => $descripcion,
                'Dia'  => $dia,
                'Mes'  => $mes,
                'Anyo'  => $any
            );
            $encuentrosModel->update($idEncuentro, $dataUpdate);
        }
        echo $encuentrosModel->getLastQuery();
        
        $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";
        $idMunicipio = null;
        $descripcion = null;
        $dia = null;
        $mes = null;
        $any = null;
        $idEncuentro = null;
        $municipio = null;
        
        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'idMunicipio'    => $idMunicipio,
            'descripcion'    => $descripcion,
            'dia'    => $dia,
            'mes'    => $mes,
            'any'    => $any,
            'idEncuentro'    => $idEncuentro,
            'idEncuentroNuevo'    => $idEncuentroNuevo,
            'municipioMod'    => $municipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/encuentros', $data);
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

        $encuentrosModelList = model('EncuentrosModel');
        $listaEncuentros = $encuentrosModelList->getListaEncuentrosParams(null, null, null, $idComunidad, $idProvincia, $idMunicipio, true);

        $pagina = "encuentros";
        $data = [
            'listaEncuentros'   => $listaEncuentros,
            'idProvincia'   => $idProvincia,
            'pagina'    => $pagina
        ];
        
		return view('paginas/admin/encuentros_recarga', $data);
    }

    public function eliminar($idEncuentro)
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

        $encuentrosModel = model('EncuentrosModel');
        $encuentrosModel->delete($idEncuentro);
        echo $encuentrosModel->getLastQuery();

        $idMunicipio = null;
        $descripcion = null;
        $dia = null;
        $mes = null;
        $any = null;
        $idEncuentro = null;
        $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'idMunicipio'    => $idMunicipio,
            'descripcion'    => $descripcion,
            'dia'    => $dia,
            'mes'    => $mes,
            'any'    => $any,
            'idEncuentro'    => $idEncuentro,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/encuentros', $data);
    }

    public function modificar($idEncuentro)
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

        $encuentrosModel = model('EncuentrosModel');
        $encuentroM = $encuentrosModel->find($idEncuentro);

        $idMunicipio = $encuentroM->IdMunicipio;
        $descripcion = $encuentroM->Descripcion;
        $dia = $encuentroM->Dia;
        $mes = $encuentroM->Mes;
        $any = $encuentroM->Anyo;
        $error = null;
        $idEncuentroNuevo = null;

        $municipiosModel = model('MunicipiosModel');
        $municipio = $municipiosModel->find($idMunicipio);

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'idMunicipio'    => $idMunicipio,
            'descripcion'    => $descripcion,
            'dia'    => $dia,
            'mes'    => $mes,
            'any'    => $any,
            'idEncuentro'    => $idEncuentro,
            'idEncuentroNuevo'    => $idEncuentroNuevo,
            'municipioMod'    => $municipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/encuentros', $data);
    }
    
}
