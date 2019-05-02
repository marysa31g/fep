<script type="text/javascript">
	$(document).ready(function(){
		if(<?php echo $bandera; ?>)
		$('#modal_add_concepto').modal("show");
		if(<?php echo $bandera_upd; ?>)
		$('#modal_upd_concepto').modal("show");
	});
</script>

<div class="container">
	<div style="height: 80px;"></div>
	<div class="col-md-10 offset-md-1">
		<table class="table table-responsive-md">
			<thead class="text-center" >
				<tr>
					<th colspan="7"></th>
					<th class="text-center"><a data-toggle="modal" data-target="#modal_add_concepto" class="add icon-add" title="Agregar un concepto">(+)</a></th>
				</tr>
				<tr>
					<th scope="col">Categoria</th>
					<th scope="col">Concepto</th>
					<th scope="col">Unidad de Medida</th>
					<th scope="col">Volumen</th>
					<th scope="col">Costo Unitario</th>
					<th scope="col">Costo Total</th>
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Agroquimícos<?php // $fila->?></th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td> 
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<?php  $aux_agro=0; foreach ($agroquimicos as $agro) { ?>
				<tr>
					<td scope="col"></td>
					<td scope="col"><?php echo $agro->nombre;?></td>
					<td scope="col"><?php echo $agro->unidad_medida;?></td>
					<td scope="col"><?php echo $agro->volumen;?></td>
					<td scope="col">$ <?php echo $agro->costo_unitario;?></td>
					<td scope="col">$ <?php echo $agro->total;?></td>
					<td scope="col"><a href="<?php echo base_url();?>memory_calc/update_concept_mc/<?php echo $agro->id;?>" )">edit</a></td>
					<td scope="col"><a data-toggle="modal" data-target="#modal_del_concepto" onclick="elimina(<?= $agro->id?>)">elim</a></td>
				</tr>
				<?php $aux_agro=$aux_agro+$agro->total;} ?>
				<tr>
					<td scope="col"></td>
					<th scope="row">Subtotal</th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col">$ <?php echo $aux_agro;?></td>
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<tr>
					<th scope="row">Fertilizantes<?php // $fila->?></th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>					
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<?php  $aux_fer=0; foreach ($fertilizantes as $agro) { ?>
				<tr>
					<td scope="col"></td>
					<td scope="col"><?php echo $agro->nombre;?></td>
					<td scope="col"><?php echo $agro->unidad_medida;?></td>
					<td scope="col"><?php echo $agro->volumen;?></td>
					<td scope="col">$ <?php echo $agro->costo_unitario;?></td>
					<td scope="col">$ <?php echo $agro->total;?></td>
					<td scope="col"><a href="<?php echo base_url();?>memory_calc/update_concept_mc/<?php echo $agro->id;?>" )">edit</a></td>
					<td scope="col"><a data-toggle="modal" data-target="#modal_del_concepto" onclick="elimina(<?= $agro->id?>)">elim</a></td>
				</tr>
				<?php $aux_fer=$aux_fer+$agro->total;} ?>
				<tr>
					<td scope="col"></td>
					<th scope="row">Subtotal</th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col">$ <?php echo $aux_fer;?></td>
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<tr>
					<th scope="row">Preparación Terreno y Siembra<?php // $fila->?></th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<?php  $aux_prepa=0; foreach ($preparacion as $agro) { ?>
				<tr>
					<td scope="col"></td>
					<td scope="col"><?php echo $agro->nombre;?></td>
					<td scope="col"><?php echo $agro->unidad_medida;?></td>
					<td scope="col"><?php echo $agro->volumen;?></td>
					<td scope="col">$ <?php echo $agro->costo_unitario;?></td>
					<td scope="col">$ <?php echo $agro->total;?></td>
					<td scope="col"><a href="<?php echo base_url();?>memory_calc/update_concept_mc/<?php echo $agro->id;?>" )">edit</a></td>
					<td scope="col"><a data-toggle="modal" data-target="#modal_del_concepto" onclick="elimina(<?= $agro->id?>)">elim</a></td>
				</tr>
				<?php $aux_prepa=$aux_prepa+$agro->total;} ?>
				<tr>
					<td scope="col"></td>
					<th scope="row">Subtotal</th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col">$ <?php echo $aux_prepa;?></td>
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<tr>
					<th scope="row">Mano de Obra<?php // $fila->?></th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<?php  $aux_mano=0; foreach ($mano as $agro) { ?>
				<tr>
					<td scope="col"></td>
					<td scope="col"><?php echo $agro->nombre;?></td>
					<td scope="col"><?php echo $agro->unidad_medida;?></td>
					<td scope="col"><?php echo $agro->volumen;?></td>
					<td scope="col">$ <?php echo $agro->costo_unitario;?></td>
					<td scope="col">$ <?php echo $agro->total;?></td>
					<td scope="col"><a href="<?php echo base_url();?>memory_calc/update_concept_mc/<?php echo $agro->id;?>" )">edit</a></td>
					<td scope="col"><a data-toggle="modal" data-target="#modal_del_concepto" onclick="elimina(<?= $agro->id?>)">elim</a></td>
				</tr>
				<?php $aux_mano=$aux_mano+$agro->total;} ?>
				<tr>
					<td scope="col"></td>
					<th scope="row">Subtotal</th>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col">$ <?php echo $aux_mano;?></td>
					<td scope="col"></td>
					<td scope="col"></td>
				</tr>
				<tr>
					<td scope="col"></td>	
					<td scope="col"></td>
					<td scope="col"></td>
					<td scope="col"></td>
					<th>Total</th>	
					<td scope="col">$ <?php echo $aux_agro+$aux_fer+$aux_prepa+$aux_mano; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


<!--Modal para agregar un concepto-->
<div class="modal fade" id="modal_add_concepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Concepto a Memoria de Costos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>memory_calc/add_cmc">
      		<div class="form-group">
      			<label>Categoria:</label>
      			<select  class="form-control" name="categoria">
      				<option value="Null" selected disabled>Elija Categoria</option>
      				<?php foreach ($categorias as $cat) { ?>
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
      			<input class="form-control" $ type="text" name="costo_unitario" value="<?php echo set_value('costo_unitario'); ?>">
      			<?php$  echo form_error('costo_unitario'); ?>
      		</div>
      		<div class="form-group disabled">
      			<label>Costo Total *</label>
      			<input class="form-control " type="text" name="costo_total" disabled>
      		</div>
      		<input type="submit" class="btn btn-primary" name="add_concepto" value="Agregar">
      		<input type="reset" class="btn btn-secondary" data-dismiss="modal" value="Cancelar">
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
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Concepto de Memoria de Costos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center">¿Esta seguro de querer eliminar el concepto de la memoria de costos?</h3>
        <br>
        <p class="text-right text-muted obligatorio2">Tenga en cuenta que se eliminara para siempre</p>
        <form action="<?php echo base_url() ?>memory_calc/del_cmc" method="post">
        	<input type="hidden" name="eli" id="elim">
        	<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="No">
        	<input type="submit" name="del_concepto" class="btn btn-primary col-4 offset-2" value="Si">
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
        <h5 class="modal-title" id="exampleModalLabel">Modificar Concepto de Memoria de Costos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>memory_calc/update_concept_mc/<?php echo $cpto->id?>">
      		<div class="form-group">
      			<label>Categoria *</label>
      			<select  class="form-control" name="categoria_udp">
      				<option value="0" selected disabled>Elija Categoria *</option>
      				<?php foreach ($categorias as $cat) { ?>
      					<option value="<?php echo $cat->id;?>"><?php echo $cat->nombre ?></option>  
      				<?php }  ?>
      			</select>
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
      			<?php$  echo form_error('costo_unitario_udp'); ?>
      		</div>
      		<div class="form-group disabled">
      			<label>Costo Total:</label>
      			<input class="form-control " type="text" name="costo_total_udp" disabled>
      		</div>
      		<input type="submit" class="btn btn-primary" name="upd_cpto" value="Agregar">
      		<input type="reset" class="btn btn-secondary" data-dismiss="modal" value="Cancelar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
