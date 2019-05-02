<br>
<div class="col-sm-4 offset-4 card" style="padding-top: 20px; padding-bottom: 20px; padding-left: 30px; padding-right: 30px;">

  <?php  
    if($this->session->flashdata('flash'))
        echo $this->session->flashdata('flash');
  ?>
	<br>
	<?php if (!$pt) {?>
     <h2 class="text-center">Parámetros Técnicos</h2>
      <hr>
		
    <span>Área de Módulo</span>
      <div class="card "> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>

      <span>No. De Plantas por m<sup>2</sup></span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>

      <span>No. total de Plantas por Módulo</span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>
    
      <span>Rendimiento Esperado</span>      
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>
    
      <span>Número de Modulos</span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>
    
      <span>Número de Sistemas de Riego</span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>

      <span>Número de Sistemas de Calefacción</span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>

      <span>Número de Ciclos por Año</span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>

      <span>Porcentaje de Inflación</span>
      <div class="card"> 
        <div>
          <span class="card-body">0</span>
        </div>
      </div>
    <span class="btn btn-boton" style="margin-top: 20px;" data-toggle="modal" data-target="#modal_add_tec">Actualizar Información</span>
	 
	<?php } else { ?>
    <br>
    <h2 class="text-center">Parámetros Técnicos</h2>
    <hr>
		
      <span>Área de Módulo</span>
      <div class="card "> 
        <div>
          <span class="card-body"><?php echo $pt->area;?> m<sup>2</sup></span>
        </div>
      </div>

      <span>No. De Plantas por m<sup>2</sup></span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->plantas_metro;?></span>
        </div>
      </div>

      <span>No. Total de Plantas por Módulo</span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->plantas_modulo;?></span>
        </div>
      </div>
    
      <span>Rendimiento Esperado</span>      
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->rendimiento;?><?php echo $pt->um;?></span>
        </div>
      </div>
    
      <span>Número de Modulos</span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->modulos;?></span>
        </div>
      </div>
    
      <span>Número de Sistemas de Riego</span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->riego;?></span>
        </div>
      </div>

      <span>Número de Sistemas de Calefacción</span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->calefaccion;?></span>
        </div>
      </div>

      <span>Número de Ciclos por Año</span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->ciclos;?></span>
        </div>
      </div>

      <span>Porcentaje de Inflación</span>
      <div class="card"> 
        <div>
          <span class="card-body"><?php echo $pt->inflacion;?></span>
        </div>
      </div>
     <br><br>
    <span class="btn btn-boton"  style="margin-top: 20px;" data-toggle="modal" data-target="#modal_upd_tec">Actualizar Información</span>
		
	<?php } ?>
  <br>
</div>
<!---------------------------------------Modal para agregar parametros tecnicos------------------------------------------->
<div class="modal fade" id="modal_add_tec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Parámetros Técnicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url()?>technical_parameters/insert_parameters">
      		<div class="form-group">
      			<label>Área de Módulo *</label>
      			<input class="form-control" type="text" name="area" placeholder="Cantidad en Metros Cuadrados" value="<?php echo set_value('area'); ?>"/>
      			<?php echo form_error('area'); ?>
      		</div>
      		<div class="form-group">
      			<label>No. De Plantas por m<sup>2</sup> *</label>
      			<input class="form-control" type="text" name="plantas_metro" value="<?php echo set_value('plantas_metro'); ?>"/>
      			<?php echo form_error('plantas_metro'); ?>
      		</div>
      		<div class="form-group">
      			<label>Rendimiento Esperado *</label>
      			<input class="form-control" type="text" name="rendimiento" value="<?php echo set_value('rendimiento'); ?>"/>
      			<?php echo form_error('rendimiento'); ?>
      		</div>
      		<div class="form-group">
      			<label>Unidad de Medida *</label>
      			<input class="form-control" type="text" name="um" value="<?php echo set_value('um'); ?>"/>
      			<?php echo form_error('um'); ?>
      		</div>
          <div class="form-group">
            <label>Número de Modulos *</label>
            <input class="form-control" type="text" name="modulos" value="<?php echo set_value('modulos'); ?>"/>
            <?php echo form_error('modulos'); ?>
          </div>
          <div class="form-group">
            <label>Número de Sistemas de Riego *</label>
            <input class="form-control" type="text" name="riego" value="<?php echo set_value('riego'); ?>"/>
            <?php echo form_error('riego'); ?>
          </div>
          <div class="form-group">
            <label>Número de Sistemas de Calefacción *</label>
            <input class="form-control" type="text" name="calefaccion" value="<?php echo set_value('calefaccion'); ?>"/>
            <?php echo form_error('calefaccion'); ?>
          </div>
          <div class="form-group">
            <label>Número de Ciclos por Año *</label>
            <input class="form-control" type="text" name="ciclos" value="<?php echo set_value('ciclos'); ?>"/>
            <?php echo form_error('ciclos'); ?>
          </div>
          <div class="form-group">
            <label>Inflación *</label>
            <input class="form-control" type="text" name="inflacion" value="<?php echo set_value('inflacion'); ?>"/>
            <?php echo form_error('inflacion'); ?>
          </div>
      		<input type="reset" class="btn btn-secondary col-4 offset-1"  data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="add_parametros" value="Aceptar">
      	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!---------------------------------------Modal para modificar parametros tecnicos------------------------------------------->
<div class="modal fade" id="modal_upd_tec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Parámetros Técnicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php  if ($pt) {?>
      	<form method="post" action="<?php echo base_url()?>technical_parameters/update_parameters/<?php echo $pt->id;?>">
      		<div class="form-group">
      			<label>Área de Módulo *</label>
      			<input class="form-control" type="text" name="area" value="<?php echo $pt->area;?>"/>
      			<?php echo form_error('area'); ?>
      		</div>
      		<div class="form-group">
      			<label>No. De Plantas por m<sup>2</sup> *</label>
      			<input class="form-control" type="text" name="plantas_metro" value="<?php echo $pt->plantas_metro; ?>"/>
      			<?php echo form_error('plantas_metro'); ?>
      		</div>
      		<div class="form-group">
      			<label>Rendimiento Esperado *</label>
      			<input class="form-control" type="text" name="rendimiento" value="<?php echo $pt->rendimiento; ?>"/>
      			<?php echo form_error('rendimiento'); ?>
      		</div>
      		<div class="form-group">
      			<label>Unidad de Medida *</label>
      			<input class="form-control" type="text" name="um" value="<?php echo $pt->um;?>"/>
      			<?php echo form_error('um');?>
      		</div>
          <div class="form-group">
            <label>Número de Modulos *</label>
            <input class="form-control" type="text" name="modulos" value="<?php echo $pt->modulos;?>"/>
            <?php echo form_error('modulos');?>
          </div>
          <div class="form-group">
            <label>Número de Sistemas de Riego *</label>
            <input class="form-control" type="text" name="riego" value="<?php echo $pt->riego;?>"/>
            <?php echo form_error('riego');?>
          </div>
          <div class="form-group">
            <label>Número de Sistemas de Calefacción *</label>
            <input class="form-control" type="text" name="calefaccion" value="<?php echo $pt->calefaccion;?>"/>
            <?php echo form_error('calefaccion');?>
          </div>
          <div class="form-group">
            <label>Número de Ciclos por Año *</label>
            <input class="form-control" type="text" name="ciclos" value="<?php echo $pt->ciclos; ?>"/>
            <?php echo form_error('ciclos'); ?>
          </div>
           <div class="form-group">
            <label>Inflación *</label>
            <input class="form-control" type="text" name="inflacion" value="<?php echo $pt->inflacion; ?>"/>
            <?php echo form_error('inflacion'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
          </div>
          <input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
      		<input type="submit" class="btn btn-boton col-4 offset-1" name="upd_parametros" value="Aceptar">
      	</form>
      	<?php } ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>