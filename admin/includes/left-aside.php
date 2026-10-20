  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../contenido/general/cmit3.png" class="img-responsive" alt="RW Admin">
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="index"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-image"></i> <span>Slider</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="sliderp">
                <span>Slider Principal</span>
                <span class="pull-right-container">
                      <? 

                      $consulta = mysql_query("SELECT count(id) as cuenta FROM foto WHERE idgaleria  = 0 ");
                      $result = mysql_fetch_assoc($consulta);
                      echo '<small class="label pull-right bg-red">'.$result['cuenta'].'</small>';

                      ?>  
                </span>
              </a>
            </li>
            <li>
              <a href="sliders">
                <span>Slider Secundario</span>
                <span class="pull-right-container">
                      <? 

                      $consulta = mysql_query("SELECT count(id) as cuenta FROM foto2 WHERE idgaleria  = 0 ");
                      $result = mysql_fetch_assoc($consulta);
                      echo '<small class="label pull-right bg-yellow">'.$result['cuenta'].'</small>';

                      ?>  
                </span>
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-pencil-square"></i> <span>Página de Inicio</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="principalm?id=10"><i class="fa fa-circle-o"></i> <span>Texto Central</span></a></li>
            <li><a href="principalm?id=2"><i class="fa fa-circle-o"></i> <span>Prestaciones</span></a></li>
            <li><a href="principalm?id=3"><i class="fa fa-circle-o"></i> <span>Actualidad / blog</span></a></li>
            <li><a href="principalm?id=4"><i class="fa fa-circle-o"></i> <span>Turnos</span></a></li>
            <li><a href="principali?id=16"><i class="fa fa-circle-o"></i> <span>Imagen Lateral Inicio</span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-pencil-square"></i> <span>Página Nosotros</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="principal?id=1"><i class="fa fa-circle-o"></i> <span>Texto Central</span></a></a></li>
            <li><a href="principal?id=5"><i class="fa fa-circle-o"></i> <span>Visión</span></a></a></li>
            <li><a href="principal?id=6"><i class="fa fa-circle-o"></i> <span>Valores</span></a></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-pencil-square"></i> <span>Página de Prestaciones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="principal?id=7"><i class="fa fa-circle-o"></i> <span>Texto Central</span></a></a></li>
            <li><a href="principal?id=8"><i class="fa fa-circle-o"></i> <span>Exámenes ingreso</span></a></li>
            <li><a href="principal?id=9"><i class="fa fa-circle-o"></i> <span>Exámenes periódicos</span></a></li>
            <li><a href="principal?id=11"><i class="fa fa-circle-o"></i> <span>Examen de egreso</span></a></li>
            <li><a href="principal?id=12"><i class="fa fa-circle-o"></i> <span>Equipo profesional</span></a></li>
            <li><a href="principal?id=13"><i class="fa fa-circle-o"></i> <span>Establecimiento</span></a></li>
            <li><a href="principal?id=14"><i class="fa fa-circle-o"></i> <span>Equipamiento</span></a></li>
            <li><a href="principal?id=17"><i class="fa fa-circle-o"></i> <span>Título Galería</span></a></a></li>
            <li>
              <a href="sliderg">
                <span>Galería</span>
                <span class="pull-right-container">
                      <? 

                      $consulta = mysql_query("SELECT count(id) as cuenta FROM foto3 WHERE idgaleria  = 0 ");
                      $result = mysql_fetch_assoc($consulta);
                      echo '<small class="label pull-right bg-yellow">'.$result['cuenta'].'</small>';

                      ?>  
                </span>
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-pencil-square"></i> <span>Página e-Estudio</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="principaln?id=18"><i class="fa fa-circle-o"></i> <span>Texto Central</span></a></li>
            <li><a href="principaln?id=19"><i class="fa fa-circle-o"></i> <span>Columna 01</span></a></li>
            <li><a href="principaln?id=20"><i class="fa fa-circle-o"></i> <span>Columna 02</span></a></li>
            <li><a href="principaln?id=21"><i class="fa fa-circle-o"></i> <span>Columna03</span></a></li>
            <li><a href="principaln?id=22"><i class="fa fa-circle-o"></i> <span>Columna04</span></a></li>
            <li><a href="principaln?id=23"><i class="fa fa-circle-o"></i> <span>Columna05</span></a></li>
            <li><a href="principaln?id=24"><i class="fa fa-circle-o"></i> <span>Columna06</span></a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#"><i class="fa fa-th"></i> <span>Actualidad | Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="principal?id=15"><i class="fa fa-circle-o"></i> <span>Texto Central</span></a></a></li>
            <li>
              <a href="blog?cat=4">
                <span>Listado Artículos</span>
                <span class="pull-right-container">
                  <? 

                  $consulta = mysql_query("SELECT count(id) as cuenta FROM articulos WHERE idcategoria  = 4 ");
                  $result = mysql_fetch_assoc($consulta);
                  echo '<small class="label pull-right bg-green">'.$result['cuenta'].'</small>';

                  ?>  
                </span>
              </a>
            </li>

          </ul>
        </li>

        <li>
          <a href="registro">
            <i class="fa fa-inbox"></i> <span>Registro</span>
            <span class="pull-right-container">
                  <? 

                  $consulta = mysql_query("SELECT count(id) as cuenta FROM emails");
                  $result = mysql_fetch_assoc($consulta);
                  echo '<small class="label pull-right bg-blue">'.$result['cuenta'].'</small>';

                  ?>  
            </span>
          </a>
        </li>
        <li>
          <a href="newsletter">
            <i class="fa fa-inbox"></i> <span>Newsletter</span>
            <span class="pull-right-container">
                  <? 

                  $consulta = mysql_query("SELECT count(id) as cuenta FROM newsletter");
                  $result = mysql_fetch_assoc($consulta);
                  echo '<small class="label pull-right bg-yellow">'.$result['cuenta'].'</small>';

                  ?>  
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-cog"></i> <span>Configuración</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="configuracion">
                <i class="fa fa-circle-o"></i> <span>Información</span>
              </a>
            </li>
            <li>
              <a href="usuarios">
                <span>Usuarios</span>
                <span class="pull-right-container">
                      <? 

                      $consulta = mysql_query("SELECT count(id) as cuenta FROM users ");
                      $result = mysql_fetch_assoc($consulta);
                      echo '<small class="label pull-right bg-red">'.$result['cuenta'].'</small>';

                      ?>  
                </span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>