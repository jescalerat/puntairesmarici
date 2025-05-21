<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Carteles extends BaseController
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
        $descripcion = null;
        $idEncuentro = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'descripcion'    => $descripcion,
            'idEncuentro'    => $idEncuentro,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/carteles', $data);
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
        $cartelesModel = model('CartelesModel');

        $error = null;

        
        $idEncuentro = $this->request->getPost('idEncuentro');
        $cartel = $this->request->getPost('cartel');

        $maxCartel = $cartelesModel->getMaxCartel();
        $idCartel = $maxCartel->IdCartel + 1;

        $cartelesArray = explode(';', $cartel);

        foreach ($cartelesArray as $nuevaFoto){
            if ($nuevaFoto != ""){
                $dataInsert = array(
                    'IdCartel' => $idCartel,
                    'IdEncuentro' => $idEncuentro,
                    'Carteles'  => trim($nuevaFoto)
                );
                $cartelesModel->insert($dataInsert);
                echo "<br>".$cartelesModel->getLastQuery();
                $idCartel++;
            }
        }
        
        $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);

        $listaCarteles = $cartelesModel->getCartelesParams($idEncuentro);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'idEncuentro'    => $idEncuentro,
            'listaCarteles'    => $listaCarteles,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/cartel', $data);
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

        $pagina = "carteles";
        $data = [
            'listaEncuentros'   => $listaEncuentros,
            'idProvincia'   => $idProvincia,
            'pagina'    => $pagina
        ];
        
		return view('paginas/admin/encuentros_recarga', $data);
    }

    public function eliminar($idCartel, $idEncuentro)
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
        $cartelesModel = model('CartelesModel');
        $cartelesModel->deleteCartel($idCartel, $idEncuentro);
        echo $cartelesModel->getLastQuery();

        $error = "<p class=\"text-center text-info\">Cambio realizado correctamente</p>";
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);

        $listaCarteles = $cartelesModel->getCartelesParams($idEncuentro);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'idEncuentro'    => $idEncuentro,
            'listaCarteles'    => $listaCarteles,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/cartel', $data);
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
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);

        $cartelesModel = model('CartelesModel');
        $listaCarteles = $cartelesModel->getCartelesParams($idEncuentro);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $error = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'idEncuentro'    => $idEncuentro,
            'listaCarteles'    => $listaCarteles,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/cartel', $data);
    }
    
}
