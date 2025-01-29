<form class="col">
	<div class="row">
		<div class="col" id="titulo">
			<h1 class="text-center"><?= $titulo ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col" id="total">
			<h5 class="text-center"><?= cambiarAcentos(lang('Traductor.encuentrostotal')) ?>: <?= $total ?></h5>
		</div>
	</div>
	<div class="row">
		<div class="col" id="encuentros">
			
<?php 
            foreach ($listaencuentros as $row){
                $desc = $row->Municipio." (".$row->Provincia.")";
                if ($row->Descripcion != null){
                    $desc .= " --- ".$row->Descripcion;
                }
                if ($buscador){
                    $desc .= " --- ".fecha($row->Dia, $row->Mes, $row->Anyo, $idiomaId);
                }
?>			
				<a href="<?= base_url('index.php/encuentro') ?>/<?= $row->IdEncuentro ?>/<?= $mostrarVolver ?>" class="list-group-item"><?= cambiarAcentos($desc) ?></a>
<?php 
            }
?>
		</div>
	</div>
</form>