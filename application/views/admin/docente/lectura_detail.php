
<!-- =====================.INICIO CONTENIDO ========================== -->
<div class="content-wrapper">

    <!--=========== Content Header (Page header) =========== -->
    <section class="content-header">
          <h1>
            Alumnos que terminaron de leer esta lectura
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Web/admin/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="<?php echo site_url('Web/admin/Docente')?>"><i class="fa fa-users"></i> Docentes</a></li>
            <li class="active"><i class="fa fa-book"></i> Lecturas</li>
        </ol>
    </section>
    <!--=========== Content Header (Page header) =========== -->

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-azul">
                        <a class="bg-maroon">
                            <div  class="widget-user-image">
                                <img class="img-circle img-thumbnail circle-blue"  
                            src="<?php echo base_url(); ?>assets/img/book-green.png" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username"><?php echo $detail_lectura->titulo; ?> </h3>
                            <h5 class="widget-user-desc">Autor: <i><?php echo $detail_lectura->autor; ?></i></h5>
                        </a>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                        <li><a>Fecha de creación <span class="pull-right badge bg-azul"><?php echo $detail_lectura->fecha_creacion; ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table id="tabla_alumnos_by_lectura_admin" class="table table-bordered table-hover">
                            <thead class="bg-azul">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Grado y grupo</th>
                                    <th class="text-center">Aciertos</th>
                                    <th class="text-center">Incorrectos</th>
                                    <th class="text-center">Calificación</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $indice = 1; ?>
                            <?php if(!empty($detail_alumno_lectura)): ?>
                            <?php foreach($detail_alumno_lectura as $dal): ?>
                              <tr>                                
                                <td class="text-center"><?php echo $indice++; ?></td>
                                <td class="text-center"><?php echo $dal->nombre; ?></td>
                                <td class="text-center"><?php echo $dal->gyg; ?></td>
                                <td class="text-center">
                                    <span class="badge bg-verde" style="width: 30px;"><?php echo $dal->aciertos; ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-red" style="width: 30px;"><?php echo $dal->incorrectos; ?></span>        
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-yellow" style="width: 50px;"><?php echo $dal->calificacion; ?></span> 
                                </td>
                                <td class="text-center">
                                  <a href="<?php echo site_url('Web/admin/Docente/detail');?>/<?php echo $dal->idAlumno; ?>" class="btn bg-verde"><span class="fa fa-eye text-white"></span></a>
                                </td>
                              </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
        <!-- /.box -->
            </div>
    <!-- /.col -->
        </div>
    </section>

</div>