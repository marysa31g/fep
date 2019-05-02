<div class="container">
	<?php
	    if($this->session->flashdata('flash'))
	      echo $this->session->flashdata('flash');
	 ?> <br><br>
	 <table class="table table-responsive-md table-bordered">
			<thead class="text-center">
				<tr>
					<th class="text-center" colspan="100%">Memoria de Costos</th>
				</tr>
				<tr>
					<th scope="col">Categoría <a data-toggle="modal" href="#" data-target="#modal_add_categoria" class="icon-plus" title="Agregar una Nueva Categoría"></a></th> <!--se agrega el icono mas concepto en class-->
					<th scope="col">Concepto <a data-toggle="modal"  href="#"data-target="#modal_add_concepto" class="icon-plus" title="Agregar un Nuevo Concepto de Memoria de Costo"></a></th> <!--se agrega el icono mas concepto en class-->
					<th scope="col">Unidad de Medida</th>
					<th scope="col">Volumen</th>
					<th scope="col">Costo Unitario</th>
					<th scope="col">Costo Total</th>
					<th  colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php $aux_cat=0; 
      if ($categorias) {
        $aux_sub =$categorias[0]->id_cat; 
       } $aux=-1;
				foreach ($categorias as $con) { $aux++; ?>
          <?php if ($aux_sub!=$con->id_cat) {?>
          <tr>
            <th scope="row" class="text-right">Subtotal</th>
            <td scope="col"></td>
            <td scope="col"></td>
            <td scope="col"></td>
            <td scope="col"></td> 
            <th scope="col" class="text-right">$ <?php echo $categorias[$aux-1]->subtotal;?></th>
            <td scope="col"></td>
            <td scope="col"></td>
          </tr>
        <?php $aux_sub = $con->id_cat; } ?>
          <?php if($aux_cat!=$con->id_cat){?>
            <tr>
              <th scope="row"><?php echo $con->categoria;?></th>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col"></td> 
              <td scope="col">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a data-toggle="modal" data-target="#modal_del_categoria" onclick="elimina_categoria(<?php echo $con->id_categoria?>)" class="icon-trash" title="Eliminar Categoría"></a></td>
            </tr>
          <?php $aux_cat=$con->id_cat; } ?>
				<tr>
					<td scope="col"></td>
					<td scope="col"><?php echo $con->nombre;?></td>
					<td scope="col"><?php echo $con->unidad_medida;?></td>
					<td scope="col"><?php echo $con->volumen;?></td>
					<td scope="col">$ <?php echo $con->costo_unitario;?></td>
					<td scope="col">$ <?php echo $con->total;?></td>
					<td scope="col"><a href="<?php echo base_url();?>memory_calc/update_concept_mc/<?php echo $con->id;?>" )" class="icon-refresh" title="Editar Concepto de Memoria de Costo"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<a title=" Eliminar Concepto de Memoria de Costos"  data-toggle="modal" data-target="#modal_del_concepto" onclick="elimina(<?php echo $con->id;?>)"  class="icon-trash"  ></a></td>
				</tr>
			<?php } ?>
      <tr>
            <th scope="row" class="text-right"> Subtotal</th>
            <td scope="col"></td>
            <td scope="col"></td>
            <td scope="col"></td>
            <td scope="col"></td> 
            <th scope="col">$ <?php if ($aux!=-1){
              echo $categorias[$aux]->subtotal;
            } ?></th>
            <td scope="col"></td>
          </tr>
			</tbody>
		</table>
</div>

<!----------------------------- Categorias ----------------------------->
<!--Modal para agregar una categoria-->
<div class="modal fade" id="modal_add_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar una Categoria a Memoria de Costos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>memory_calc/insert_category/<?php echo $proyecto->id?>">
      		<div class="form-group">
      			<label>Nombre de Categoria *</label>
      			<input class="form-control" type="text" name="categoria" value="<?php echo set_value('categoria'); ?>"/>
      			<?php echo form_error('categoria'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>
      		<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="add_categoria" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Modal para eliminar categoria -->
<div class="modal fade" id="modal_del_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de que desea eliminar la categoría de la memoria de costos?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div >
        <div class="modal-body text-left obligatorio2">
          La categoría de memoria de costos se eliminará de la lista
        </div>
        <form action="<?php echo base_url() ?>memory_calc/delete_mc" method="post">
        	<input type="hidden" name="eli" id="elim">
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="del_categoria" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!----------------------------- Conceptos ----------------------------->
<!--Modal para agregar un concepto-->
<div class="modal fade" id="modal_add_concepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Concepto a Memoria de Costo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>memory_calc/insert_concept_mc">
      		<div class="form-group">
      			<label>Categoria *</label>
      			<select  class="form-control" name="categoria">
      				<option value="Null" selected disabled>Elija Categoria *</option>
      				<?php foreach ($categoriasR as $cat) { ?>
      					<option value="<?php echo $cat->id; ?>"><?php echo $cat->nombre ?></option>  
      				<?php }  ?>
      			</select>
      			<?php echo form_error('categoria'); ?>
      		</div>
      		<div class="form-group">
      			<label>Concepto *</label>
      			<input class="form-control" type="text" name="concepto" value="<?php echo set_value('concepto'); ?>"/>
      			<?php echo form_error('concepto'); ?>
      		</div>
      		<div class="form-group">
      			<label>Unidad de Medida (U/M) *</label>
      			<input class="form-control" type="text" name="unidad_medida" value="<?php echo set_value('unidad_medida'); ?>">
      			<?php echo form_error('unidad_medida'); ?>
      		</div>
      		<div class="form-group">
      			<label>Volumen *</label>
      			<input class="form-control" type="text" name="volumen" value="<?php echo set_value('volumen'); ?>">
      			<?php echo form_error('volumen'); ?>
      		</div>
      		<div class="form-group">
      			<label>Costo Unitario *</label>
      			<input class="form-control" type="text" name="costo_unitario" value="<?php echo set_value('costo_unitario'); ?>">
      			<?php echo form_error('costo_unitario'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>
      		<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="add_concepto" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Modal para eliminar concepto -->
<div class="modal fade" id="modal_del_concepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar el concepto de la memoria de costos?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <br>
        <div class="modal-body text-left obligatorio2">El concepto de memoria de costos se eliminará de la lista</div>
        <form action="<?php echo base_url() ?>memory_calc/delete_mc" method="post">
        	<input type="hidden" name="eli" id="elim_cpto">
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
        	<input type="submit" name="del_concepto" class="btn btn-boton col-4 offset-2" value="Aceptar">
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!--Modal para editar un concepto-->
<div class="modal fade" id="modal_upd_concepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Concepto de Memoria de Costo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>memory_calc/update_concept_mc/<?php echo $cpto->id?>">
      		<div class="form-group">
      			<label>Categoría *</label>
      			<select  class="form-control" name="categoria_udp">
      				<option value="0" selected disabled>Elija Categoría</option>
      				<?php foreach ($categoriasR as $cat) { ?>
      					<option value="<?php echo $cat->id;?>"><?php echo $cat->nombre;?></option>  
      				<?php } ?>
      			</select>
            <?php echo form_error('categoria_udp'); ?>
      		</div>
      		<div class="form-group">
      			<label>Concepto *</label>
      			<input class="form-control" type="text" name="concepto_udp" value="<?php echo set_value('concepto_udp'); echo $cpto->nombre;?>"/>
      			<?php echo form_error('concepto_udp'); ?>
      		</div>
      		<div class="form-group">
      			<label>Unidad de Medida (U/M) *</label>
      			<input class="form-control" type="text" name="unidad_medida_udp" value="<?php echo set_value('unidad_medida_udp'); echo $cpto->unidad_medida;?>">
      			<?php echo form_error('unidad_medida_udp'); ?>
      		</div>
      		<div class="form-group">
      			<label>Volumen *</label>
      			<input class="form-control" type="text" name="volumen_udp" value="<?php echo set_value('volumen_udp'); echo $cpto->volumen; ?>">
      			<?php echo form_error('volumen_udp'); ?>
      		</div>
      		<div class="form-group">
      			<label>Costo Unitario *</label>
      			<input class="form-control" $ type="text" name="costo_unitario_udp" value="<?php echo set_value('costo_unitario_udp'); echo $cpto->costo_unitario;?>"/>
      			<?php echo form_error('costo_unitario_udp'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>
          <input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
      		<input type="submit" class="btn btn-boton col-4 offset-2" name="upd_cpto" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  
function elimina_categoria(id)
{
  $('#elim').val(id);
}
function elimina(id)
{
  $('#elim_cpto').val(id);
}
</script>