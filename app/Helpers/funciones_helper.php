<?php
function idiomaPagina()
{
    //Comprobar idioma del navegador cliente
    if ($_SERVER['HTTP_ACCEPT_LANGUAGE'] != ''){
        // Miramos que idiomas ha definido:
        $idiomas = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']); # Convertimos HTTP_ACCEPT_LANGUAGE en array
        /* Recorremos el array hasta que encontramos un idioma del visitante que coincida con los idiomas en que está disponible nuestra web */
        if (substr($idiomas[0], 0, 2) == "es"){$idioma = 1;}
        else if (substr($idiomas[0], 0, 2) == "en"){$idioma = 2;}
        else if (substr($idiomas[0], 0, 2) == "ca"){$idioma = 3;}
        //else if (substr($idiomas[0], 0, 2) == "eu"){$idioma = 3;}
        //else if (substr($idiomas[0], 0, 2) == "gl"){$idioma = 4;}
        else {$idioma=1;}
    }
    
    return $idioma;    
}

function idiomaPaginaId($idioma)
{
    if ($idioma == "es"){$idiomaId = 1;}
    else if ($idioma == "en"){$idiomaId = 2;}
    else if ($idioma == "ca"){$idiomaId = 3;}
    else {$idiomaId=1;}

    return $idiomaId;
}

//Devuelve la direccion IP real del cliente 
function getRealIP()
{
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
   return $client_ip;
}

function getRealIP2()
{
   
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
      // los proxys van a�adiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una direcci�n ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
   
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');
   
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
   
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }
   
   return $client_ip;
}

function generaComunidades($admin)
{
	$link=Conectarse();
	$query = "select IdComunidad, Comunidad from comunidades order by Comunidad asc";
	$consulta=mysqli_query($link, $query);
	
	// Voy imprimiendo el primer select compuesto por las comunidades
	echo "<select name='op_comunidades' id='op_comunidades' onChange='gestionCargaDatos(this.id,".$admin.")'>";
	echo "<option value='0'>".cambiarAcentos(_COMUNIDADES)."</option>";
	while($registro=mysqli_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".cambiarAcentos($registro[1])."</option>";
	}
	echo "</select>";
}

function generaTipoFotos($x)
{
	$link=Conectarse();
	$query = "select IdTipoFotoN1, TipoFotoN1 from tiposfotosn1 order by TipoFotoN1";
	$consulta=mysql_query($link, $query);

	// Voy imprimiendo el primer select compuesto por las comunidades
	echo "<select name=\"op_tipofoton1".$x."\" id=\"op_tipofoton1".$x."\" onChange='cargaDatosFotos(this.id,".$x.")'>";
	echo "<option value='0'>TipoFotoN1</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".cambiarAcentos($registro[1])."</option>";
	}
	echo "</select>";
}

function diaSemana($diaDeSemana)
{
	switch ($diaDeSemana) {
		case 1:
			$diaS=_LUNES; 
			break;
		case 2:
			$diaS=_MARTES;
			break;
		case 3:
			$diaS=_MIERCOLES;
			break;
		case 4:
			$diaS=_JUEVES;
			break;
		case 5:
			$diaS=_VIERNES;
			break;
		case 6:
			$diaS=_SABADO;
			break;
		case 7:
			$diaS=_DOMINGO;
			break;
	}
	return $diaS;
}

function mesAny($mes)
{
	if($mes==1||strcmp($mes,"Enero")==0)
	{
		$mesany=lang('Traductor.enero');
	}
	else if($mes==2||strcmp($mes,"Febrero")==0)
	{
		$mesany=lang('Traductor.febrero');
	}
	else if($mes==3||strcmp($mes,"Marzo")==0)
	{
		$mesany=lang('Traductor.marzo');
	}
	else if($mes==4||strcmp($mes,"Abril")==0)
	{
		$mesany=lang('Traductor.abril');
	}
	else if($mes==5||strcmp($mes,"Mayo")==0)
	{
		$mesany=lang('Traductor.mayo');
	}
	else if($mes==6||strcmp($mes,"Junio")==0)
	{
		$mesany=lang('Traductor.junio');
	}
	else if($mes==7||strcmp($mes,"Julio")==0)
	{
		$mesany=lang('Traductor.julio');
	}
	else if($mes==8||strcmp($mes,"Agosto")==0)
	{
		$mesany=lang('Traductor.agosto');
	}
	else if($mes==9||strcmp($mes,"Septiembre")==0)
	{
		$mesany=lang('Traductor.septiembre');
	}
	else if($mes==10||strcmp($mes,"Octubre")==0)
	{
		$mesany=lang('Traductor.octubre');
	}
	else if($mes==11||strcmp($mes,"Noviembre")==0)
	{
		$mesany=lang('Traductor.noviembre');
	}
	else if($mes==12||strcmp($mes,"Diciembre")==0)
	{
		$mesany=lang('Traductor.diciembre');
	}
	return $mesany;
}

function superindice($jornada)
{
	if ($_SESSION['idiomapagina']==1)
	{
		$devuelveSuperindice="&ordf;";
	}
	else if ($_SESSION['idiomapagina']==2)
	{
		if ($jornada==1)
		{
			$devuelveSuperindice="st";
		}
		else if ($jornada==2)
		{
			$devuelveSuperindice="nd";
		}
		else
		{
			$devuelveSuperindice="th";
		}
	}
	else
	{
		if ($jornada==1)
		{
			$devuelveSuperindice="st";
		}
		else if ($jornada==2)
		{
			$devuelveSuperindice="nd";
		}
		else
		{
			$devuelveSuperindice="th";
		}
	}
	return $devuelveSuperindice;
}

function fecha($dia,$mes,$any,$idioma)
{
    if ($idioma==1)
	{
		$fechadevuelta=$dia." de ".mesAny($mes)." del ".$any;
	}
	else if ($idioma==2)
	{
		$fechadevuelta=mesAny($mes)." ".$dia." of ".$any;
	}
	else if ($idioma==3)
	{
		$particula=" de ";
		if ($mes==4||$mes==8){$particula=" d'";}
		$fechadevuelta=$dia.$particula.mesAny($mes)." del ".$any;
	}
	else
	{
		$fechadevuelta=mesAny($mes)." ".$dia." of ".$any;
	}
	return $fechadevuelta;
}

function diaFinal($mes)
{
	$diaF=31;
	if ($mes==2)
	{
		$diaF=28;
	}
	else if ($mes==4||$mes==6||$mes==9||$mes==11)
	{
		$diaF=30;
	}
	return $diaF;
}

function devolverDia($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$dia=$fechacompleta[0];
	return $dia;
}

function devolverMes($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$mes=$fechacompleta[1];
	return $mes;
}

function devolverAny($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$any=$fechacompleta[2];
	return $any;
}

function devolverFecha($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$dia=$fechacompleta[0];
	$fechacompleta=explode("-",$fecha);
	$mes=mesAny($fechacompleta[1]);
	$fechacompleta=explode("-",$fecha);
	$any=$fechacompleta[2];
	$fechaTraducida=$dia."-".$mes."-".$any;
	return $fechaTraducida;
}

function cambiarAcentos($cadena) {
	$long=strlen($cadena);
	$devuelveCadena="";

	for ($x=0;$x<$long;$x++)
	{
//Acento agudo
		if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&aacute;";
		}
		else if(strcmp($cadena[$x],"��")==0)
		{
			$devuelveCadena=$devuelveCadena."&Aacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&eacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Eacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&iacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Iacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&oacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Oacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&uacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Uacute;";
		}
//Dieresis
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&auml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Auml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&euml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Euml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&iuml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Iuml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&ouml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ouml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&uuml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Uuml;";
		}
//Acento grave
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&agrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Agrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&egrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Egrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&igrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Igrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&ograve;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ograve;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&ugrave;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ugrave;";
		}
		//Acento circunflejo
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&acirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Acirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ecirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Ecirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&icirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Icirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ocirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Ocirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ucirc;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Ucirc;";
		}
		//Letras especiales
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&atilde;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Atilde;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&aelig;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&AElig;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ccedil;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Ccedil;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ntilde;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Ntilde;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&otilde;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Otilde;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&oslash;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Oslash;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&szlig;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&yuml;";
		}
		else if(strcmp($cadena[$x],"�Y")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Yuml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&yacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Yacute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&thorn;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&THORN;";
		}
		//Otros signos
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&cent;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&pound;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&curren;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&copy;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&reg;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ordm;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ordf;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&micro;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&aring;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&Aring;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&deg;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&middot;";
		}
		
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&uml;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&acute;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&cedil;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&ETH;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&eth;";
		}
		//Signos especiales
		else if(strcmp($cadena[$x],"...")==0)
		{
		    $devuelveCadena=$devuelveCadena."&hellip;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&iexcl;";
		}
		else if(strcmp($cadena[$x],"�")==0)
		{
		    $devuelveCadena=$devuelveCadena."&iquest;";
		}
		else
		{
		    $devuelveCadena=$devuelveCadena.$cadena[$x];
		}
	}
	return $devuelveCadena;
}

function tratarDiaEncuentro($dia,$mes,$anyo)
{
	$fecha=fecha($dia,$mes,$anyo);
	
	return $fecha;
}
function tratarConjuncionY()
{
	if ($_SESSION['idiomapagina']==1)
	{
		$conjuncion="y";
	}
	else if ($_SESSION['idiomapagina']==2)
	{
		$conjuncion="and";
	}
	else if ($_SESSION['idiomapagina']==3)
	{
		$conjuncion="i";
	}
	else
	{
		$conjuncion="y";
	}
	return $conjuncion;
}

function gestionarFotos($foto)
{
	$fotoVuelta="";
	$gestionfoto=explode(" ",$foto);
	$tmp = $gestionfoto[1]*1;
	if ($tmp>0&&$tmp<=31)
	{
		$fotoVuelta=constant($gestionfoto[0]).$tmp;
	}
	else
	{
		$fotoVuelta=constant($foto);
	}
	return $fotoVuelta;
}

function devolverFechaBBDD($fecha)
{
    $fechacompleta=explode("-",$fecha);
    $dia=$fechacompleta[2];
    $fechacompleta=explode("-",$fecha);
    $mes=mesAny($fechacompleta[1]);
    $fechacompleta=explode("-",$fecha);
    $any=$fechacompleta[0];
    $fechaTraducida=$dia."-".$mes."-".$any;
    return $fechaTraducida;
}

function visitasDia($fechaactual){
	$visitasModel = model('VisitasModel');
	$totalVisitasDia = $visitasModel->getVisitasDia($fechaactual);
	return $totalVisitasDia;
}

function visitasDiaDistintas($fechaactual){
	$visitasModel = model('VisitasModel');
	$totalVisitasDia = $visitasModel->getVisitasDiaDistintas($fechaactual);
	return $totalVisitasDia;
}

function tituloPagina($idPagina){
	$pagina_vista="";
	if ($idPagina==1)
	{
		$pagina_vista="Inicio";
	}
	else if ($idPagina==2)
	{
		$pagina_vista="Calendario";
	}
	else if ($idPagina==3)
	{
		$pagina_vista="Buscador";
	}
	else if ($idPagina==4)
	{
		$pagina_vista="Encuentro";
	}
	else if ($idPagina==5)
	{
		$pagina_vista="Paginas amigas";
	}
	else if ($idPagina==6)
	{
		$pagina_vista="Contactar";
	}
	else if ($idPagina==62)
	{
		$pagina_vista="Contactar enviado";
	}
	return $pagina_vista;
}

function estilo($idPagina){
	$estilo = "";
	if ($idPagina==6)
	{
		$estilo = "bgcolor=\"red\"";
	}
	else if ($idPagina==62)
	{
		$estilo = "bgcolor=\"red\"";
	}
	return $estilo;
}

function observaciones($idPagina, $idObservacion){
	$observaciones = "";
	if ($idPagina==4)
	{
		$encuentrosModel = model('EncuentrosModel');
		$encuentro = $encuentrosModel->getEncuentro($idObservacion);
		if ($encuentro != null){
			$observaciones = $encuentro->Municipio;
		} else {
			$observaciones = $idObservacion;
		}
		
	} else {
		$observaciones = $idObservacion;
	}
	

	return $observaciones;
}
?>