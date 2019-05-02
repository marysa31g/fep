<div class="container">
	<?php
    if($this->session->flashdata('flash'))
      echo $this->session->flashdata('flash');
	?>
	 <?php if ($precios) {?> <br><br>
	 	<table class="table table-responsive-md table-bordered">

		<thead class="text-center">
			<tr>
				<th colspan="100%" class="text-center">Proyección de Ingresos Totales</th>
			</tr>
			<tr>
				<?php 
				//Ingresos por venta	Volumen Anual Kg	Precio de Venta	Año 1	Año 2	Año 3	Año 4	Año 5
				 ?>

				<th  scope="col">Ingresos por Venta</th>
				<th scope="col">Volumen Anual Kg</th>
				<th title="Editar Precio de Producción" scope="col">Precio de Venta<a href="<?php echo base_url();?>income/update_prices/<?php echo $precios->id; ?>" class="icon-refresh"></a></th>
				<th scope="col">Año 1</th>
				<th scope="col">Año 2</th>
				<th scope="col">Año 3</th>
				<th scope="col" colspan="">Año 4</th>
				<th colspan="2">Año 5</th>
			</tr>
		</thead>
		<tbody>
			<?php 
					$produccion_esperada=$pt->plantas_modulo*$pt->rendimiento;
					$mermas=$produccion_esperada*($porcentajes[0]->mermas/100);
					$produccion_real=$produccion_esperada-$mermas;
					$produccion_ciclo_p1=$produccion_real*($porcentajes[0]->primera/100);
					$produccion_ciclo_p2=$produccion_real*($porcentajes[1]->primera/100);

					$produccion_ciclo_s1=$produccion_real*($porcentajes[0]->segunda/100);
					$produccion_ciclo_s2=$produccion_real*($porcentajes[1]->segunda/100);

					$produccion_ciclo_t1=$produccion_real*($porcentajes[0]->tercera/100);
					$produccion_ciclo_t2=$produccion_real*($porcentajes[1]->tercera/100);
				?>
			<tr>
				<td>Jitomate de 1a Calidad</td>
				<th scope="col"><?php echo $vol_p=$produccion_ciclo_p1+$produccion_ciclo_p2;?></th>
				<td scope="col" class="text-right">$ <?php echo $precios->primera ?></td>
				<td><?php echo $aux= $vol_p*$precios->primera?></td>
				<?php for ($i=0; $i < 4 ; $i++) { ?>
					<td scope="col"><?php echo $aux= $aux*(1+($pt->inflacion/100))?></td>
				<?php } ?>
			</tr>
			<tr>
				<td>Jitomate de 2a Calidad</td>
				<th scope="col"><?php echo $vol_s=$produccion_ciclo_s1+$produccion_ciclo_s2; ?></th>
				<td scope="col" class="text-right">$ <?php echo $precios->segunda ?></td>
				<td><?php echo $aux= $vol_s*$precios->segunda?></td>
				<?php for ($i=0; $i < 4 ; $i++) { ?>
					<td scope="col"><?php echo $aux= $aux*(1+($pt->inflacion/100))?></td>
				<?php } ?>
			</tr>
			<tr>
				<td>Jitomate de 3a Calidad</td>
				<th scope="col"><?php echo $vol_t=$produccion_ciclo_t1+$produccion_ciclo_t2; ?></th>
				<td scope="col" class="text-right">$ <?php echo $precios->tercera ?></td>
				<td><?php echo $aux= $vol_t*$precios->tercera?></td>
				<?php for ($i=0; $i < 4 ; $i++) { ?>
					<td scope="col"><?php echo $aux= $aux*(1+($pt->inflacion/100))?></td>
				<?php } ?>
			</tr>
		</tbody>
	</table>
	 <?php } else { ?>
	 	<span class="btn btn-boton " data-toggle="modal" data-target="#modal_add_price">Agregar Precios</span>
<?php } ?>
</div>
<!--Modal para agregar precios-->
<div class="modal fade" id="modal_add_price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Precios de Calidad por Kilo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>income/insert_prices">
      		<div class="form-group">
      			<input class="form-control" type="hidden" name="identificador" id="identificador" placeholder="identificador" />
      		</div>
      		<div class="form-group">
      			<input class="form-control" type="hidden" name="ciclo" id="ciclo" placeholder="ciclo" />
      		</div>
      		<div class="form-group">
      			<label>Precio de 1a. Calidad:</label>
      			<input class="form-control" type="text" name="primera" value="<?php echo set_value('primera'); ?>"/>
      			<?php echo form_error('primera'); ?>
      		</div>
      		<div class="form-group">
      			<label>Precio de 2a. Calidad:</label>
      			<input class="form-control" type="text" name="segunda" value="<?php echo set_value('segunda'); ?>"/>
      			<?php echo form_error('segunda'); ?>
      		</div>
      		<div class="form-group">
      			<label>Precio de 3a. Calidad:</label>
      			<input class="form-control" type="text" name="tercera" value="<?php echo set_value('tercera'); ?>"/>
      			<?php echo form_error('tercera'); ?>
      		</div>
      		<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="add_price" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--Modal para modificar precios-->
<?php if ($precios) {?>
<div class="modal fade" id="modal_upd_price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Precio de Producción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>income/update_prices/<?php echo $precios->id?>">
      		<div class="form-group">
      			<input class="form-control" type="hidden" name="identificador" id="identificador" placeholder="identificador" />
      		</div>
      		<div class="form-group">
      			<input class="form-control" type="hidden" name="ciclo" id="ciclo" placeholder="ciclo" />
      		</div>
      		<div class="form-group">
      			<label>Precio de 1a. Calidad *</label>
      			<input class="form-control" type="text" name="primera" value="<?php echo $precios->primera;?>"/>
      			<?php echo form_error('primera'); ?>
      		</div>
      		<div class="form-group">
      			<label>Precio de 2a. Calidad *</label>
      			<input class="form-control" type="text" name="segunda" value="<?php echo $precios->segunda;?>"/>
      			<?php echo form_error('segunda'); ?>
      		</div>
      		<div class="form-group">
      			<label>Precio de 3a. Calidad *</label>
      			<input class="form-control" type="text" name="tercera" value="<?php echo $precios->tercera;?>"/>
      			<?php echo form_error('tercera'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>
          <input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
      		<input type="submit" class="btn btn-boton col-4 offset-2" name="upd_price" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<?php } ?>