<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>

<div class="container">
	<form role="form" class="needs-validation" method="post" action="contactar/mensaje" novalidate>
		<div class="row">
			<div class="input-field col">
				<h1 class="text-center"><?= mb_strtoupper(cambiarAcentos(lang('Traductor.contactartitulo'))) ?></h1>
			</div>
		</div>

<?php		
		if ($contactaCorrecto != null){
?>
			<form class="col">
				<div class="row">
					<div class="col" id="respuestas">
						<p class="text-center text-info"><?= cambiarAcentos(lang('Traductor.contactarrespuesta1')) ?></p>
						<p class="text-center text-info"><?= cambiarAcentos(lang('Traductor.contactarrespuesta2')) ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<p class="text-center">
							<a class="btn btn-default btn-block" href="<?= site_url('contactar') ?>"><?= cambiarAcentos(lang('Traductor.contactarotra')) ?></a>
						</p>
					</div>
				</div>
			</form>
<?php		
	} else {
?>
		<div class="form-group">
        	<label class="col control-label" for="nombre">
        		<?= cambiarAcentos(lang('Traductor.contactarnombre')) ?>
        	</label>
        	<div class="col-sm-10">
                <input class="form-control" type="text" name="nombre" id="nombre" required="required" autofocus>
				<div class="invalid-feedback"><?= cambiarAcentos(lang('Traductor.contactarerrornombre')) ?></div>
            </div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="email">
               <?= cambiarAcentos(lang('Traductor.contactaremail')) ?>
        	</label>
            <div id="correo" class="col-sm-10">
                <input class="form-control" type="email" name="correo" id="correo" required>
                <div class="invalid-feedback"><?= cambiarAcentos(lang('Traductor.contactarerroremail')) ?></div>
            </div>
            <div class="invalid-feedback">Prueba mensaje</div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="mensaje">
                <?= cambiarAcentos(lang('Traductor.contactarmensaje')) ?>
        	</label>
            <div class="col-sm-10">
            	<textarea id="mensaje" name="mensaje" class="form-control" rows="3" cols="80" required="required"></textarea>
                <div class="invalid-feedback"><?= cambiarAcentos(lang('Traductor.contactarerrormensaje')) ?></div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col">
                <p class="text-center"><button type="submit" class="btn btn-default"><?= cambiarAcentos(lang('Traductor.contactarenviar')) ?></button></p>
            </div>
        </div>
<?php		
	}
?>
	</form>
</div>
<script>
// Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
(function () {
  'use strict'

  // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
  var forms = document.querySelectorAll('.needs-validation')

  // Bucle sobre ellos y evitar el envío
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
<?= $this->endSection() ?>