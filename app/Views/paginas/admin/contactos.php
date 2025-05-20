<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
<form role="form" id="cambio_pass" method="post" action="<?= site_url('admin/encuentros/actualizar') ?>">
	<div class="row">
		<div class="col-6 selector-comunidad" id="comunidades">
			<label>Comunidades</label>
			<select name="comunidadSelect" id="comunidadSelect" class="form-control"></select>
		</div>
		<div class="col-6 selector-provincia" id="provincias">
			<label>Provincias</label>
			<select name="provinciaSelect" id="provinciaSelect" class="form-control"></select>
		</div>
	</div>
	<div class="row">
		<div class="col selector-municipio" id="municipios">
			<label>Municipio</label>
			<select name="municipioSelect" id="municipioSelect" class="form-control"></select>
		</div>
	</div>
	
	<br/>
	
	<div class="form-group">
        <div class="col">
            <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
        </div>
    </div>	

	<div id="recargaEncuentros">

	</div>

<?php 
	if ($error != null)
    {
        print(cambiarAcentos($error));
	}
?>

	<input type="hidden" id="idEncuentro" name="idEncuentro" value="<?= $idEncuentro ?>"/>
</form>	
<?= $this->endSection() ?>