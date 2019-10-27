<!-- =====================.INICIO CONTENIDO ========================== -->
<div class="content-wrapper">

  <!--=========== Content Header (Page header) =========== -->
  <section class="content-header">
    <h1>
      Detalle del alumno
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Web/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="<?php echo site_url('Web/Alumno')?>"><i class="fa fa-users"></i> Alumnos</a></li>
      <li class="active"><i class="fa fa-user text-azuld"></i> Detalle alumno</li>
    </ol>
  </section>
  <!--=========== Content Header (Page header) =========== -->

  <section class="content">
    <div class="row">

      <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="box box-primary">
              <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src=" <?php if($alumno->genero == ("masculino") && !empty($alumno)){echo base_url().'assets/img/chico.png';}else{echo base_url().'assets/img/chica.png';} ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php if(!empty($alumno)){echo ucwords($alumno->nombre." ".$alumno->a_paterno." ".$alumno->a_materno);} ?></h3>
                  <h4 class="text-muted text-azuld text-center"><?php if(!empty($alumno)){echo "Grado y grupo: ".$alumno->grado." ".$alumno->grupo;} ?></h4>
              </div>
              <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                      <li>
                        <a><i class="fa fa-bookmark"></i> Lecturas completadas <span class="pull-right badge bg-azul">
                        <?php if(!empty($alumno_detail)){echo $alumno_detail->lecturas;} else {echo "0";} ?></span>
                        </a>
                      </li>
                      <li>
                        <a><i class="fa fa-check-circle"></i> Total de aciertos <span class="pull-right badge bg-verde">
                        <?php if(!empty($alumno_detail)){echo $alumno_detail->aciertos;} else {echo "0";} ?></span>
                        </a>
                      </li>
                      <li>
                        <a><i class="fa fa-times-circle"></i> Total de incorrectos <span class="pull-right badge bg-red">
                        <?php if(!empty($alumno_detail)){echo $alumno_detail->incorrectos;} else {echo "0";} ?></span>
                        </a>
                      </li>
                      <li>
                        <a><i class="fa fa-graduation-cap"></i> Promedio general<span class="pull-right badge bg-yellow">
                        <?php if(!empty($alumno_detail)){echo $alumno_detail->promedio;} else {echo "0";} ?></span>
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
                  <div class="chart" id="bar-chart" style="height: 300px; padding: 0px; position: relative;"></div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-xs-12">
        <div class="box box-solid">
          <div class="box-body">
            <table id="tabla_alumnos_teacher_detail" class="table table-bordered table-hover">
              <thead class="bg-azul">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Titulo</th>
                  <th class="text-center">Aciertos</th>
                  <th class="text-center">Incorrectos</th>
                  <th class="text-center">Promedio</th>
                  <th class="text-center">Fecha de conclusión</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php $indice = 1; ?>
                <?php if(!empty($alumno_lecturas)): ?>
                  <?php foreach($alumno_lecturas as $lectura): ?>
                  <tr>
                      <td class="text-center"><?php echo $indice++; ?></td>
                      <td class="text-center"><?php echo $lectura->titulo; ?></td>
                      <td class="text-center"><?php echo $lectura->aciertos; ?></td>
                      <td class="text-center"><?php echo $lectura->incorrectos; ?></td>
                      <td class="text-center"><?php echo $lectura->calificacion; ?></td>
                      <td class="text-center"><?php echo $lectura->fecha; ?></td>
                      <td class="text-center">
                        <form method="post" action="<?php echo site_url('Web/Alumno/resultTest');?>" class="question_hide" hidden="hidden">
                          <input type="text" class="question_hide" hidden="hidden" name="id_alumno" value="<?php echo $lectura->idAlumno; ?>">
                          <input type="text" class="question_hide" hidden="hidden" name="id_lectura" value="<?php echo $lectura->idLectura; ?>">
                          <button id="btn_id_<?php echo $lectura->idLectura; ?>" type="submit" class="question_hide" hidden="hidden"></button>
                        </form>
                        <a class="btn bg-azul" onclick="updateUI2('btn_id_<?php echo $lectura->idLectura; ?>')">
                            <span class="fa fa-list text-white"></span>
                        </a>
                        <a href="<?php echo site_url('Web/Lecturas/detail');?>/<?php echo $lectura->idLectura; ?>" class="btn bg-verde">
                          <span class="fa fa-book text-white"></span>
                        </a>
                      </td>
                  </tr>
                  <script>
                      function updateUI2(id){
                          document.getElementById(id).click();
                      }
                  </script>
                <?php endforeach ?>
              <?php endif ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </section>

  <input id="bu" type="hidden" value="<?php echo base_url(); ?>" class="question_hidden">
  <input id="idAlumno" type="hidden" value="<?php if(!empty($alumno)){echo $alumno->idAlumno;} ?>" class="question_hide">

</div>

<script>
  $(function (){

    let baseUrl = $('#bu').val();
    let idAlumno = $('#idAlumno').val();
    console.log(baseUrl+"-"+idAlumno);

    const data = {
        idAlumno: idAlumno
    };
    $.post(
        baseUrl+"Web/Alumno/getDataChart2",
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