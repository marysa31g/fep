<div class="container">
	<?php
    if($this->session->flashdata('flash'))
      echo $this->session->flashdata('flash');
	?>
  <?php //echo validation_errors(); ?>
<br><br>
	 <table class="table table-responsive-md table-bordered">

		<thead class="text-center" >
			<tr>
				<th colspan="100%" class="text-center">Presupuesto de Inversión</th>
			</tr>
			<tr>
				<th scope="col">Conceptos</th>
				<th scope="col">Unidad</th>
				<th>Cantidad</th>
				<th scope="col">Costo Unitario</th>
				<th scope="col">Montos</th>
				<th scope="col">Programas</th>
				<th scope="col">Socios</th>
				<th scope="col" colspan="">Total</th>
				<th colspan="2">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td colspan="10">
          <b>Activo Fijo
					<a data-toggle="modal" href="#"  href="#" data-target="#agregar_fijo" class="icono" title="Agregar Nuevo Concepto en Activo Fijo"><span class="icon-plus" ></span></a>
          </b>
				</td>
			</tr>
			
      <?php 
        $total_concepto = 0;
                
        $total_montos = 0;
        $total_programas = 0;
        $total_socios = 0;
        
        $total_socios_programas = 0;
        foreach ($fijo as $f) { 
      ?>
      <tr>
        <td scope="col"><?php echo $f->concepto; ?></td>
        <td scope="col"><?php echo $f->unidad; ?></td>
        <td scope="col"><?php echo $f->cantidad; ?></td>
        <td scope="col"><?php echo $f->costo_unitario; ?></td>
        <td scope="col"><?php echo $f->montos; ?></td>
        <td scope="col"><?php echo $f->programas; ?></td>
        <td scope="col"><?php echo $f->socios; ?></td>
        <?php $total_concepto = $f->programas + $f->socios; ?>
        <td scope="col"><?php echo $total_concepto;?></td>
       <td colspan="2"><a href="#" data-toggle="modal" data-target="#modificar_fijo<?=$f->id;?>" class="icon-refresh"title="  Editar Activo Fijo"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp    <a data-toggle="modal"  data-target="#eliminar_fijo<?php echo $f->id;?>" class="icon-trash" title="Eliminar Activo Fijo"></a></td> <!--se agrega la clase para el icono modificar-->

        <?php //modal modificar?>

        <div class="modal fade" id="modificar_fijo<?=$f->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Concepto</h5>
                <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <form action="<?php echo base_url();?>investment/update_concept/<?php echo $f->id;?>/1" method="post">

              <div class="modal-body">

                <div class="form-group">
                  <label for="tipo_activo<?=$f->id;?>">Tipo de Concepto *</label>
                  <select name="tipo_activo<?=$f->id;?>" class="form-control" id="tipo_activo<?=$f->id;?>">
                    <option value="0">Selecciona el Tipo</option>

                    <option value="1" <?php if ($f->id_activo === '1') echo "selected='selected'"; ?>>Activo Fijo</option>

                    <option value="2" <?php if ($f->id_activo === '2') echo "selected='selected'"; ?>>Activo Diferido</option>

                    <option value="3" <?php if ($f->id_activo === '3') echo "selected='selected'"; ?>>Capital de Trabajo</option>
                  </select>
                  <?php echo form_error("tipo_activo".$f->id); ?>
                </div>


                <div class="form-group">
                  <label>Concepto *</label>
                  <input class="form-control" type="text" name="concepto_u<?=$f->id;?>" value="<?php echo $f->concepto;?>"/>
                  <?php echo form_error("concepto_u".$f->id);?>
                </div>

                <div class="form-group">
                  <label>Unidad *</label>
                  <input class="form-control" type="text" name="unidad_u<?=$f->id;?>" value="<?php echo $f->unidad;?>"/>
                  <?php echo form_error("unidad_u".$f->id); ?>
                </div>

                <div class="form-group">
                  <label>Cantidad *</label>
                  <input class="form-control" type="text" name="cantidad_u<?=$f->id;?>" value="<?php echo $f->cantidad; /*echo set_value("cantidad_u{$f->id}");*/?>"/>
                  <?php echo form_error("cantidad_u".$f->id); ?>
                </div>

                <div class="form-group">
                  <label>Costo Unitario *</label>
                  <input class="form-control" type="text" name="costo_unitario_u<?=$f->id;?>" value="<?php echo $f->costo_unitario;?>"/>
                  <?php echo form_error("costo_unitario_u".$f->id); ?>
                </div>

                
                <div class="form-group">
                  <label>Programas *</label>
                  <input class="form-control" type="text" name="programas_u<?=$f->id;?>" value="<?php echo $f->programas; ?>"/>
                  <?php echo form_error("programas_u".$f->id); ?>
                </div>

                <div class="form-group">
                  <label>Socios *</label>
                  <input class="form-control" type="text" name="socios_u<?=$f->id;?>" value="<?php echo $f->socios;?>"/>
                  <?php echo form_error("socios_u".$f->id); ?>
                  <br><h6 class="obligatorio">* Campos obligatorios</h6>
                </div>



                <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">
                  Cancelar          
                </button>
                <input type="submit" name="modificar_concepto<?=$f->id;?>" value="Aceptar" class="btn btn-boton col-4 offset-2"/>
              </div>
            </form>

            </div>
          </div>
        </div>


        <?php //modal eliminar?>

        <div class="modal fade" id="eliminar_fijo<?=$f->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">¿Está seguro de eliminar el concepto?</h5>
                    <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <h5 class="alert obligatorio2">
                        Se eliminará el concepto <?php echo $f->concepto; ?>
                      </h5>
                    </div>
                  

                  
                    <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">
                    Cancelar
                    </button>
                    <a href="<?php echo base_url();?>investment/delete_concept/<?=$f->id;?>" class="btn btn-boton col-4 offset-2">Aceptar</a>
                  </div>
                </div>
              </div>
        </div>

      </tr>
      <?php 
          $total_montos = $total_montos + $f->montos;         
          $total_programas = $total_programas + $f->programas;
          $total_socios = $total_socios + $f->socios;

          $total_socios_programas = $total_socios_programas + $total_concepto;

        }
      ?>
			
			<tr>
				<td colspan="10">
					<b>Activo Diferido
					<a data-toggle="modal"  href="#" data-target="#agregar_diferido" class="icono" title=""><span class="icon-plus" title="Agregar Nuevo Concepto en Activo Diferido"></span></a>
					</b>
				</td>
			</tr>

			<?php foreach ($diferido as $d) { ?>
      <tr>
        <td scope="col"><?php echo $d->concepto; ?></td>
        <td scope="col"><?php echo $d->unidad; ?></td>
        <td scope="col"><?php echo $d->cantidad; ?></td>
        <td scope="col"><?php echo $d->costo_unitario; ?></td>
        <td scope="col"><?php echo $d->montos; ?></td>
        <td scope="col"><?php echo $d->programas; ?></td>
        <td scope="col"><?php echo $d->socios; ?></td>
        <?php $total_concepto = $d->programas + $d->socios; ?>
        <td scope="col"><?php echo $total_concepto;?></td>
        <td colspan="2"><a data-toggle="modal" href="#" data-target="#modificar_diferido<?=$d->id;?>" class="icon-refresh" title="Editar Activo Diferido"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a data-toggle="modal"  data-target="#eliminar_diferido<?=$d->id;?>" title="Eliminar Activo Diferido" class="icon-trash"></a></td>
        <!--Se agrega la clase para los iconos en la etiqueta a-->

        <?php //modal modificar?>

        <div class="modal fade" id="modificar_diferido<?=$d->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Concepto</h5>
                <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <form action="<?php echo base_url();?>investment/update_concept/<?php echo $d->id;?>/2" method="post">

              <div class="modal-body">

                <div class="form-group">
                  <label for="tipo_activo<?=$d->id;?>">Tipo de Concepto *</label>
                  <select name="tipo_activo<?=$d->id;?>" class="form-control" id="tipo_activo<?=$d->id;?>">
                    <option value="0">Selecciona el Tipo</option>

                    <option value="1" <?php if ($d->id_activo === '1') echo "selected='selected'"; ?>>Activo Fijo</option>

                    <option value="2" <?php if ($d->id_activo === '2') echo "selected='selected'"; ?>>Activo Diferido</option>

                    <option value="3" <?php if ($d->id_activo === '3') echo "selected='selected'"; ?>>Capital de Trabajo</option>
                  </select>
                  <?php echo form_error("tipo_activo".$d->id); ?>
                </div>

                <div class="form-group">
                  <label>Concepto *</label>
                  <input class="form-control" type="text" name="concepto_u<?=$d->id;?>" value="<?php echo $d->concepto;?>"/>
                  <?php echo form_error("concepto_u".$d->id); ?>
                </div>

                <div class="form-group">
                  <label>Unidad *</label>
                  <input class="form-control" type="text" name="unidad_u<?=$d->id;?>" value="<?php echo $d->unidad;?>"/>
                  <?php echo form_error("unidad_u".$d->id); ?>
                </div>

                <div class="form-group">
                  <label>Cantidad *</label>
                  <input class="form-control" type="text" name="cantidad_u<?=$d->id;?>" value="<?php echo $d->cantidad;?>"/>
                  <?php echo form_error("cantidad_u".$d->id); ?>
                </div>

                <div class="form-group">
                  <label>Costo Unitario *</label>
                  <input class="form-control" type="text" name="costo_unitario_u<?=$d->id;?>" value="<?php echo $d->costo_unitario;?>"/>
                  <?php echo form_error("costo_unitario_u".$d->id); ?>
                </div>

                
                <div class="form-group">
                  <label>Programas *</label>
                  <input class="form-control" type="text" name="programas_u<?=$d->id;?>" value="<?php echo $d->programas; ?>"/>
                  <?php echo form_error("programas_u".$d->id); ?>
                </div>

                <div class="form-group">
                  <label>Socios *</label>
                  <input class="form-control" type="text" name="socios_u<?=$d->id;?>" value="<?php echo $d->socios;?>"/>
                  <?php echo form_error("socios_u".$d->id); ?>
                  <br><h6 class="obligatorio">* Campos obligatorios</h6>
                </div>

             

                <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">
                  Cancelar          
                </button>
                <input type="submit" name="modificar_concepto<?=$d->id;?>" value="Aceptar" class="btn btn-boton col-4 offset-2" />
              </div>
            </form>

            </div>
          </div>
        </div>


        <?php //modal eliminar?>

        <div class="modal fade" id="eliminar_diferido<?=$d->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">¿Está seguro de eliminar el concepto?</h5>
                    <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <h5 class="alert obligatorio2">
                        Se eliminará el concepto <?php echo $d->concepto; ?>
                      </h5>
                    
                 


                    <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">
                    Cancelar
                    </button>
                    <a href="<?php echo base_url();?>investment/delete_concept/<?=$d->id;?>" class="btn btn-boton col-4 offset-2">Aceptar</a>
                  </div>
                </div>
              </div>
        </div>
      </tr>
      <?php 
          $total_montos = $total_montos + $d->montos;         
          $total_programas = $total_programas + $d->programas;
          $total_socios = $total_socios + $d->socios;

          $total_socios_programas = $total_socios_programas + $total_concepto;
        } 
      ?>
	
			<tr>
				<td colspan="10"><b>Capital de Trabajo
					<a data-toggle="modal" href="#" data-target="#agregar_capital" class="icono" title=""><span class="icon-plus" title="Agregar Nuevo Concepto en Capital de Trabajo"></span></a>
					</b>
				</td>
			</tr>
			
      <?php foreach ($capital as $c) { ?>
      <tr>
        <td scope="col"><?php echo $c->concepto; ?></td>
        <td scope="col"><?php echo $c->unidad; ?></td>
        <td scope="col"><?php echo $c->cantidad; ?></td>
        <td scope="col"><?php echo $c->costo_unitario; ?></td>
        <td scope="col"><?php echo $c->montos; ?></td>
        <td scope="col"><?php echo $c->programas; ?></td>
        <td scope="col"><?php echo $c->socios; ?></td>
        <?php $total_concepto = $c->programas + $c->socios; ?>
        <td scope="col"><?php echo $total_concepto;?></td>
        <td colspan="2"><a data-toggle="modal" href="#" data-target="#modificar_capital<?=$c->id;?>" class="icon-refresh" title="Editar Capital de Trabajo"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  <a data-toggle="modal"  data-target="#eliminar_capital<?=$c->id;?>" title="Eliminar Capital de Trabajo" class="icon-trash"></a></td>
        <!--se afrega la clase para el icono modifcar y eliminar-->
      </tr>
        <?php //modal modificar?>

        <div class="modal fade" id="modificar_capital<?=$c->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Concepto</h5>
                <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <form action="<?php echo base_url();?>investment/update_concept/<?php echo $c->id; ?>/3" method="post">

              <div class="modal-body">

                <div class="form-group">
                  <label for="tipo_activo<?=$c->id;?>">Tipo de Concepto *</label>
                  <select name="tipo_activo<?=$c->id;?>" class="form-control" id="tipo_activo<?=$c->id;?>">
                    <option value="0">Selecciona el Tipo</option>

                    <option value="1" <?php if ($c->id_activo === '1') echo "selected='selected'"; ?>>Activo fijo</option>

                    <option value="2" <?php if ($c->id_activo === '2') echo "selected='selected'"; ?>>Activo diferido</option>

                    <option value="3" <?php if ($c->id_activo === '3') echo "selected='selected'"; ?>>Capital de Trabajo</option>
                  </select>
                  <?php echo form_error("tipo_activo".$c->id); ?>
                </div>


                <div class="form-group">
                  <label>Concepto *</label>
                  <input class="form-control" type="text" name="concepto_u<?=$c->id;?>" value="<?php echo $c->concepto;?>"/>
                  <?php echo form_error("concepto_u".$c->id); ?>
                </div>

                <div class="form-group">
                  <label>Unidad *</label>
                  <input class="form-control" type="text" name="unidad_u<?=$c->id;?>" value="<?php echo $c->unidad;?>"/>
                  <?php echo form_error("unidad_u".$c->id); ?>
                </div>

                <div class="form-group">
                  <label>Cantidad *</label>
                  <input class="form-control" type="text" name="cantidad_u<?=$c->id;?>" value="<?php echo $c->cantidad;?>"/>
                  <?php echo form_error("cantidad_u".$c->id); ?>
                </div>

                <div class="form-group">
                  <label>Costo Unitario *</label>
                  <input class="form-control" type="text" name="costo_unitario_u<?=$c->id;?>" value="<?php echo $c->costo_unitario;?>"/>
                  <?php echo form_error("costo_unitario_u".$c->id); ?>
                </div>

                
                <div class="form-group">
                  <label>Programas *</label>
                  <input class="form-control" type="text" name="programas_u<?=$c->id;?>" value="<?php echo $c->programas; ?>"/>
                  <?php echo form_error("programas_u".$c->id); ?>
                </div>

                <div class="form-group">
                  <label>Socios *</label>
                  <input class="form-control" type="text" name="socios_u<?=$c->id;?>" value="<?php echo $c->socios;?>"/>
                  <?php echo form_error("socios_u".$c->id); ?>
                  <br><h6 class="obligatorio">* Campos obligatorios</h6>
                </div>

              

                <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">
                  Cancelar          
                </button>
                <input type="submit" name="modificar_concepto<?=$c->id;?>" value="Aceptar" class="btn btn-boton col-4 offset-2"/>
              </div>
            </form>

            </div>
          </div>
        </div>


        <?php //modal eliminar?>

        <div class="modal fade" id="eliminar_capital<?=$c->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">¿Está seguro de eliminar el concepto?</h5>
                    <button type="button" class="close block-button-submit" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <h5 class="alert obligatorio2">
                        Se eliminará el concepto <?php echo $c->concepto; ?>
                      </h5>
                    </div>
                  


                    <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">
                    Cancelar
                    </button>
                    <a href="<?php echo base_url();?>investment/delete_concept/<?=$c->id;?>" class="btn btn-boton col-4 offset-2">Aceptar</a>
                  </div>
                </div>
              </div>
        </div>
      <?php 
        $total_montos = $total_montos + $c->montos;         
        $total_programas = $total_programas + $c->programas;
        $total_socios = $total_socios + $c->socios;

        $total_socios_programas = $total_socios_programas + $total_concepto;
      } ?>

			<tr>
				<td><b>Total</b></td>
				<td scope="col"></td>
				<th scope="col"></th> 
				<th scope="col"></th>
				<td scope="col"><?php echo $total_montos; ?></td>
        <td scope="col"><?php echo $total_programas; ?></td>
        <td scope="col"><?php echo $total_socios; ?></td>
				<td scope="col"><?php echo $total_socios_programas; ?></td>
				<td scope="col"></a></td>
			</tr>

		</tbody>
	</table>
</div>



<!-- Modales -->
<!-- Agregar fijo -->
<div class="modal fade" id="agregar_fijo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Activo Fijo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<?php // concepto unidad cantidad costo_unitario montos programas socios id_activo id_proyecto ?>


      	<form method="post" action="<?php echo base_url()?>investment/insert_concept/1">

      		<div class="form-group">
      			<label>Concepto *</label>
      			<input class="form-control" type="text" name="concepto" value="<?php echo set_value('concepto'); ?>"/>
      			<?php echo form_error('concepto'); ?>
      		</div>

      		<div class="form-group">
      			<label>Unidad *</label>
      			<input class="form-control" type="text" name="unidad" value="<?php echo set_value('unidad'); ?>"/>
      			<?php echo form_error('unidad'); ?>
      		</div>

      		<div class="form-group">
      			<label>Cantidad *</label>
      			<input class="form-control" type="text" name="cantidad" value="<?php echo set_value('cantidad'); ?>"/>
      			<?php echo form_error('cantidad'); ?>
      		</div>

      		<div class="form-group">
      			<label>Costo Unitario *</label>
      			<input class="form-control" type="text" name="costo_unitario" value="<?php echo set_value('costo_unitario'); ?>"/>
      			<?php echo form_error('costo_unitario'); ?>
      		</div>

      		
      		<div class="form-group">
      			<label>Programas *</label>
      			<input class="form-control" type="text" name="programas" value="<?php echo set_value('programas'); ?>"/>
      			<?php echo form_error('programas'); ?>
      		</div>

      		<div class="form-group">
      			<label>Socios *</label>
      			<input class="form-control" type="text" name="socios" value="<?php echo set_value('socios'); ?>"/>
      			<?php echo form_error('socios'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>

      		<input type="reset" class="btn btn-secondary col-4 offset-1"data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="agregar_concepto" value="Aceptar">

      	</form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Agregar diferido -->
<div class="modal fade" id="agregar_diferido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Activo Diferido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<?php // concepto unidad cantidad costo_unitario montos programas socios id_activo id_proyecto ?>

      	<form method="post" action="<?php echo base_url()?>investment/insert_concept/2">

      		<div class="form-group">
      			<label>Concepto *</label>
      			<input class="form-control" type="text" name="concepto" value="<?php echo set_value('concepto'); ?>"/>
      			<?php echo form_error('concepto'); ?>
      		</div>

      		<div class="form-group">
      			<label>Unidad *</label>
      			<input class="form-control" type="text" name="unidad" value="<?php echo set_value('unidad'); ?>"/>
      			<?php echo form_error('unidad'); ?>
      		</div>

      		<div class="form-group">
      			<label>Cantidad *</label>
      			<input class="form-control" type="text" name="cantidad" value="<?php echo set_value('cantidad'); ?>"/>
      			<?php echo form_error('cantidad'); ?>
      		</div>

      		<div class="form-group">
      			<label>Costo Unitario *</label>
      			<input class="form-control" type="text" name="costo_unitario" value="<?php echo set_value('costo_unitario'); ?>"/>
      			<?php echo form_error('costo_unitario'); ?>
      		</div>

      		<div class="form-group">
      			<label>Programas *</label>
      			<input class="form-control" type="text" name="programas" value="<?php echo set_value('programas'); ?>"/>
      			<?php echo form_error('programas'); ?>
      		</div>

      		<div class="form-group">
      			<label>Socios *</label>
      			<input class="form-control" type="text" name="socios" value="<?php echo set_value('socios'); ?>"/>
      			<?php echo form_error('socios'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>

      		<input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="agregar_concepto" value="Aceptar">
      	</form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<!-- Agregar capital de trabajo -->
<div class="modal fade" id="agregar_capital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Activo Capital</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<?php // concepto unidad cantidad costo_unitario montos programas socios id_activo id_proyecto ?>

      	<form method="post" action="<?php echo base_url()?>investment/insert_concept/3">

      		<div class="form-group">
      			<label>Concepto *</label>
      			<input class="form-control" type="text" name="concepto" value="<?php echo set_value('concepto'); ?>"/>
      			<?php echo form_error('concepto'); ?>
      		</div>

      		<div class="form-group">
      			<label>Unidad *</label>
      			<input class="form-control" type="text" name="unidad" value="<?php echo set_value('unidad'); ?>"/>
      			<?php echo form_error('unidad'); ?>
      		</div>

      		<div class="form-group">
      			<label>Cantidad *</label>
      			<input class="form-control" type="text" name="cantidad" value="<?php echo set_value('cantidad'); ?>"/>
      			<?php echo form_error('cantidad'); ?>
      		</div>

      		<div class="form-group">
      			<label>Costo Unitario *</label>
      			<input class="form-control" type="text" name="costo_unitario" value="<?php echo set_value('costo_unitario'); ?>"/>
      			<?php echo form_error('costo_unitario'); ?>
      		</div>

      		<div class="form-group">
      			<label>Programas *</label>
      			<input class="form-control" type="text" name="programas" value="<?php echo set_value('programas'); ?>"/>
      			<?php echo form_error('programas'); ?>
      		</div>

      		<div class="form-group">
      			<label>Socios *</label>
      			<input class="form-control" type="text" name="socios" value="<?php echo set_value('socios'); ?>"/>
      			<?php echo form_error('socios'); ?>
            <br><h6 class="obligatorio">* Campos obligatorios</h6>
      		</div>

      		  <input type="reset" class="btn btn-secondary col-4 offset-1" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-boton col-4 offset-2" name="agregar_concepto" value="Aceptar">

      	</form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>