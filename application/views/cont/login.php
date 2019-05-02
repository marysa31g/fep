<div class="container">
  <div class="row">

    <?php //Formulación y Evaluación de proyectos ?>
<br> 
       <div class="col-sm-5  mx-auto card" style="padding-top: 20px;" > <!--Card para agregar en una targeta-->
                <br> <!--Salto de linea-->
       
        <div class="text-center"> <!--Se añadio el div para la imagen de logo fep-->
          <img class="marg_clas" src="rec/images/fep.jpeg">
          </div>
          

        <form class="" action="<?php echo base_url();?>access" method="post">
         
           <h6 class="font_tam text-center" >Sistema de Formulación y Evaluación de Proyectos</h6> <br> 
           <h6 class="text-center" style="text-align: center;" >Ingrese el Usuario y Contraseña</h6>
          <hr>
          <?php
            if($this->session->flashdata('flash'))
              echo $this->session->flashdata('flash');
          ?>

          <div class="form-group">
            <label for="usuario" accesskey="u">Usuario</label>
            <input type="text" name="usuario" class="form-control" id="usuario" value="<?php echo set_value('usuario'); ?>" aria-describedby="emailHelp" placeholder="Ingrese el Nombre de Usuario" autofocus="autofocus">
            <?php echo form_error('usuario'); ?>
          </div>

          <div class="form-group">
            <label for="pass" accesskey="c">Contraseña</label>
            <input type="password" name="pass" class="form-control" id="pass" value="<?php echo set_value('pass'); ?>" placeholder="Ingrese la Contraseña">
            <?php echo form_error('pass'); ?>

          </div>
        <!--
          <div class="form-group">
            <span class="ojo" id="ojo">Mostrar contraseña.</span>
          </div>
        -->

          <input type="submit" name="entrar" class="btn btn-boton btn-md btn-block" value="Ingresar" style="margin-bottom: 20px;" />
        </form>

      </div>
    
  </div>
</div>