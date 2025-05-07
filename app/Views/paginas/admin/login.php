<?= $this->include('templates/cabecera') ?>
<br/>
<br/>
<br/>


<div class="row">
    <div class="col-4">
        &nbsp;
    </div>
    <div class="col-4">
<?php 
        if ($error != null){
?>        
            <div class="row">
                <div class="col" id="respuestas">
                    <p class="text-center text-info"><?= $error ?></p>
                </div>
            </div>
<?php 
        }
?>

        <form role="form" method="post" action="comprobar">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input class="form-control" type="text" name="usuario" id="usuario" required="required" autofocus>
                <label class="form-label" for="usuario">Usuario</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input class="form-control" type="password" name="password" id="password" required="required">
                <label class="form-label" for="password">Password</label>
            </div>


            <!-- Submit button -->
            <div class="form-group">
                <div class="col">
                    <p class="text-center"><button type="submit" class="btn btn-default">Enviar</button></p>
                </div>
            </div>

        </form>
    </div>
    <div class="col-4">
        &nbsp;
    </div>
</div>
