<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<br/>
<br/>
<br/>
<form class="col">
	<div class="row">
		<div class="col-9" id="recargaEncuentros">

		</div>
		<div class="col-3" id="buscador">
			<form class="col">
				<div class="row">
					<div class="col" id="anyo">
						<select name="anyoSelect" id="anyoSelect" class="form-control">
							<option value="0"><?= cambiarAcentos(lang('Traductor.bucadoranyo')) ?></option>
<?php	
							foreach ($listaAnyos as $row){
?>				    
								<option value="<?= $row->Anyo ?>"><?= $row->Anyo ?></option>		
<?php 
							}
?>					
						</select>

					</div>
				</div>
				<div class="row">
					<div class="col selector-comunidad" id="comunidades">
						<label><?= cambiarAcentos(lang('Traductor.bucadorcomunidades')) ?></label>
						<select name="comunidadSelect" id="comunidadSelect" class="form-control"></select>
					</div>
				</div>
				<div class="row">
					<div class="col selector-provincia" id="provincias">
						<label><?= cambiarAcentos(lang('Traductor.bucadorprovincias')) ?></label>
						<select name="provinciaSelect" id="provinciaSelect" class="form-control" disabled="disabled"></select>
					</div>
				</div>
				<div class="row">
					<div class="col selector-municipio" id="municipios">
						<label><?= cambiarAcentos(lang('Traductor.bucadormunicipios')) ?></label>
						<select name="municipioSelect" id="municipioSelect" class="form-control" disabled="disabled"></select>
					</div>
				</div>

			</form>
		</div>
	</div>
</form>
<?= $this->endSection() ?>