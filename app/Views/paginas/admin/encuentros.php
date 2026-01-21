<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
<?php 
	if ($municipioMod != null)
    {
        print("<h2><center>".$municipioMod->Municipio."</center></h2>");
	}
?>

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

	<div class="row">
		<div class="col" id="descripcion">
			<label>Descripci&oacute;n</label>
			<input class="form-control" type="text" name="descripcion" id="descripcion" value="<?= $descripcion ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-4" id="dia">
			<label>Dia</label>
	            <select class="form-control" name="dia" id="dia">
	                <option value="0">Dia</option>
<?php                
                        $seleccionDia = "";
	                    for ($x=1;$x<=31;$x++)
	                    {
	                        $seleccionDia = "";
	                        if ($x == $dia){
	                            $seleccionDia = "selected";
	                        }
?>                            
                        	<option value="<?= $x ?>" <?= $seleccionDia ?>><?= $x ?>
<?php                                
                    	}
?>                        
            	</select>

		</div>

		<div class="col-4" id="mes">
			<label>Mes</label>
	            <select class="form-control" name="mes" id="mes">
	                <option value="0">Mes</option>
<?php                
                        $seleccionMes = "";
	                    for ($x=1;$x<=12;$x++)
	                    {
	                        $seleccionMes = "";
	                        if ($x == $mes){
	                            $seleccionMes = "selected";
	                        }
?>                            
                        	<option value="<?= $x ?>" <?= $seleccionMes ?>><?= $x ?>
<?php                                
                    	}
?>                        
            	</select>

		</div>

		<div class="col-4" id="anyo">
			<label>A&ntilde;o</label>
			<input class="form-control" type="text" name="any" id="any" value="<?= $any ?>">
		</div>
	</div>
	
	<div class="checkbox"> 
		<label><input type="checkbox" name="duplicar" id="duplicar">Duplicar</label>
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

	if ($idEncuentroNuevo != null){
?>
	<a href="<?= site_url('admin/contactos/modificar/') ?><?= $idEncuentroNuevo ?>">Añadir contacto</a>
<?php
	}
?>
	<input type="hidden" id="idEncuentro" name="idEncuentro" value="<?= $idEncuentro ?>"/>
</form>	
<?= $this->endSection() ?>