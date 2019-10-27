

<!-- =====================.INICIO CONTENIDO ========================== -->
<div class="content-wrapper">

    <!--=========== Content Header (Page header) =========== -->
    <section class="content-header">
          <h1>
            Alumnos registrados por el docente
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Web/admin/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="<?php echo site_url('Web/admin/Docente')?>"><i class="fa fa-users"></i> Docentes</a></li>
            <li class="active"><i class="fa fa-user"></i> Alumnos</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src=" <?php if(!empty($docente)){echo base_url().'assets/img/programador.png';}?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php if(!empty($docente)){echo ucwords($docente->nombre." ".$docente->a_paterno." ".$docente->a_materno);} ?></h3>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li>
                            <a><i class="fa fa-book"></i> Lecturas publicadas <span class="pull-right badge bg-azul">
                            <?php if(!empty($total_lec)){echo $total_lec->total_lecturas;} else {echo "0";} ?></span>
                            </a>
                            </li>
                            <li>
                            <a><i class="fa fa-users"></i> Total de alumnos <span class="pull-right badge bg-verde">
                            <?php if(!empty($total_alu)){echo $total_alu->total_alumnos;} else {echo "0";} ?></span>
                            </a>
                            </li>
                            <li>
                            <a><i class="fa fa-bookmark"></i> Promedio grupal <span class="pull-right badge bg-yellow">
                            <?php if(!empty($gen_score)){echo $gen_score->general_score;} else {echo "0";} ?></span>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">Aprovechamiento</h3>
                    </div>
                    <div class="box-footer no-padding">
                        <div class="chart" id="bar-chart" style="height: 222px !important; padding: 0px; position: relative;"></div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="tabla_alumnos_admin" class="table table-bordered table-hover">
                            <thead class="bg-azul">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Grado</th>
                                    <th class="text-center">Grupo</th>
                                    <th class="text-center">Usuario</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $indice = 1; ?>
                            <?php if(!empty($alumnos)): ?>
                            <?php foreach($alumnos as $alumno): ?>
                                <tr>
                                    <td class="text-center"><?php echo $indice++; ?></td>
                                    <td class="text-center"><?php echo $alumno->nombre." ".$alumno->a_paterno." ".$alumno->a_materno ?></td>
                                    <td class="text-center"><?php echo $alumno->grado; ?></td>
                                    <td class="text-center"><?php echo $alumno->grupo; ?></td>
                                    <td class="text-center"><?php echo $alumno->usuario; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('Web/admin/Alumno/detail');?>/<?php echo $alumno->idAlumno; ?>" class="btn bg-verde">
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

<input id="bu" type="hidden" value="<?php echo base_url(); ?>" class="question_hidden">
<input id="idUsuario" type="hidden" value="<?php if(!empty($docente)){echo $docente->idUsuario;} ?>" class="question_hide">
<!-- =====================.FIN CONTENIDO ========================== -->

<script>
  $(function (){

    let baseUrl = $('#bu').val();
    let idUsuario = $('#idUsuario').val();
    console.log(baseUrl+"-"+idUsuario);

    const data = {
        idUsuario: idUsuario
    };
    $.post(
        baseUrl+"Web/admin/Docente/getDataChart2",
        data,
        (resp) => {
            let result = JSON.parse(resp);
            console.log(result);

            let dataChartBar = [];

            result.forEach(row => {
                // chart bar
                var objectBar = {
                    y: row.categoria,
                    a: row.percent
                } 
                dataChartBar.push(objectBar);
            });

            console.log(dataChartBar);

            //BAR CHART
            var bar = new Morris.Bar({
              element: 'bar-chart',
              resize: true,
              data: dataChartBar,
              barColors: ['#03cf58'],
              xkey: 'y',
              ykeys: ['a'],
              labels: ['% de aprovechamiento'],
              hideHover: 'auto'
            });
        }
    );
    
  })
</script>
