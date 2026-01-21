<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;

class Contactos extends BaseController
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
        $idEncuentro = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'municipio'    => $municipio,
            'idMunicipio'    => $idMunicipio,
            'idEncuentro'    => $idEncuentro,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contactos', $data);
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
        
        $contactosModel = model('ContactosModel');
        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        
        $error = null;
        
        $idContacto = $this->request->getPost('idContacto');
        $idEncuentro = $this->request->getPost('idEncuentro');
        $contacto = $this->request->getPost('contacto');

        $encuentrosModel = model('EncuentrosModel');
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);

        $idMunicipio = $encuentroM->IdMunicipio;

        if ($idContacto == ""){
        
            $maxContacto = $contactosModel->getMaxContactos();
            $idContacto = $maxContacto->IdContacto + 1;

            $dataInsert = array(
                'IdContacto' => $idContacto,
                'Contacto' => $contacto
            );

            $contactosModel->insert($dataInsert);
            echo $contactosModel->getLastQuery();
            echo '<br>';

            $dataInsertCM = array(
                'IdContacto' => $idContacto,
                'IdMunicipio' => $idMunicipio
            );
            $contactosMunicipiosModel->insert($dataInsertCM);
            echo $contactosMunicipiosModel->getLastQuery();
            echo '<br>';

            $contactosEncuentrosModel = model('ContactosEncuentrosModel');
            $dataInsertCE = array(
                'IdContacto' => $idContacto,
                'IdEncuentro' => $idEncuentro
            );
            $contactosEncuentrosModel->insert($dataInsertCE);
            
        } else {
            $dataUpdate = array(
                'Contacto' => $contacto
            );
            $contactosModel->update($idContacto, $dataUpdate);
        }
        echo $contactosModel->getLastQuery();

        $contactosEncuentrosModel = model('ContactosEncuentrosModel');
        $listaContactos = $contactosEncuentrosModel->getContactosEncuentrosParams($idEncuentro);
        
        $listaContactosMunicipio = $contactosMunicipiosModel->getContactosMunicipiosParams($encuentroM->IdMunicipio);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $idContacto = null;
        $contacto = null;
        $error = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'listaContactos'    => $listaContactos,
            'listaContactosMunicipio'    => $listaContactosMunicipio,
            'contacto'    => $contacto,
            'idContacto'    => $idContacto,
            'idEncuentro'    => $idEncuentro,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contacto', $data);
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

        $pagina = "contactos";
        $data = [
            'listaEncuentros'   => $listaEncuentros,
            'idProvincia'   => $idProvincia,
            'pagina'    => $pagina
        ];
        
		return view('paginas/admin/encuentros_recarga', $data);
    }

    public function eliminar($idEncuentro, $idContacto)
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

        $contactosEncuentrosModel = model('ContactosEncuentrosModel');
        $contactosEncuentrosModel->deleteCE($idContacto, $idEncuentro);
        echo $contactosEncuentrosModel->getLastQuery();

        $encuentrosModel = model('EncuentrosModel');
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);
        
        $listaContactos = $contactosEncuentrosModel->getContactosEncuentrosParams($idEncuentro);

        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        $listaContactosMunicipio = $contactosMunicipiosModel->getContactosMunicipiosParams($encuentroM->IdMunicipio);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $idContacto = null;
        $contacto = null;
        $error = null;
        $idMunicipio = $encuentroM->IdMunicipio;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'listaContactos'    => $listaContactos,
            'listaContactosMunicipio'    => $listaContactosMunicipio,
            'contacto'    => $contacto,
            'idContacto'    => $idContacto,
            'idEncuentro'    => $idEncuentro,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contacto', $data);
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

        $contactosEncuentrosModel = model('ContactosEncuentrosModel');
        $listaContactos = $contactosEncuentrosModel->getContactosEncuentrosParams($idEncuentro);

        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        $listaContactosMunicipio = $contactosMunicipiosModel->getContactosMunicipiosParams($encuentroM->IdMunicipio);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $idContacto = null;
        $contacto = null;
        $error = null;
        $idMunicipio = $encuentroM->IdMunicipio;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'listaContactos'    => $listaContactos,
            'listaContactosMunicipio'    => $listaContactosMunicipio,
            'contacto'    => $contacto,
            'idContacto'    => $idContacto,
            'idEncuentro'    => $idEncuentro,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contacto', $data);
    }

    public function eliminarContacto($idContacto, $idEncuentro, $idMunicipio)
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

        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        $contactosMunicipiosModel->deleteCM($idContacto, $idMunicipio);
        echo "<br>".$contactosMunicipiosModel->getLastQuery();

        $contactosEncuentrosModel = model('ContactosEncuentrosModel');
        $contactosEncuentrosModel->deleteCE($idContacto, $idEncuentro);
        echo "<br>".$contactosEncuentrosModel->getLastQuery();

        $contactosModel = model('ContactosModel');
        $contactosModel->delete($idContacto);
        echo "<br>".$contactosModel->getLastQuery();

        $encuentrosModel = model('EncuentrosModel');
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);
        
        $listaContactos = $contactosEncuentrosModel->getContactosEncuentrosParams($idEncuentro);

        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        $listaContactosMunicipio = $contactosMunicipiosModel->getContactosMunicipiosParams($encuentroM->IdMunicipio);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $idContacto = null;
        $contacto = null;
        $error = null;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'listaContactos'    => $listaContactos,
            'listaContactosMunicipio'    => $listaContactosMunicipio,
            'contacto'    => $contacto,
            'idContacto'    => $idContacto,
            'idEncuentro'    => $idEncuentro,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contacto', $data);
    }

    public function insertarEncuentro($idContacto, $idEncuentro)
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

        $contactosEncuentrosModel = model('ContactosEncuentrosModel');
        $dataInsertCE = array(
            'IdContacto' => $idContacto,
            'IdEncuentro' => $idEncuentro
        );
        $contactosEncuentrosModel->insert($dataInsertCE);
        echo "<br>".$contactosEncuentrosModel->getLastQuery();

        $encuentrosModel = model('EncuentrosModel');
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);
        
        $listaContactos = $contactosEncuentrosModel->getContactosEncuentrosParams($idEncuentro);

        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        $listaContactosMunicipio = $contactosMunicipiosModel->getContactosMunicipiosParams($encuentroM->IdMunicipio);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $idContacto = null;
        $contacto = null;
        $error = null;
        $idMunicipio = $encuentroM->IdMunicipio;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'listaContactos'    => $listaContactos,
            'listaContactosMunicipio'    => $listaContactosMunicipio,
            'contacto'    => $contacto,
            'idContacto'    => $idContacto,
            'idEncuentro'    => $idEncuentro,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contacto', $data);
    }

    public function modificarContacto($idContacto,$idEncuentro)
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

        $contactosModel = model('ContactosModel');
        $contactoM = $contactosModel->find($idContacto);
        $contacto = $contactoM->Contacto;

        $encuentrosModel = model('EncuentrosModel');
        $encuentroM = $encuentrosModel->getEncuentro($idEncuentro);
        
        $contactosEncuentrosModel = model('ContactosEncuentrosModel');
        $listaContactos = $contactosEncuentrosModel->getContactosEncuentrosParams($idEncuentro);

        $contactosMunicipiosModel = model('ContactosMunicipiosModel');
        $listaContactosMunicipio = $contactosMunicipiosModel->getContactosMunicipiosParams($encuentroM->IdMunicipio);

        $titulo = $encuentroM->Municipio." (".$encuentroM->Provincia.")";
        if ($encuentroM->Descripcion != null){
            $titulo .= " --- ".$encuentroM->Descripcion;
        }
        $titulo .= " --- ".fecha($encuentroM->Dia, $encuentroM->Mes, $encuentroM->Anyo, 1);

        $error = null;
        $idMunicipio = $encuentroM->IdMunicipio;

        $data = [ 
            'contador'    => $contador,
            'nombre'    => $nombre,
            'titulo'    => $titulo,
            'listaContactos'    => $listaContactos,
            'listaContactosMunicipio'    => $listaContactosMunicipio,
            'contacto'    => $contacto,
            'idContacto'    => $idContacto,
            'idEncuentro'    => $idEncuentro,
            'idMunicipio'    => $idMunicipio,
            'error'    => $error,
        ];
        
        
		return view('paginas/admin/contacto', $data);
    }
    
}
