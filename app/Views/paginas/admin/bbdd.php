<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
	<h1 class="text-center">Modificar Base de datos</h1>
	
	<div class="container">
    	<form role="form" id="bbdd" method="post" action="<?= site_url('admin/bbdd/actualizar') ?>">
                <div class="form-group">
            	<label class="col control-label" for="mensaje">
            		Mensaje
            	</label>
                <div class="col-sm-10">
                	<textarea id="mensaje" name="mensaje" class="form-control" rows="3" cols="80" required="required"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col">
                    <p class="text-center"><button type="submit" class="btn btn-default">Enviar</button></p>
                </div>
            </div>
    	</form>
    </div>
<?php 
	if ($error != null)
    {
        print(cambiarAcentos($error));
	}
?>
<?= $this->endSection() ?>