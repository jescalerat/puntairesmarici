<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
	<h1 class="text-center">Paginas vistas en Puntaires Mari</h1>
<?php 
    if ($titulo != ""){
?>
		<h3 class="text-center"><?= $titulo ?></h3>
<?php
    }
?>	
	
	<table class="table table-bordered">
   		<thead class="thead-dark">
	   		<tr class="d-flex">
				<th class="col-2 text-center">Eliminar</th>
	       		<th class="col-2 text-center">IP</th>
	       		<th class="col-2 text-center">Hora</th>
	       		<th class="col-2 text-center">Fecha</th>
	       		<th class="col-2 text-center">Pagina</th>
	       		<th class="col-2 text-center">Observaciones</th>
	       	</tr>
		</thead>

<?php 
        foreach ($listapaginasvistas as $row){		
			$pagina_vista = tituloPagina($row->Pagina);
			$estilo = estilo($row->Pagina);
			$observaciones = observaciones($row->Pagina, $row->Observaciones);
?>                
			<tr class="d-flex" <?php if ($estilo!="") {print($estilo);} ?>>
				<td class="col-2"><a href="<?= site_url('admin/paginas/eliminar/') ?><?= $row->IdPaginasVistas ?>">Eliminar</a></td>
				<td class="col-2 text-center"><?= $row->IP ?></td>
				<td class="col-2 text-center"><?= $row->Hora ?></td>
				<td class="col-2 text-center"><?= devolverFechaBBDD($row->Fecha) ?></td>
				<td class="col-2 text-center"><?= $pagina_vista ?></td>
				<td class="col-2 text-center"><?= $observaciones ?></td>
			</tr>
<?php 
		}
?>			

	</table>			
<?= $this->endSection() ?>