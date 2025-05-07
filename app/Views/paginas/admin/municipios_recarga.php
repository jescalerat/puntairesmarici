<?php
	if ($idProvincia != 0){
?>
<form class="col">
	<div class="row">
		<div class="col" id="municipios">
			<table class="table">
        		<thead class="thead-dark">
            		<tr>
            			<th>Municipio</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
<?php 
           foreach ($listaMunicipios as $row){
				$desc = $row->Municipio." (".$row->Provincia.")";
?>			
				<tr>
    				<td><a href="<?= site_url('admin/municipios/modificar/') ?><?= $row->IdMunicipio ?>"><?= $desc ?></a></td>
    				<td><a href="<?= site_url('admin/municipios/eliminar/') ?><?= $row->IdMunicipio ?>">Eliminar</a></td>
    			</tr>
<?php 
            }
?>
			</table>
		</div>
	</div>
</form>

<?php
	}
?>