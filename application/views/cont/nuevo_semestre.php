<br><br>
<div class="container">
	<div class="row">

		
		<div class="col-sm-5 mx-auto card" style="padding-top: 20px; padding-bottom: 20px;">
			<!-- Button trigger modal -->
			<h2 class="text-center">Generar Nuevo Semestre</h2>
			<hr>
			<div class="modal-body">
			Al generar un nuevo semestre los datos se eliminarán definitivamente del sistema
			</div>
			<br>
			<div class="form-group">
				<input type="button" class="btn btn-boton  btn-md btn-block " data-toggle="modal"  data-target="#modal_vaciar" value="Vaciar el Contenido del Sistema"/>
			</div>

			

			<!-- Modal -->
			<div class="modal fade" id="modal_vaciar" tabindex="-1" role="dialog" aria-labelledby="modal_vaciarLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			  	<form method="post" action="<?php echo base_url()?>admin/empty_db">
			  		<div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="modal_vaciarLabel">¿Está seguro que desea vaciar el sistema?</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body obligatorio2">
				       Se eliminarán profesores, grupos, alummos y proyectos del sistema
				      </div>

				      <div class="modal-pie">
				        <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">Cancelar
				        </button>
				        <input type="submit" name="vaciar" class="btn btn-boton col-4 offset-2" value="Aceptar"></input>
				      </div>
				    </div>
			  	</form>
			  </div>
			</div>
		</div>
		

	</div>
</div>