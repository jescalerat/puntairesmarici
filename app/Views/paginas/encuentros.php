<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>

<br/>
<br/>
<br/>

<?php require_once('municipios_recarga.php') ?>

<br/>
<br/>

<?php 
    if ($mostrarVolver == 1){
?>
        <div class="alert alert-info text-center">
        	<a href="<?= base_url('index.php/calendario') ?>/<?= $mes ?>/<?= $any ?>" class="alert-link"><?= cambiarAcentos(lang('Traductor.encuentrosvolver')) ?></a>
        </div>
<?php 
    }
?>
<?= $this->endSection() ?>