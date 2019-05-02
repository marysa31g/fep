<script type="text/javascript">
  $(document).ready(function(){
    if(<?php echo $bandera_ins; ?>)
    $('#crear_proy').modal("show");
  });
</script>
<div class="" style="height: 400px">
  <?php
    if($this->session->flashdata('flash'))
      echo $this->session->flashdata('flash');
  ?>
  <div class="col-8 offset-2">
    <button class="btn btn-boton col-6 offset-3" data-toggle="modal" data-target="#crear_proy">Crear Proyecto</button>
  </div>
</div>

<!-- Modal para crear un nuevo proyecto-->
  <div class="modal fade" id="crear_proy" tabindex="-1" role="dialog" aria-labelledby="modal_vaciarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <form class="" action="<?php echo base_url();?>student/new_project" method="post">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_vaciarLabel">Crear Proyecto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          
          <?php
            if($this->session->flashdata('flash'))
              echo $this->session->flashdata('flash');
          ?>

          <div class="form-group">
            <label for="titulo" accesskey="t">Título del Proyecto</label>
            <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo set_value('titulo'); ?>" placeholder="Tu título">
            <?php echo form_error('titulo'); ?>
          </div>
          
        </div>

        <div class="modal-pie">
          <button type="button" class="btn btn-secondary col-4 offset-1" data-dismiss="modal">Cancelar
          </button>
          <input type="submit" name="submit" class="btn btn-boton col-4 offset-2" value="Aceptar"></input>
        </div>
      </div>

    </form>
    
  </div>
  </div>