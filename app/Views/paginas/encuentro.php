<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<br/>
<br/>
<br/>
<form class="col">
    	<div class="row">
    		<div class="col" id="municipio">
    			<h1 class="text-center"><?= cambiarAcentos($municipio->Municipio) ?> (<?= cambiarAcentos($provincia->Provincia) ?>)</h1>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col" id="descripcion">
    			<h3 class="text-center"><?= cambiarAcentos($titulo) ?></h3>
    		</div>
    	</div>
</form>

<form name="cambiar_boton" method="post">
	<div class="container">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?= cambiarAcentos(lang('Traductor.encuentrocarteles')) ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?= cambiarAcentos(lang('Traductor.encuentrocontactos')) ?></a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<div class="row">
					<div class="col">
<?php 			
					if ($total_carteles==0)
					{
?>				
						<div class="row">
							<div class="col text-center">
								<?= cambiarAcentos(lang('Traductor.encuentrosincartel')) ?>
							</div>
						</div>
<?php				
					}
					else
					{
						foreach ($listacarteles as $row)
						{
?>				
							<div class="row">
								<div class="col text-center">
									<img src="<?= $row->Carteles ?>" name="btndocumento" border="0" height="1000px" width="800px" id="btndocumento">
								</div>
							</div>
<?php 				
						}
					}
?>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<div class="row">
					<div class="col">
<?php 			
					if ($total_contactos==0)
					{
?>				
						<div class="row">
							<div class="col text-center">
								<?= cambiarAcentos(lang('Traductor.encuentrosincontacto')) ?>
							</div>
						</div>
<?php				
					}
					else
					{
						foreach ($listacontactos as $row)
						{
?>				
							<div class="row">
								<div class="col">
									<?= cambiarAcentos($row->Contacto) ?>
								</div>
							</div>
<?php 				
						}
					}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<br/>
<br/>

<?php 
    if ($mostrarVolver == 1){
?>
        <div class="alert alert-info text-center">
        	<a href="<?= base_url('index.php/encuentros') ?>/<?= $dia ?>/<?= $mes ?>/<?= $any ?>/<?= $mostrarVolver ?>" class="alert-link"><?= cambiarAcentos(lang('Traductor.encuentrosvolver')) ?></a>
        </div>
<?php 
    }
?>
<?= $this->endSection() ?>