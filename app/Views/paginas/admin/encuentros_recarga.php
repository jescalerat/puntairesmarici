<?php
	if ($idProvincia != 0){
?>
<form class="col">
	<div class="row">
		<div class="col" id="encuentros">
			<table class="table">
        		<thead class="thead-dark">
            		<tr>
            			<th>Encuentro</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
<?php 
			$urlMod = "admin/".$pagina."/modificar/";
			$urlEli = "admin/".$pagina."/eliminar/";
           foreach ($listaEncuentros as $row){
				$desc = $row->Municipio." (".$row->Provincia.")";
				if ($row->Descripcion != null){
					$desc .= " --- ".$row->Descripcion;
				}
				$desc .= " --- ".fecha($row->Dia, $row->Mes, $row->Anyo, 1);
?>			
				<tr>
    				<td><a href="<?= site_url($urlMod) ?><?= $row->IdEncuentro ?>"><?= $desc ?></a></td>
    				<td><a href="<?= site_url($urlEli) ?><?= $row->IdEncuentro ?>">Eliminar</a></td>
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