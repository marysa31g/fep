<br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-5 mx-auto card">
      <form action="<?php echo base_url();?>admin/new_professor" method="post" class="" >
        <br>
        <h2 class="text-center">Registrar Profesor</h2>
        <hr>
        <?php
        //Si existen las sesiones flasdata que se muestren
          if($this->session->flashdata('flash'))
            echo $this->session->flashdata('flash');
        ?>

        <div class="form-group">
          <label for="correo">Correo del Profesor</label>
          <input type="text" class="form-control" name="correo" id="correo" value="<?php echo set_value('correo')?>" placeholder="usuario@servidor.com" autofocus="autofocus">
          <?php echo form_error('correo'); ?>
        </div>
      <!--
        <div class="form-group">
          <label for="cantidad">Cantidad de profesores</label>
          <input type="number" min="0" class="form-control" name="cantidad" id="cantidad" value="<?php echo set_value('');?>" placeholder="#">
          <?php echo form_error(''); ?>
        </div>
      -->
      <br>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-boton btn-md btn-block" value="Aceptar"/>
        </div>
      <br>
      </form>
    </div>
	</div>
</div>