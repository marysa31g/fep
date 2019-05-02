<script type="text/javascript">
  $(document).ready(function(){
    if(<?php echo $bandera_ins; ?>)
    $('#modal_add_alumno').modal("show");
    if(<?php echo $bandera_upd; ?>)
    $('#modal_upd_alumno').modal("show");
  });
</script>

<div class="container">
  <?php  
    if($this->session->flashdata('flash'))
        echo $this->session->flashdata('flash');
  ?>
	<table class="table table-responsive-lg table-bordered ">
			<thead class="text-center" >
				<tr class="text-center">
					<th colspan="100%">Lista de Alumnos <a href="#" data-toggle="modal" data-target="#modal_add_alumno" class="icono" style="float: right;" title="Agregar un alumno a la lista"><span class="icon-plus" ></span></a></th>
				</tr>
				<tr>
					<th>Número</th>
					<th>Nombre del Alumno</th>
					<th>Matrícula</th>
					<th>Opciones</th>
				</tr>
			</thead>
				<tbody>
					<?php $i=0; foreach ($alumnos as $alumno) {$i++;?>
						<tr>
							<th><?php echo $i?></th>
							<td><?php echo $alumno->nombres;?> <?php echo $alumno->apellido_paterno;?> <?php  echo $alumno->apellido_materno?></td>
							<td><?php echo $alumno->matricula;?></td>
							<td>
                <a class="icono" href="<?php echo base_url()?>professor/update_student/<?php echo $alumno->id;?>/<?php echo $alumno->grupo;?>"><span class="icon-refresh" title="Actualizar Información"></span></a>
                <span class="icono icon-trash" title="Eliminar Alumno" data-toggle="modal" data-target="#modal_del_alumno" onclick="elimina_alumno(<?php echo $alumno->id;?>,<?php echo $alumno->grupo;?>)"></span>
              </td>
						</tr>
					<?php }?>
				</tbody>
		</table>
  <?php
    if(!$alumnos)
    {
  ?>
    <div class="text-danger text-center">
      <span class="">No se han registrado alumnos</span>
    </div>
  <?php
    }
  ?>
</div>

<!-- Modal para agregar un Alumno -->
<div class="modal fade" id="modal_add_alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar un Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="<?php echo base_url() ?>professor/insert_student" method="post">
        	<div class="form-group">
        		<label>Matrícula *</label>
        		<input type="text" class="form-control" name="matricula" value="<?php echo set_value('matricula'); ?>">
            <?php  echo form_error('matricula'); ?>
        	</div>
          <input type="hidden" class="form-control" name="grupo" value="<?php echo $grupo?>">

        	<div class="form-group">
        		<label>Nombre(s) *</label>
        		<input type="text" class="form-control" name="nombres" value="<?php echo set_value('nombres'); ?>">
            <?php  echo form_error('nombres'); ?>
        	</div>
        	<div class="form-group">
        		<label>Apellido Paterno *</label>
        		<input type="text" class="form-control" name="apellido_paterno" value="<?php echo set_value('apellido_paterno'); ?>">
            <?php  echo form_error('apellido_paterno'); ?>
        	</div>
        	<div class="form-group">
        		<label>Apellido Materno *</label>
        		<input type="text" class="form-control" name="apellido_materno" value="<?php echo set_value('apellido_materno'); ?>">
            <?php  echo form_error('apellido_materno'); ?>
            <br>
            <h6 class="obligatorio">* Campos obligatorios</h6>
        	</div>
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="add_alumno" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Modal para modificar un Alumno -->
<div class="modal fade" id="modal_upd_alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil del Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="<?php echo base_url() ?>professor/update_student/<?php echo $person->id;?>/<?php echo $person->grupo;?>" method="post">
          <div class="form-group">
            <label>Matrícula *</label>
            <input type="text" class="form-control" name="matricula" value="<?php echo $person->matricula; ?>">
            <?php  echo form_error('matricula'); ?>
          </div>
            <input type="hidden" class="form-control" name="grupo" value="<?php echo $person->grupo; ?>">
          <div class="form-group">
            <label>Nombre(s) *</label>
            <input type="text" class="form-control" name="nombres" value="<?php echo $person->nombres; ?>">
            <?php  echo form_error('nombres'); ?>
          </div>
          <div class="form-group">
            <label>Apellido Paterno *</label>
            <input type="text" class="form-control" name="apellido_paterno" value="<?php echo $person->apellido_paterno; ?>">
            <?php  echo form_error('apellido_paterno'); ?>
          </div>
          <div class="form-group">
            <label>Apellido Materno *</label>
            <input type="text" class="form-control" name="apellido_materno" value="<?php echo $person->apellido_materno; ?>">
            <?php  echo form_error('apellido_materno'); ?>
             <br><h6 class="obligatorio">* Campos obligatorios</h6>
          </div>
          <input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
          <input type="submit" name="upd_alumno" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

  <!-- Modal para eliminar alumno -->
<div class="modal fade" id="modal_del_alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar el alumno?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <br>
          <div class="modal-body text-left obligatorio2" >El alumno se eliminará de la lista</div>   
               <form action="<?php echo base_url() ?>professor/delete_student" method="post">
        	<input type="hidden" name="eli" id="elim">
          <input type="hidden" name="grupo" id="grup">
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="del_alumno" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
function elimina_alumno(id,grupo)
{
  $('#elim').val(id);
  $('#grup').val(grupo);
}
</script>