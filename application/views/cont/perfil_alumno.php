<div class="container">
	<div class="row">
		
			<div class="col-md-4 offset-md-4">

        <form class="" action="<?php echo base_url();?>usuario/modificar_alumno" method="post">
          <h2 class="text-center" >Modificar Contraseña</h2>
          <hr>
          <?php
            if($this->session->flashdata('flash'))
              echo $this->session->flashdata('flash');
          ?>

          <div class="form-group">
            <label for="pass_actual" accesskey="c">Confirmar Contraseña Actual</label>
            <input type="password" name="pass_actual" class="form-control" id="pass_actual" value="<?php echo set_value('pass_actual'); ?>" placeholder="Contraseña actual">
            <?php echo form_error('pass_actual'); ?>
          </div>
          <div class="form-group">
            <label for="pass" accesskey="c">Contraseña</label>
            <input type="password" name="pass" class="form-control" id="pass" value="<?php echo set_value('pass'); ?>" placeholder="Nueva Contraseña">
            <?php echo form_error('pass'); ?>
          </div>
          <div class="form-group">
            <label for="pass_conf" accesskey="c">Repetir Contraseña</label>
            <input type="password" name="pass_conf" class="form-control" id="pass_conf" value="<?php echo set_value('pass_conf'); ?>" placeholder="Confirmar Contraseña">
            <?php echo form_error('pass_conf'); ?>
          </div>
        <!--
          <div class="form-group">
            <span class="ojo" id="ojo">Mostrar contraseña.</span>
          </div>
        -->
          <input type="submit" name="submit" class="btn btn-info btn-md btn-block" value="Modificar"/>
        </form>

      </div>
		
	</div>
</div>

<?php //para modificar la contraseña en una seccion ?>