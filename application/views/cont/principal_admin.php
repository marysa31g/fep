<div class="container">
  <?php
    if($this->session->flashdata('flash'))
      echo $this->session->flashdata('flash');
  ?>
  <br>
  <table class="table table-striped table-hover table-bordered table-responsive-lg text-center">
    <thead class="text-center">
      <tr>
        <th colspan="100%">Lista de Profesores <a class="icon-plus" href="<?php echo base_url();?>admin/new_professor"style="float: right;" title="Agregar un profesor a la lista"></a></th>
      </tr>
      <tr>
        <th>Número</th>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($profesores as $key){ ?>
        <tr>
          <td><?php echo $key->id;?></td>
          <td><?php echo $key->matricula;?></td>
          <td><?php echo $key->nombres;?></td>
          <td><?php echo $key->apellido_paterno;?></td>
          <td><?php echo $key->apellido_materno;?></td>
          <td>
            

            <!-- Button trigger modal -->
            <a  class="icon-trash" title="Eliminar Profesor " data-toggle="modal" data-target="#modal_vaciar<?php echo $key->id;?>">            
            </a>

            <!-- Modal -->
            <div class="modal fade" id="modal_vaciar<?php echo $key->id;?>" tabindex="-1" role="dialog" aria-labelledby="modal_vaciarLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" action="<?php echo base_url()?>admin/delete_professor/<?php echo $key->id;?>">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal_vaciarLabel">¿Está seguro que desea eliminar al profesor?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body text-left obligatorio2" >
                           El profesor se eliminará de la lista
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
            
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>