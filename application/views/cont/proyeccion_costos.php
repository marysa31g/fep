<div class="container">
	<?php
	    if($this->session->flashdata('flash'))
	      echo $this->session->flashdata('flash');
	 ?>
   <br><br>
	 <table class="table table-responsive-md table-bordered">
			<thead class="text-center">
				<tr>
					<th class="text-center" colspan="100%">Memoria de Costos Administrativos, Ventas y Otros</th>
				</tr>
				<tr>
           

					<th scope="col">Concepto <a  data-toggle="modal" href="#" data-target="#modal_add_concepto" class="icon-plus" title="Agregar Nuevo Concepto a Memoria de Costos"></a></th>
					<th scope="col">Unidad de Medida</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Costo Unitario</th>
          <th scope="col">Frecuencia</th>
					<th scope="col">Costo Mensual</th>
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($conceptos as $con) {
      ?>
				<tr>
					<td scope="col"><?php echo $con->concepto;?></td>
					<td scope="col"><?php echo $con->unidad_medida;?></td>
					<td scope="col"><?php echo $con->cantidad;?></td>
          <td scope="col">$ <?php echo $con->costo_unitario;?></td>
					<td scope="col"><?php echo $con->frecuencia;?></td>
					<td scope="col">$ <?php echo $con->costo_mensual;?></td>
					<td colspan="2">
            <a title="Editar Concepto de Memoria  de Costos" href="<?php echo base_url();?>projection_costs/update_concept/<?php echo $con->id;?>" )"   class="icon-refresh"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a title="Eliminar Concepto de Memoria de Costos" data-toggle="modal" data-target="#modal_del_concepto" onclick="elimina(<?php echo $con->id?>)" class="icon-trash"></a></td>
				</tr>
			<?php }?>
			</tbody>
		</table>
    <br>

    <!--Tabla de proyeccion de costos-->
   <table class="table table-responsive-md table-bordered">
      <thead class="text-center">
        <tr>
          <th class="text-center" colspan="100%">Proyección de Costos</th>
        </tr>
        <tr>
          <th scope="col">Concepto <a data-toggle="modal" data-target="#modal_add_concepto" class="icon-plus" title="Agregar un concepto"></a></th>
          <th scope="col">Costo/Mes</th>
          <th scope="col">1 Año</th>
          <th scope="col">2 Años</th>
          <th scope="col">3 Años</th>
          <th scope="col">4 Años</th>
          <th scope="col">5 Años</th>
          <!--th scope="col" colspan="2">acciones</th-->
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($categorias as $cat) {
        ?>
          <tr>
            <td scope="col"><?php echo $cat->nombre;?></td>
            <td scope="col">$ <?php echo $cat->subtotal;?></td>
            <td>$ <?php $aux=$cat->subtotal*12; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
          </tr>
        <?php }?>
        <?php
          foreach ($conceptos as $con) {
        ?>
          <tr>
            <td scope="col"><?php echo $con->concepto;?></td>
            <td scope="col">$ <?php echo $con->costo_mensual;?></td>
            <td>$ <?php $aux=$con->costo_mensual*12; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
            <td>$ <?php $aux=$aux*1.05; echo $aux?></td>
          </tr>
        <?php }?>
      </tbody>
    </table>
</div>

<!----------------------------- Conceptos ----------------------------->
<!--Modal para agregar un concepto-->
<div class="modal fade" id="modal_add_concepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Concepto a Memoria Costos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>projection_costs/insert_concept">
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
      			<label>Cantidad *</label>
      			<input class="form-control" type="text" name="cantidad" value="<?php echo set_value('cantidad'); ?>">
      			<?php echo form_error('cantidad'); ?>
      		</div>
          <div class="form-group">
            <label>Costo Unitario *</label>
            <input class="form-control" type="text" name="costo_unitario" value="<?php echo set_value('costo_unitario'); ?>">
            <?php echo form_error('costo_unitario'); ?>
          </div>
          <div class="form-group">
            <label>Frecuencia *</label>
            <input class="form-control" type="text" name="frecuencia" value="<?php echo set_value('frecuencia'); ?>">
            <?php echo form_error('frecuencia'); ?>
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
        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro  que desea eliminar el concepto de la memoria costos administrativa?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center"></h3>
        <br>
        <div class="modal-body text-left obligatorio2">El concepto de la memoria costos administrativa se eliminará</div>
        <form action="<?php echo base_url() ?>projection_costs/delete_concept" method="post">
        	<input type="hidden" name="eli" id="elim">
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Concepto de Memoria Costos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>projection_costs/update_concept/<?php echo $cpto->id?>">
      		<div class="form-group">
      			<label>Concepto *</label>
      			<input class="form-control" type="text" name="concepto_upd" value="<?php echo set_value('concepto_upd'); echo $cpto->concepto;?>"/>
      			<?php echo form_error('concepto_upd'); ?>
      		</div>
      		<div class="form-group">
      			<label>Unidad de Medida (U/M) *</label>
      			<input class="form-control" type="text" name="unidad_medida_upd" value="<?php echo set_value('unidad_medida_upd'); echo $cpto->unidad_medida;?>">
      			<?php echo form_error('unidad_medida_upd'); ?>
      		</div>
      		<div class="form-group">
      			<label>Cantidad *</label>
      			<input class="form-control" type="text" name="cantidad_upd" value="<?php echo set_value('cantidad_upd'); echo $cpto->cantidad;?>">
      			<?php echo form_error('cantidad_upd');?>
      		</div>
          <div class="form-group">
            <label>Costo Unitario *</label>
            <input class="form-control" type="text" name="costo_unitario_upd" value="<?php echo set_value('costo_unitario_upd'); echo $cpto->costo_unitario;?>">
            <?php echo form_error('costo_unitario_upd'); ?>
          </div>
          <div class="form-group">
            <label>Frecuencia *</label>
            <input class="form-control" type="text" name="frecuencia_upd" value="<?php echo set_value('frecuencia_upd'); echo $cpto->frecuencia;?>">
            <?php echo form_error('frecuencia_upd'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
          </div>
            <input type="reset" class="btn btn-secondary col-4 offset-1"  data-dismiss="modal" value="Cancelar">
      		<input type="submit" class="btn btn-boton col-4 offset-2" name="upd_cpto" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    if(<?php echo $bandera_ins; ?>)
    $('#modal_add_concepto').modal("show");
    if(<?php echo $bandera_upd; ?>)
    $('#modal_upd_concepto').modal("show");
  });
</script>

<script type="text/javascript">
  
function elimina(id)
{
  $('#elim').val(id);
}
</script>