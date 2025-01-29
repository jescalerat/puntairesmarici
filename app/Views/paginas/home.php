<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<?php
    $mostrarVolver = 1;

    $tipo_semana = 1;
	$tipo_mes = 0;
	
	$MESCOMPLETO[1] = lang('Traductor.enero');
	$MESCOMPLETO[2] = lang('Traductor.febrero');
	$MESCOMPLETO[3] = lang('Traductor.marzo');
	$MESCOMPLETO[4] = lang('Traductor.abril');
	$MESCOMPLETO[5] = lang('Traductor.mayo');
	$MESCOMPLETO[6] = lang('Traductor.junio');
	$MESCOMPLETO[7] = lang('Traductor.julio');
	$MESCOMPLETO[8] = lang('Traductor.agosto');
	$MESCOMPLETO[9] = lang('Traductor.septiembre');
	$MESCOMPLETO[10] = lang('Traductor.octubre');
	$MESCOMPLETO[11] = lang('Traductor.noviembre');
	$MESCOMPLETO[12] = lang('Traductor.diciembre');
		
	$MESABREVIADO[1] = lang('Traductor.eneroabr');
	$MESABREVIADO[2] = lang('Traductor.febreroabr');
	$MESABREVIADO[3] = lang('Traductor.marzoabr');
	$MESABREVIADO[4] = lang('Traductor.abrilabr');
	$MESABREVIADO[5] = lang('Traductor.mayoabr');
	$MESABREVIADO[6] = lang('Traductor.junioabr');
	$MESABREVIADO[7] = lang('Traductor.julioabr');
	$MESABREVIADO[8] = lang('Traductor.agostoabr');
	$MESABREVIADO[9] = lang('Traductor.septiembreabr');
	$MESABREVIADO[10] = lang('Traductor.octubreabr');
	$MESABREVIADO[11] = lang('Traductor.noviembreabr');
	$MESABREVIADO[12] = lang('Traductor.diciembreabr');
		
	$SEMANACOMPLETA[0] = lang('Traductor.lunes');
	$SEMANACOMPLETA[1] = lang('Traductor.martes');
	$SEMANACOMPLETA[2] = lang('Traductor.miercoles');
	$SEMANACOMPLETA[3] = lang('Traductor.jueves');
	$SEMANACOMPLETA[4] = lang('Traductor.viernes');
	$SEMANACOMPLETA[5] = lang('Traductor.sabado');
	$SEMANACOMPLETA[6] = lang('Traductor.domingo');
	
	$SEMANAABREVIADA[0] = lang('Traductor.lunesabr');
	$SEMANAABREVIADA[1] = lang('Traductor.martesabr');
	$SEMANAABREVIADA[2] = lang('Traductor.miercolesabr');
	$SEMANAABREVIADA[3] = lang('Traductor.juevesabr');
	$SEMANAABREVIADA[4] = lang('Traductor.viernesabr');
	$SEMANAABREVIADA[5] = lang('Traductor.sabadoabr');
	$SEMANAABREVIADA[6] = lang('Traductor.domingoabr');
		
	////////////////////////////////////
	if($tipo_semana == 0){
		$ARRDIASSEMANA = $SEMANACOMPLETA;
	}elseif($tipo_semana == 1){
		$ARRDIASSEMANA = $SEMANAABREVIADA;
	}
	if($tipo_mes == 0){
		$ARRMES = $MESCOMPLETO;
	}elseif($tipo_mes == 1){
		$ARRMES = $MESABREVIADO;
	}

	if(!$dia) $dia = date('d');
	if(!$mes) $mes = date('n');
	if(!$ano) $ano = date('Y');
		
	$TotalDiasMes = date('t',mktime(0,0,0,$mes,$dia,$ano));
	$DiaSemanaEmpiezaMes = date('w',mktime(0,0,0,$mes,1,$ano));
	$DiaSemanaTerminaMes = date('w',mktime(0,0,0,$mes,$TotalDiasMes,$ano));
	if ($DiaSemanaEmpiezaMes == 0) $DiaSemanaEmpiezaMes = 7;
	$EmpiezaMesCalOffset = $DiaSemanaEmpiezaMes;
	$TerminaMesCalOffset = 6 - $DiaSemanaTerminaMes;
	$TotalDeCeldas = $TotalDiasMes + $DiaSemanaEmpiezaMes + $TerminaMesCalOffset;
		
		
	if($mes == 1){
		$MesAnterior = 12;
		$MesSiguiente = $mes + 1;
		$AnoAnterior = $ano - 1;
        $AnoSiguiente = $ano;
        $AnoAnteriorAno = $ano - 1;
		$AnoSiguienteAno = $ano + 1;
	}elseif($mes == 12){
		$MesAnterior = $mes - 1;
		$MesSiguiente = 1;
		$AnoAnterior = $ano;
        $AnoSiguiente = $ano + 1;
        $AnoAnteriorAno = $ano - 1;
		$AnoSiguienteAno = $ano + 1;
	}else{
		$MesAnterior = $mes - 1;
		$MesSiguiente = $mes + 1;
		$AnoAnterior = $ano;
		$AnoSiguiente = $ano;
		$AnoAnteriorAno = $ano - 1;
		$AnoSiguienteAno = $ano + 1;
	}

?>		
	<br/>
	<table class="table text-center">
		<tr>
			<td style="padding:0;" colspan="7">
				<table class="table text-center">
					<tr>
						<td width="15%"><a href="<?= base_url('index.php/calendario') ?>/<?= $mes ?>/<?= $AnoAnteriorAno ?>"><img src="<?= base_url('') ?>css/images/atras2.gif" border="0"></a></td>
						<td width="15%"><a href="<?= base_url('index.php/calendario') ?>/<?= $MesAnterior ?>/<?= $AnoAnterior ?>"><img src="<?= base_url('') ?>css/images/atras.gif" border="0"></a></td>
						<td class="text-center" nowrap><b><?= cambiarAcentos($ARRMES[$mes]) ?> - <?= $ano ?></b></td>
						<td width="15%"><a href="<?= base_url('index.php/calendario') ?>/<?= $MesSiguiente ?>/<?= $AnoSiguiente ?>"><img src="<?= base_url('') ?>css/images/avanzar.gif" border="0"></a></td>
						<td width="15%"><a href="<?= base_url('index.php/calendario') ?>/<?= $mes ?>/<?= $AnoSiguienteAno ?>"><img src="<?= base_url('') ?>css/images/avanzar2.gif" border="0"></a></td>
					</tr>
				</table>
			</td>		
		</tr>
		<tr>		
<?php 
		foreach($ARRDIASSEMANA AS $key){
?>
			<td style="padding:0;" bgcolor="#ccccff" class="text-center"><b><?= cambiarAcentos($key) ?></b></td>
<?php				
		}
?>		
		</tr>
<?php 		
        $contadordias=1;
		$b = 0;
		$c = 0;
		for($a=2;$a <= $TotalDeCeldas;$a++){ 
			if(!$b) $b = 0;
			if($b == 7) $b = 0;
			if($b == 0) print '<tr>';
			if(!$c) $c = 1;
			if($a > $EmpiezaMesCalOffset AND $c <= $TotalDiasMes){
				$hayFiesta = false;
				if($fechasfiestames[$c][0] == 1){
					if($c == date('d') && $mes == date('m') && $ano == date('Y')){
						$bgcolor = "#ffcc99";
					}elseif($b == 6){
						$bgcolor = "#99cccc";
					}else{
						$bgcolor = "#EEEEEE";
					}
?>					
					<td style="padding:0;" bgcolor="<?= $bgcolor ?>">
						<table class="table">
							<tr>
								<td style="padding:0;" align="center" bgcolor="<?= $bgcolor ?>"><?= $c ?></td>
							</tr>
							<tr>
								<td style="padding:0;" bgcolor="<?= $bgcolor ?>">
									<a href="<?= base_url('index.php/encuentros') ?>/<?= $c ?>/<?= $mes ?>/<?= $ano ?>/<?= $mostrarVolver ?>"><img src="<?= base_url('') ?>css/images/fiesta.gif" width="30px" height="30px" border="0"/></a>
								</td>
							</tr>
						</table>
					</td>
<?php 					
					$hayFiesta = true;
				}
				elseif($c == date('d') && $mes == date('m') && $ano == date('Y')){
					$bgcolor = "#ffcc99";
				}elseif($b == 6){
					$bgcolor = "#99cccc";
				}else{
					$bgcolor = "#EEEEEE";
				}
				
				if (!$hayFiesta){
?>				
				<td bgcolor="<?= $bgcolor ?>" class="text-center" valign="middle"><?= $c ?></td>
<?php 				
				}
				$c++;
			}else{
?>
				<td>&nbsp;</td>
<?php 				
			}
			if($b == 6) print '</tr>';
			$b++;
			$contadordias++;
		}
?>			
		<tr><td class="text-center" colspan="7"></td></tr>
	</table>
<?= $this->endSection() ?>