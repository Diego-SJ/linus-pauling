
<!-- =====================.INICIO CONTENIDO ========================== -->
<div class="content-wrapper">

    <!--=========== Content Header (Page header) =========== -->
    <section class="content-header">
          <h1>
            Panel de administración
            <small>Inicio</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home"></i> Inicio</a></li>
        </ol>
    </section>
    <!--=========== Content Header (Page header) =========== -->

    <section class="content">
        <div class="row">
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-azul">
              <div class="inner">
                <h3>
                <?php
                if(!empty($t_alumno)){
                  echo $t_alumno->total_alumno; 
                } else {
                  echo "0";
                }
                ?>
                </h3>

                <p>Alumnos</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <a class="small-box-footer"> Total de alumnos registrados <i class="fa fa-info-circle"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-verde">
              <div class="inner">
                <h3>
                  <?php if(!empty($t_Lecturas)){
                    echo $t_Lecturas->total_lectura;
                    } else {
                      echo "0";
                    } ?>  
                </h3>

                <p>Lecturas</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a class="small-box-footer"> Total lecturas registradas <i class="fa fa-info-circle"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php if(!empty($t_Docentes)){ echo $t_Docentes->total_docente; } else {  echo "0"; } ?></h3>
                <p>Profesores</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="<?php echo site_url('Web/admin/Docente')?>" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <div class="box box-primary">
                  <div class="box-body">
                      <h3>Los mejores 20</h3>
                      <table id="the_best_students" class="table table-bordered table-hover">
                          <thead class="bg-primary">
                              <tr>
                                  <th class="text-center">#</th>
                                  <th class="text-center">Nombre</th>
                                  <th class="text-center">Grado</th>
                                  <th class="text-center">Grupo</th>
                                  <th class="text-center">Promedio</th>
                                  <th class="text-center">Ver</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php $indice = 1; ?>
                          <?php if(!empty($best_students)): ?>
                          <?php foreach($best_students as $alumno): ?>
                              <tr>
                                  <td class="text-center"><?php echo $indice++; ?></td>
                                  <td class="text-center"><?php echo $alumno->alumno ?></td>
                                  <td class="text-center"><?php echo $alumno->grado; ?></td>
                                  <td class="text-center"><?php echo $alumno->grupo; ?></td>
                                  <td class="text-center"><?php echo $alumno->promedio; ?></td>
                                  <td class="text-center">
                                      <a href="<?php echo site_url('Web/admin/Alumno/detail');?>/<?php echo $alumno->idAlumno; ?>" class="btn btn-verde">
                                          <span class="fa fa-eye text-white"></span>
                                      </a>
                                  </td>
                              </tr>
                          <?php endforeach ?>
                          <?php endif ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    </section>

</div>
<!-- =====================.FIN CONTENIDO ========================== -->


                    


