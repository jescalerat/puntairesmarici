	<?= $this->include('templates/cabecera') ?>

    <div class="row">
        <div class="col-3" id="menu">
            <?= $this->include('templates/menuAdmin') ?>
        </div>
        <div class="col-9" id="principal">
            <?= $this->renderSection('content') ?>
        </div>
    </div>        
</body>
</html>