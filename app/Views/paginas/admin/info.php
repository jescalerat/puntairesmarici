<?= $this->extend('templates/defaultAdmin') ?>

<?= $this->section('content') ?>
<?php
	phpinfo();
?>
<?= $this->endSection() ?>