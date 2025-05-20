<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
<form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/contactos/actualizar') ?>">
	<div class="row">
		<div class="col" id="descripcion">
			<h3 class="text-center"><?= cambiarAcentos($titulo) ?></h3>
		</div>
    </div>
	<div class="row">
		<div class="col" id="contactos">
			<table class="table">
        		<thead class="thead-dark">
            		<tr>
            			<th>Contacto</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
<?php 
            foreach ($listaContactos as $row){
?>			
				<tr>
    				<td><?= $row->Contacto ?></td>
    				<td><a href="<?= site_url('admin/contactos/eliminar/') ?><?= $row->IdEncuentro ?>/<?= $row->IdContacto ?>">Eliminar</a></td>
    			</tr>
<?php 
            }
?>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col" id="contacto">
			<label>Contacto</label>
			<input class="form-control" type="text" name="contacto" id="contacto" value="<?= $contacto ?>">
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
		<div class="col" id="contactos">
			<table class="table">
        		<thead class="thead-dark">
            		<tr>
            			<th>Contacto</th>
						<th>Modificar</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
				<?php 
            foreach ($listaContactosMunicipio as $row){
?>			
				<tr>
					<td><a href="<?= site_url('admin/contactos/insertarEncuentro/') ?><?= $row->IdContacto ?>/<?= $idEncuentro ?>"><?= $row->Contacto ?></a></td>
					<td><a href="<?= site_url('admin/contactos/modificarContacto/') ?><?= $row->IdContacto ?>/<?= $idEncuentro ?>">Modificar</a></td>
    				<td><a href="<?= site_url('admin/contactos/eliminarContacto/') ?><?= $row->IdContacto ?>/<?= $idEncuentro ?>/<?= $idMunicipio ?>">Eliminar</a></td>
    			</tr>
<?php 
            }
?>
			</table>
		</div>
	</div>

	
	<input type="hidden" id="idContacto" name="idContacto" value="<?= $idContacto ?>"/>
	<input type="hidden" id="idEncuentro" name="idEncuentro" value="<?= $idEncuentro ?>"/>

</form>
<?= $this->endSection() ?>