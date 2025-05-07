<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
	<h1 class="text-center">Visitas en Puntaires Mari</h1>
	
	<table class="table table-bordered">
   		<thead class="thead-dark">
	   		<tr class="d-flex">
				<th class="col-3 text-center">Eliminar</th>
	       		<th class="col-3 text-center">IP</th>
	       		<th class="col-2 text-center">Hora</th>
	       		<th class="col-2 text-center">Fecha</th>
	       		<th class="col-2 text-center">Idioma</th>
	       	</tr>
		</thead>
<?php 
        foreach ($listavisitas as $row){		
			$fecha_futura=$row->Fecha;
            if (strcmp($fecha_actual,$fecha_futura)!=0)
            {
                $visitasDia = visitasDia($fecha_actual);
                $visitasDiaDistintas = visitasDiaDistintas($fecha_actual);
?>                
				<tr class="d-flex" bgcolor="green">
					<td class="col-4"><a href="<?= site_url('admin/paginas/buscar/') ?><?= $fecha_actual ?>/0"><?= $fecha_actual ?></a></td>
					<td class="col-3 text-right">Visitas dia:</td>
					<td class="col-1 text-center"><?= $visitasDia ?></td>
					<td class="col-3 text-right">Visitas dia distintas:</td>
					<td class="col-1 text-center"><?= $visitasDiaDistintas ?></td>
				</tr>
<?php 
				$fecha_actual=$row->Fecha;                
			}
?>			

			<tr class="d-flex">
				<td class="col-3"><a href="<?= site_url('admin/visitas/eliminar/') ?><?= $row->IdVisitas ?>">Eliminar</a></td>
	       		<td class="col-3 text-center"><a href="<?= site_url('admin/paginas/buscar/') ?><?= $row->Fecha ?>/<?= $row->IP ?>"><?= $row->IP ?></a></td>
	       		<td class="col-2 text-center"><?= $row->Hora ?></td>
	       		<td class="col-2 text-center"><?= $row->Fecha ?></td>
	       		<td class="col-2 text-center"><?= lang($row->Idioma) ?></td>
	       	</tr>
<?php 
		}

		$visitasDia = visitasDia($fecha_actual);
        $visitasDiaDistintas = visitasDiaDistintas($fecha_actual);
?>

		<tr class="d-flex" bgcolor="green">
			<td class="col-4"><a href="<?= site_url('admin/paginas/buscar/') ?><?= $fecha_actual ?>/0"><?= $fecha_actual ?></a></td>
			<td class="col-3 text-right">Visitas dia:</td>
			<td class="col-1 text-center"><?= $visitasDia ?></td>
			<td class="col-3 text-right">Visitas dia distintas:</td>
			<td class="col-1 text-center"><?= $visitasDiaDistintas ?></td>
		</tr>
	</table>			
<?= $this->endSection() ?>