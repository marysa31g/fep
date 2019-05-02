<br>
<div class="container" style="float: center; margin-top:30px;  margin-bottom:50px;">
<div class="card col-md-7 mx-auto">
<div class="row" >
      <div class="col-md-8" >
        <div class="col-md-auto" style="margin-top: 25px;">
            <h2 style="text-align: center;">Datos de Usuario</h2>
            <hr>
          </div>
          <div  style="margin-left: 10px;">
            Usuario
          </div>
        
      <div class="card col-md-auto" style="margin: 10px;">
             <?php  echo $user->matricula?>
          </div>
           <div  style="margin-left: 10px;">
            Rol del profesor
          </div>
          
          <div class="card col-md-auto" style="margin: 10px;">
            Profesor
          </div>
           <div  style="margin-left: 10px;">
             Nombre
          </div>
          <div class="card col-md-auto" style="margin: 10px;">          
          <?php  echo $user->nombres?> <?php  echo $user->apellido_paterno?> <?php  echo $user->apellido_materno?>
        </div>

         
                        
                    
      </div>
      <div class="col-md-4">
        <div class="card-body" style="margin-top: 50px;">
         <img class="card-img-top" src="<?php echo base_url();?>uploads/<?php echo $user->foto; ?>">
        </div>
      </div>
    
    </div>
      <div class="" style="margin-left: 10px; margin-top:20px; margin-bottom: 20px;">
                        <button class="btn btn-boton btn-sm" data-toggle="modal" data-target="#modal_upd_pefil_profesor">Actualizar Información</button>
 
                        <button class="btn btn-boton btn-sm offset-1" data-toggle="modal" data-target="#profesor_pass">Cambiar Contraseña</button>
          </div>
          
</div>

 <div class="" >
                       <br><br>
          </div>

<!-- Modal para editar perfil de profesor -->
<div class="modal fade" id="modal_upd_pefil_profesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil del Profesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="<?php echo base_url() ?>professor/profile" method="post">
        	<div class="form-group">
        		<label>Usuario *</label>
        		<input type="text" class="form-control" name="matricula" value="<?php  echo $user->matricula;?>">
            <?php  echo form_error('matricula'); ?>
        	</div>
        	<div class="form-group">
        		<label>Nombre(s) *</label>
        		<input type="text" class="form-control" name="nombres" value="<?php  echo $user->nombres;?>">
            <?php  echo form_error('nombres'); ?>
        	</div>
        	<div class="form-group">
        		<label>Apellido Paterno *</label>
        		<input type="text" class="form-control" name="apellido_paterno" value="<?php  echo $user->apellido_paterno;?>">
            <?php  echo form_error('apellido_paterno'); ?>
        	</div>
        	<div class="form-group">
        		<label>Apellido Materno *</label>
        		<input type="text" class="form-control" name="apellido_materno" value="<?php  echo $user->apellido_materno;?>">
            <?php  echo form_error('apellido_materno'); ?>
        	</div>
          <h6 class="obligatorio">* Campos obligatorios </h6>

        	<input type="hidden" name="eli" id="elim">
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="upd_profesor" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<?php //modal para la contraseña ?>

<div class="modal fade" id="profesor_pass" tabindex="-1" role="dialog" aria-labelledby="modal_vaciarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      
      <form class="" action="<?php echo base_url();?>access/update_pass" method="post">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal_vaciarLabel">Editar Contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <?php
              if($this->session->flashdata('flash'))
                echo $this->session->flashdata('flash');
            ?>

            <div class="form-group">
              <label for="pass_actual" accesskey="c"> Contraseña Actual *</label>
              <input type="password" name="pass_actual" class="form-control" id="pass_actual" value="<?php echo set_value('pass_actual'); ?>" placeholder="Contraseña Actual">
              <?php echo form_error('pass_actual'); ?>
            </div>
            <div class="form-group">
              <label for="pass" accesskey="c">Nueva Contraseña *</label>
              <input type="password" name="pass" class="form-control" id="pass" value="<?php echo set_value('pass'); ?>" placeholder="Nueva Contraseña">
              <?php echo form_error('pass'); ?>
            </div>
            <div class="form-group">
              <label for="pass_conf" accesskey="c">Confirmar Nueva Contraseña *</label>
              <input type="password" name="pass_conf" class="form-control" id="pass_conf" value="<?php echo set_value('pass_conf'); ?>" placeholder="Confirmar Nueva Contraseña">
              <?php echo form_error('pass_conf'); ?>
              <br><h6 class="obligatorio">* Campos obligatorios</h6> 
            </div>
                       
          </div>

          <div class="modal-pie">
            <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">Cancelar
            </button>
            <input type="submit" name="mod_pass" class="btn btn-boton col-4 offset-2" value="Aceptar"></input>
          </div>
        </div>

      </form>
      
    </div>
</div>
    