<?php
  //para determinar la url y marcar el nav_proyecto
  
  $mystring = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  
  $var = array(
    1 => 'technical_parameters',
    2 => 'investment',
    3 => 'memory_calc',
    4 => 'production',
    5 => 'projection_costs',
    6 => 'income'
  );

  if (strpos($mystring, $var[1]))
  {
    $technical = strpos($mystring, $var[1]);
  }
  if (strpos($mystring, $var[2]) or strpos($mystring, 'student'))
  {
    $investment = strpos($mystring, $var[2]);
  }
  if (strpos($mystring, $var[3]))
  {
    $memory_calc = strpos($mystring, $var[3]);  
  }
  if (strpos($mystring, $var[4]))
  {
    $production = strpos($mystring, $var[4]);
  }
  if (strpos($mystring, $var[5]))
  {
    $projection_costs = strpos($mystring, $var[5]);
  }
  if (strpos($mystring, $var[6]))
  {
    $income = strpos($mystring, $var[6]);
  }
    
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-left: 120px; margin-right: 120px">
    
    <a class="navbar-brand" href=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_proyecto" aria-controls="nav_proyecto" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav_proyecto">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          
          <a class="nav-link convertexto" title="Nombre del proyecto">
            <b>
              <?php if(isset($proyecto->titulo)) {
                echo $proyecto->titulo;
              }?>
            </b>
          </a>

        </li>

        <li class="nav-item menuses">
        <p>  <a class="nav-link <?php if(isset($technical)) echo "link_activo";?>" href="<?php echo base_url();?>technical_parameters" title="Parámetros técnicos">Parámetros Técnicos</a><p>
        </li>

        <li class="nav-item menuses">
          <p><a class="nav-link <?php if(isset($investment)) echo "link_activo";?>" title="Presupuesto de inversión"href="<?php echo base_url();?>investment">Presupuesto de Inversión</a></p>
        </li>

        <li class="nav-item menuses">
          <p><a class="nav-link <?php if(isset($memory_calc)) echo "link_activo";?>" href="<?php echo base_url();?>memory_calc" title="Memorias de cálculo">Memorias de Cálculo</a></p>
        </li>

        <li class="nav-item menuses">
          <p><a class="nav-link <?php if(isset($production)) echo "link_activo";?>" href="<?php echo base_url();?>production" title="Producción">Producción <br></a></p>
        </li>
        <li class="nav-item menuses">
          <p><a class="nav-link <?php if(isset($projection_costs)) echo "link_activo"; ?>" href="<?php echo base_url();?>projection_costs" title="Proyección de costos"> Proyección de Costos</a></p>
        </li>
        
        <li class="nav-item menuses">
          <p><a class="nav-link" href="<?php echo base_url();?>income" title="Proyección de ingresos">
            <span class="<?php if(isset($income)) echo "link_activo";?>">
              Proyección de Ingresos
            </span>
          </a></p>
        </li>

      </ul>
    </div>

</nav>
