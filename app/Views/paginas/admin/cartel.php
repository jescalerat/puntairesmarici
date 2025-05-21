<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
<form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/carteles/actualizar') ?>">
	<div class="row">
		<div class="col" id="descripcion">
			<h3 class="text-center"><?= cambiarAcentos($titulo) ?></h3>
		</div>
    </div>
	<div class="row">
	<div class="col" id="carteles">
			<label>Carteles</label>
			<textarea id="cartel" name="cartel" class="form-control" rows="3" cols="80"></textarea>
		</div>
	</div>

	<br/>
	
	<div class="form-group">
        <div class="col">
            <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
        </div>
    </div>
    
    <br/>

	<div class="row">
		<div class="col" id="carteles">
			<table class="table">
        		<thead class="thead-dark">
            		<tr>
            			<th>Cartel</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
				<?php 
            foreach ($listaCarteles as $row){
?>			
				<tr>
					<td><img src="<?= $row->Carteles ?>" name="btndocumento" border="0" id="btndocumento" height="150px" width="150px"></td>
    				<td><a href="<?= site_url('admin/carteles/eliminar/') ?><?= $row->IdCartel ?>/<?= $idEncuentro ?>">Eliminar</a></td>
    			</tr>
<?php 
            }
?>
			</table>
		</div>
	</div>

	
	<input type="hidden" id="idEncuentro" name="idEncuentro" value="<?= $idEncuentro ?>"/>

</form>
<?= $this->endSection() ?>