<script type="text/javascript">
  function elimina(id)
  {
    $('#elim').val(id);
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    if(<?php echo $bandera_ins; ?>)
    $('#modal_add_grupo').modal("show");
  });
</script>
<div class="container">
	<?php  
    if($this->session->flashdata('flash'))
        echo $this->session->flashdata('flash');
  ?>
	<table class="table table-striped table-hover table-bordered table-responsive-lg ">
		<thead class="text-center">
			<tr class="text-center">
				<th colspan="100%">Lista de Grupos <a href="#" data-toggle="modal" data-target="#modal_add_grupo" class="icono" style="float:right;" title="Agregar un Grupo"><span class="icon-plus"></span></a></th>
			</tr>
			<tr>
				<th>Número</th>
				<th>Grupo</th>
				<th>Opciones de Grupo</th>
				<th>Opciones de Proyecto</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($grupos as $grupo) {$i++;?>
				<tr>
					<th><?php echo $i?></th>
					<td><?php echo $grupo->grupo;?></td>
					<td class="text-center">
						<span class="icon-trash" title="Eliminar Grupo" data-toggle="modal" data-target="#modal_del_grupo" onclick="elimina(<?php echo $grupo->grupo?>)"></span>
						  <a class="icon-views" title="Ver Alumnos del Grupo"  href="<?php echo base_url();?>professor/list_group/<?php echo $grupo->grupo;?>" ></a>
					</td>
					<td class="text-center">
             <a class="icon-views" title="Ver Proyectos del Grupo" href="<?php echo base_url();?>professor/list_project/<?php echo $grupo->grupo;?>"></a></td>
				</tr>
			<?php }?>
		</tbody>
	</table>
  <?php
      if(!$grupos) //condicion para ferificar que exista grupos del profesor en la BD
  {?>
    <div class="text-danger text-center">
      <span class="">No se han registrado grupos</span>
    </div>
  <?php
    }
  ?>
</div>
<script type="text/javascript">
  
function elimina_grupo(id,grupo)
{
  $('#elim').val(id);
  $('#grup').val(grupo);
}
</script>

<!-- modal prar agregar un grupo-->
<div class="modal fade" id="modal_add_grupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar un Grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <br>
        <form action="<?php echo base_url();?>professor/insert_group" method="post">
        	<div class="form-group">
        		<label>Grupo *</label>
        		<input type="text" class="form-control" name="grupo" value="<?php echo set_value('grupo'); ?>">
            <?php  echo form_error('grupo'); ?>
            <br><h6 class="obligatorio">* Campo obligatorio</h6>
        	</div>
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="add_group" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

 <!-- Modal para eliminar grupo -->
<div class="modal fade" id="modal_del_grupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar el grupo?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="modal-body text-left obligatorio2" >El grupo se eliminará de la lista</div>
        <form action="<?php echo base_url() ?>professor/delete_group" method="post">
        	<input type="hidden" name="eli" id="elim">
          <input type="hidden" name="grupo" id="grup">
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="del_grupo" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>