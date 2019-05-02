<nav class="navbar navbar-expand-lg navbar-dark barraprincipal" role="navigation" style="margin-bottom: 50px;">
<a class="navbar-brand" href=""><br></a>

      <?php 
        if (ucfirst($this->session->userdata('logueado') ))
        {
          if($this->session->userdata('grupo') === 'profesor' || $this->session->userdata('grupo') === 'root' || $this->session->userdata('grupo') === 'alumnos' ) 
          { 
      ?>
  <a class="navbar-brand" href=""> <img class="marg_clas1" src="<?php echo base_url();?>rec/images/fep2.png"></a>
  <span class=" navbar-brand font_tam " >Sistema de Formulación y Evaluación de Proyecto</span>

   <?php
          }
        }
      ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <ul class="navbar-nav mr-auto menu">


      <?php 
        if( ucfirst($this->session->userdata('logueado') ) )
        { 
          $id_perfil = $this->session->userdata('id');
        }
      ?>

    </ul>
    <ul class="navbar-nav ml-auto menu">
      <?php 
        if (ucfirst($this->session->userdata('logueado') ))
        {
          if ($this->session->userdata('grupo') === 'root') 
          { 
      ?>
<li class="nav-item">     
          <span class=" icon-user" title="Usuario" >
            <?php //muestra el nombre de usuario
              print($this->session->userdata('usuario'));
            ?>
          </span>
        </li>
        <li class="nav-item">
          <a class="navbarra menuses" title="Lista de Profesores" style="cursor:pointer;" href="<?php echo base_url();?>admin">Lista de Profesores</a>
        </li>

        <li class="nav-item">
          <a class="navbarra menuses" title="Nuevo Semestre" style="cursor:pointer;" href="<?php echo base_url();?>admin/reset">Nuevo Semestre</a>
        </li>
        

        <li class="nav-item menuses"> <!--muestra icono de salida --> 
          <a href="<?php echo base_url();?>access/logout" title="Cerrar Sesión"><span class="icon-switch nav-link" ></span></a> 
        </li>
        <?php 
          }
          else
          {
            if($this->session->userdata('grupo') === 'profesor') 
            { 
        ?>     
        <li class="nav-item">     
          <span class=" icon-user" title="Usuario">
            <?php //muestra el nombre de usuario
              print($this->session->userdata('usuario'));
            ?>
          </span>
        </li>
        <li class="nav-item">
          <a class="navbarra menuses" title="Lista de Grupos" href="<?php echo base_url();?>professor">Listas de Grupos</a>
        </li>

        <li class="nav-item">
          <a class="navbarra menuses" title="Perfil" style="cursor:pointer;" href="<?php echo base_url();?>professor/profile">Perfil</a>
        </li>

        <li class="nav-item">
          <a class="navbarra menuses" title="Cerrar Sesión" href="<?php echo base_url();?>access/logout"><span class="icon-switch"></span></a>
        </li>

      <?php
          }
          else{
      ?>
      <li class="nav-item">     
          <span class=" icon-user" title="Usuario" >
            <?php //muestra el nombre de usuario
              print($this->session->userdata('usuario'));
            ?>
          </span>
    <li class="nav-item dropdown  ">
          <a  class=" text-white nav-link dropdown-toggle menuses "  data-toggle="dropdown"  href="<?php echo base_url();?>">Proyecto</a>
          <div class="dropdown-menu">
              <a class=" navbarra menuses" title="Modificar Nombre del  Proyecto" data-toggle="modal" data-target="#modificar_proyecto" style="cursor:pointer; ">Modificar Nombre</a>
              <a class="navbarra menuses" title="Borrar todo el Proyecto" style="cursor:pointer; " data-toggle="modal" data-target="#borrar_proyecto">Borrar</a>
          </div>
      </li>        


        <li class="nav-item">
          <a class=" navbarra menuses" title="Modificar Contraseña" data-toggle="modal" data-target="#al_pass" style="cursor:pointer;">
            Modificar Contraseña
          </a>
        </li>
        
        <li class="nav-item">
          <a class="navbarra menuses"  title="Cerrar Sesión" href="<?php echo base_url();?>access/logout"><span class="icon-switch" ></span></a>
        </li>
      <?php }
        }
      }?>
    </ul>


  </div>

</nav>

      <!-- pass alumno -->
      <div class="modal fade" id="al_pass" tabindex="-1" role="dialog" aria-labelledby="modal_vaciarLabel" aria-hidden="true">
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


<?php //modal para borrar proyecto ?>
<div class="modal fade" id="borrar_proyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar el proyecto?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url()?>student/delete_project">
        <div class="modal-body">

            <div class="form-group obligatorio2">
              <label>El proyecto se eliminará de la lista</label>  
                         
            </div>          
          
        </div>
        <div class="modal-pie">
          <input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">

          <input type="submit" class="btn btn-boton col-4 offset-2" name="borrar_proyecto" value="Aceptar">
          
        </div>
      </form>
    </div>
  </div>
</div>


<!-- modal para modificar proyecto-->
<div class="modal fade" id="modificar_proyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Editar Nombre del Proyecto</h5>
        <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>student/update_project" method="post">
        <div class="modal-body">


          <div class="form-group">
            <label for="titulo" class="float-left">Nombre del Proyecto *</label>
            <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo set_value('titulo'); ?>"  placeholder="Ingrese el Título del Proyecto" autofocus="autofocus">
            <?php echo form_error('titulo'); ?>
            <br><h6 class="obligatorio">* Campo obligatorio</h6>
          </div>

        

          <button type="button" class="btn btn-secondary col-4 offset-1"  data-dismiss="modal">Cancelar          
          </button>
          <input type="submit" name="modificar_proyecto" value="Aceptar" class="btn btn-boton col-4 offset-2"/>
        </div>
      </form>

    </div>
  </div>
</div>