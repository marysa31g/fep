<div class="container">
<?php  
    if($this->session->flashdata('flash'))
        echo $this->session->flashdata('flash');
?>
	<div class="row">
		<table class="table table-responsive-md table-bordered	">
			<thead class="text-center"  >
				<tr class="text-center">
					<th colspan="100%">Lista de Proyectos en el Grupo</th>
				</tr>
				<tr>
					<th>Número</th>
					<th>Título</th>
					<th>Autor</th>
					<th>Matrícula</th>
					<th>Opciones de Proyecto</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; foreach ($proyectos as $proyecto) {$i++;?>
					<tr>
						<th><?php echo $i?></th>
						<td><?php echo $proyecto->titulo;?></td>
						<td><?php echo $proyecto->autor;?></td>
						<td><?php echo $proyecto->matricula;?></td>
						<td>
							 <a class="icon-views" title=" Ver Proyecto del Alumno" href=""></a>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php
		if(!$proyectos)
		{
	?>
		<div class="text-danger text-center">
			<span class="">No se han registrado proyectos</span>
		</div>
	<?php
		}
	?>
</div>
