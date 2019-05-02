<div class="container">
	<?php if($parametros) {?><br><br>
		<table class="table table-responsive-md table-bordered">
			<thead class="text-center">
				<tr>
					<th class="text-center" >Producción</th>
					<th colspan="10"><div class="text-center">Ciclos</div></th>
				</tr>
				<tr>
					<th>Conceptos</th>
					<?php for ($i=0; $i < 10; $i++) {?>
						<th><?php echo $i+1?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<!--Area de produccion-->
				<tr>
					<th>Capacidad Instalada(m<sup>2</sup>)</th>	
				</tr>
				<tr>
					<td>Superficie Total Modular</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->area?></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Modulos</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->modulos?></td>	
					<?php } ?>		
				</tr>
				<tr>
					<td>Superficie</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php $aux=$parametros->area* $parametros->modulos; echo $aux;?></td>
					<?php } ?>				
				</tr>
				<!--Capacidad de produccion-->
				<tr>
					<th>Inventarios de Producción</th>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td> </td>	
					<?php } ?>			
				</tr>
				<tr>
					<td>Invernadero(s) Módulo(s)</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->modulos?></td>
					<?php } ?>			
				</tr>
				<tr>
					<td>Sistemas de Riego</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->riego?></td>	
					<?php } ?>			
				</tr>
				<tr>
					<td>Sistemas de Calefacción</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->calefaccion?></td>
					<?php } ?>				
				</tr>
				<tr>
					<td>Superficie con Cultivo m<sup>2</sup></td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $aux;?></td>		
					<?php } ?>		
				</tr>
				<!--indicadores de produccion-->
				<tr>
					<th>Indicadores Productivos</th>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td> </td>	
					<?php } ?>		
				</tr>
				<tr>
					<td>Área Libre para Cultivo</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->area?></td>	
					<?php } ?>			
				</tr>
				<tr>
					<td>No. de Plantas por Metro Cuadrado</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->plantas_metro?></td>
					<?php } ?>				
				</tr>
				<tr>
					<td>No. de Plantas por Superficie Total</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->plantas_modulo?></td>	
					<?php } ?>			
				</tr>
				<tr>
					<td>Plantas en Módulo m<sup>2</sup></td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->plantas_modulo?></td>	
					<?php } ?>			
				</tr>
			</tbody>
		</table>
		<!--Tabla de porcentajes de producción-->
		<table class="table table-responsive-md table-bordered">
			<thead class="text-center" >
				<tr>
					<th>Porcentajes de Producción</th>
					<th colspan="10"><div class="text-center">Ciclos</div></th>
				</tr>
				<tr>
					<th>Conceptos</th>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<th title="Editar Porcentaje de Producción"><?php echo $i+1; $i++;?> <a href="<?php echo base_url()?>production/upd_percentage/<?php echo $porcentaje->id;?>"class="icon-refresh" ></a></th>

						
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<!--Area de produccion-->
				<tr>
					<td>Rendimiento por Planta</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->rendimiento?></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 1a. Calidad (%)</td>
					<?php foreach ($porcentajes as $porcentaje) {?>
						<td><?php echo $porcentaje->primera;?></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 2a. Calidad (%)</td>
					<?php foreach ($porcentajes as $porcentaje) {?>
						<td><?php echo $porcentaje->segunda;?></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 3a. Calidad (%)</td>
					<?php foreach ($porcentajes as $porcentaje) {?>
						<td><?php echo $porcentaje->tercera;?></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Mermas (%)</td>
					<?php foreach ($porcentajes as $porcentaje) {?>
						<td><?php echo $porcentaje->mermas;?></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Ciclos por Año</td>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td><?php echo $parametros->ciclos?></td>
					<?php } ?>
				</tr>
				<tr>
					<th>Producción(Kgs)</th>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td> </td>
					<?php } ?>
				</tr>
				<tr>
					<td>Total</td>
					<?php foreach ($porcentajes as $porcentaje) {?>
						<td><?php $aux=$parametros->rendimiento*$parametros->plantas_modulo; echo $aux;?></td>	
					<?php } ?>
				</tr>
				<tr>
					<td>Mermas</td>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<td><?php $aux_merma[$i]=$aux*($porcentaje->mermas/100); echo $aux_merma[$i]; $i++;?></td>	
					<?php } ?>
				</tr>
				<thead class="thead-light">
				<tr>
					<th>Produccion Real</th>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<th><?php $aux_total[$i]=$aux-$aux_merma[$i]; echo $aux_total[$i];$i++;?></th>	
					<?php } ?>
				</tr>
				</thead>
				<tr>
					<th>Produccion por Calidad(Kgs)</th>
					<?php for ($i=0; $i < 10; $i++) {?>
						<td> </td>
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 1a Calidad</td>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<td><?php $aux_cal1[$i]=$aux_total[$i]*($porcentaje->primera/100); echo $aux_cal1[$i]; $i++;?></td>	
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 2a Calidad</td>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<td><?php $aux_cal2[$i]=$aux_total[$i]*($porcentaje->segunda/100); echo $aux_cal2[$i]; $i++;?></td>	
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 3a Calidad</td>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<td><?php $aux_cal3[$i]=$aux_total[$i]*($porcentaje->tercera/100); echo $aux_cal3[$i]; $i++;?></td>	
					<?php } ?>
				</tr>
				<thead class="thead-light">
				<tr>
					<th class="text-right">Total</th>
					<?php $i=0; foreach ($porcentajes as $porcentaje) {?>
						<th><?php $aux_totalf[$i]=$aux_cal1[$i]+$aux_cal2[$i]+$aux_cal3[$i]; echo $aux_totalf[$i];$i++;?></th>	
					<?php } ?>
				</tr>
				</thead>
			</tbody>
		</table>
		<!--Tabla de años de producción-->
		<table class="table table-responsive-md table-bordered">
			<thead class="text-center">
				<tr>
					<th>Años de Producción</th>
					<th colspan="10"><div class="text-center">Años</div></th>
				</tr>
				<tr>
					<th>Conceptos</th>
					<?php for ($i=0; $i < 5; $i++) { ?>
						<th><?php echo $i+1?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Producción por Calidad (Kgs)</th>
					<?php for ($i=0; $i < 5; $i++) { ?>
						<td> </td>
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 1a Calidad</td>
					<?php $j=1; for ($i=0; $i < 5; $i++) { ?>
						<td><?php $aux_anual1[$i]=$aux_cal1[$j-1]+$aux_cal1[$j]; echo $aux_anual1[$i]; $j=$j+2;?></td>	
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 2a Calidad</td>
					<?php $j=1; for ($i=0; $i < 5; $i++) { ?>
						<td><?php $aux_anual2[$i]=$aux_cal2[$j-1]+$aux_cal2[$j]; echo $aux_anual2[$i]; $j=$j+2;?></td>	
					<?php } ?>
				</tr>
				<tr>
					<td>Producción de 3a Calidad</td>
					<?php $j=1; for ($i=0; $i < 5; $i++) { ?>
						<td><?php $aux_anual3[$i]=$aux_cal3[$j-1]+$aux_cal3[$j]; echo $aux_anual3[$i]; $j=$j+2;?></td>	
					<?php } ?>
				</tr>
				<thead class="thead-light">
				<tr>
					<th>Total</th>
					<?php for ($i=0; $i < 5; $i++) { ?>
						<th><?php echo ($aux_anual1[$i]+$aux_anual2[$i]+$aux_anual3[$i]);?></th>	
					<?php } ?>
				</tr>
				</thead>
			</tbody>
		</table>
	<?php }else{?>
		<h3>Porfavor Rellena los Parámetros Técnicos</h3>
	<?php }?>
</div>
<?php if ($porciento) {?>
<!--Modal para modificar porcentajes del ciclo-->
<div class="modal fade" id="modal_upd_porcentaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Porcentaje de Producción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>production/upd_percentage/<?php echo $porciento->id?>">
      		<div class="form-group">
      			<input class="form-control" type="hidden" name="identificador" id="identificador" placeholder="identificador" />
      		</div>
      		<div class="form-group">
      			<input class="form-control" type="hidden" name="ciclo" id="ciclo" placeholder="ciclo" />
      		</div>
      		<div class="form-group">
      			<label>Porcentaje de 1a. Calidad *</label>
      			<input class="form-control" type="text" name="primera" value="<?php echo $porciento->primera; ?>"/>
      			<?php echo form_error('primera'); ?>
      		</div>
      		<div class="form-group">
      			<label>Porcentaje de 2a. Calidad *</label>
      			<input class="form-control" type="text" name="segunda" value="<?php echo $porciento->segunda; ?>"/>
      			<?php echo form_error('segunda'); ?>
      		</div>
      		<div class="form-group">
      			<label>Porcentaje de 3a. Calidad *</label>
      			<input class="form-control" type="text" name="tercera" value="<?php echo $porciento->tercera; ?>"/>
      			<?php echo form_error('tercera'); ?>
      		</div>
      		<div class="form-group">
      			<label>Porcentaje de Mermas *</label>
      			<input class="form-control" type="text" name="mermas" value="<?php echo $porciento->mermas; ?>"/>
      			<?php echo form_error('mermas'); ?>
      			<br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>
      		<input type="submit" class="btn btn-boton col-6 offset-3" name="upd_percentage" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<?php }?>

<!--
<script type="text/javascript">
  
function seleccion(id,ciclo)
{
  $('#identificador').val(id);
  $('#ciclo').val(ciclo);
}
</script> -->