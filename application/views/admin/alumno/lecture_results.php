<!-- start -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Resultados de la lectura</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Web/admin/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="<?php echo site_url('Web/admin/Alumno')?>"><i class="fa fa-users"></i> Alumnos</a></li>
            <li><a href="<?php echo site_url('Web/admin/Alumno/detail/')?><?php if(!empty($header_info)){echo $header_info->idAlumno;} ?>"><i class="fa fa-user"></i> Detalle alumno</a></li>
            <li class="active"><i class="fa fa-list text-azuld"></i> Resultados lectura</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src=" <?php if($header_info->genero == ("masculino") && !empty($header_info)){echo base_url().'assets/img/chico.png';}else{echo base_url().'assets/img/chica.png';} ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php if(!empty($header_info)){echo $header_info->nombre_alumno;} ?></h3>
                        <h4 class="text-muted text-azuld text-center"><?php if(!empty($header_info)){echo $header_info->titulo;} ?></h4>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a>Aciertos <span class="pull-right badge bg-verde"><?php if(!empty($header_info)){echo $header_info->aciertos;} ?></span></a></li>
                            <li><a>Incorrectos <span class="pull-right badge bg-red"><?php if(!empty($header_info)){echo $header_info->incorrectos;} ?></span></a></li>
                            <li><a>Promedio <span class="pull-right badge bg-yellow"><?php if(!empty($header_info)){echo $header_info->calificacion;} ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-body text-center">
                            <h5>Aprovechamiento</h5>
                            <span class="badge bg-verde">Exelente</span>
                            <span class="badge bg-azul">Regular</span>
                            <span class="badge bg-red">Suficiente</span>
                            <span class="badge bg-yellow">Insuficiente</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-body text-center">
                            <h5>Relación correcto-incorrecto</h5>
                            <span class="badge bg-verde">Correctas</span>
                            <span class="badge bg-red">Incorrectas</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-body">
                            <div class="chart" id="sales-chart" style="height: 300px; padding: 0px !important; position: relative;"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-body">
                            <div class="chart" id="bar-chart" style="height: 300px; padding: 0px; position: relative;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#OpcMul" data-toggle="tab" aria-expanded="false">Opción mutiple</a>
                        </li>
                        <li class="">
                            <a href="#RelCol" data-toggle="tab" aria-expanded="true">Relacionar columnas</a>
                        </li>
                        <li class="">
                            <a href="#VerFal" data-toggle="tab" aria-expanded="false">Verdadero o falso</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="OpcMul">
                            <div class="post">
                                <?php 
                                if(!empty($answers_om)){?>
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th style="width: 20%;" class="text-center">
                                                <span class="txt-15">Categoría</span>
                                            </th>
                                            <th style="width: 50%;" class="text-center">
                                                <span class="txt-15">Pregunta</span>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span class="txt-15">Respuesta correcta</span>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span class="txt-15">Respuesta alumno</span>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span class="txt-15">Estado</span>
                                            </th>
                                        </tr>
                                        <?php 
                                        $index = 1;
                                        foreach($answers_om as $answer){ ?>
                                        <tr>
                                            <td class="text-center txt-15" style="vertical-align:middle;"><b class="text-azuld"><?php echo $answer->nombre; ?></b></td>
                                            <td>
                                                <div>
                                                    <span class="txt-15"><b><?php echo ($index.") ".$answer->pregunta); ?></b></span><br>
                                                    <span class="txt-15">A) <?php echo $answer->resp_1; ?></span><br>
                                                    <span class="txt-15">B) <?php echo $answer->resp_2; ?></span><br>
                                                    <span class="txt-15">C) <?php echo $answer->resp_3; ?></span><br>
                                                    <span class="txt-15">D) <?php echo $answer->resp_4; ?></span><br>
                                                </div>
                                            </td>
                                            <td class="text-center txt-15" style="vertical-align:middle;"><?php echo strtoupper($answer->resp_correcta); ?></td>
                                            <td class="text-center txt-15" style="vertical-align:middle;"><?php echo strtoupper($answer->answer); ?></td>
                                            <td class="text-center txt-25" style="vertical-align:middle;">
                                                <i class="fa <?php if(strtoupper($answer->answer) == strtoupper($answer->resp_correcta)){echo "fa-check-circle text-verde";} else {echo "fa-times-circle text-red";} ?>"></i>
                                            </td>
                                        </tr>
                                        <?php 
                                        $index++;
                                        } ?>
                                    </tbody>
                                </table>
                                <?php 
                                } else {
                                echo 
                                "<table class=\"table table-bordered table-hover\">
                                    <tbody>
                                        <tr>
                                            <th style=\"width: 100%;\" class=\"text-center\">
                                                <span class=\"txt-15\">No se asignaron reactivos de este tipo a esta lectura.</span>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>";
                                }
                                ?>
                            </div>
                            
                        </div>

                        <div class="tab-pane" id="RelCol">
                            <div class="post">
                                <?php 
                                if(!empty($answers_rc)){
                                $index = 1;
                                foreach($answers_rc as $answer){ ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th style="width: 20%;" class="text-center">
                                                <span class="txt-15">Categría</span>
                                            </th>
                                            <th style="width: 35%;" class="text-center">
                                                <span class="txt-15">Columa preguntas</span>
                                            </th>
                                            <th style="width: 35%;" class="text-center">
                                                <span class="txt-15">Columna respuestas</span>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span class="txt-15">Estado</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="text-center txt-15" style="vertical-align:middle;"><b class="text-azuld"><?php echo $answer->nombre; ?></b></td>
                                            <td class="txt-15"><b><?php echo $answer->question_1; ?></b></td>
                                            <td class="txt-15"><?php echo $answer->answer_1; ?></td>
                                            <td class="text-center txt-25" style="vertical-align:middle;">
                                                <i class="fa <?php if($answer->status_1 == 'correct'){echo "fa-check-circle text-verde";} else {echo "fa-times-circle text-red";} ?> txt-20"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center txt-15" style="vertical-align:middle;"></td>
                                            <td class="txt-15"><b><?php echo $answer->question_2; ?></b></td>
                                            <td class="txt-15"><?php echo $answer->answer_2; ?></td>
                                            <td class="text-center txt-25" style="vertical-align:middle;">
                                                <i class="fa <?php if($answer->status_2 == 'correct'){echo "fa-check-circle text-verde";} else {echo "fa-times-circle text-red";} ?> txt-20"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center txt-15" style="vertical-align:middle;"></td>
                                            <td class="txt-15"><b><?php echo $answer->question_3; ?></b></td>
                                            <td class="txt-15"><?php echo $answer->answer_3; ?></td>
                                            <td class="text-center txt-25" style="vertical-align:middle;">
                                                <i class="fa <?php if($answer->status_3 == 'correct'){echo "fa-check-circle text-verde";} else {echo "fa-times-circle text-red";} ?> txt-20"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center txt-15" style="vertical-align:middle;"></td>
                                            <td class="txt-15"><b><?php echo $answer->question_4; ?></b></td>
                                            <td class="txt-15"><?php echo $answer->answer_4; ?></td>
                                            <td class="text-center txt-25" style="vertical-align:middle;">
                                                <i class="fa <?php if($answer->status_4 == 'correct'){echo "fa-check-circle text-verde";} else {echo "fa-times-circle text-red";} ?> txt-20"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <?php 
                                $index++;
                                }
                                }else {
                                echo 
                                "<table class=\"table table-bordered table-hover\">
                                    <tbody>
                                        <tr>
                                            <th style=\"width: 100%;\" class=\"text-center\">
                                                <span class=\"txt-15\">No se asignaron reactivos de este tipo a esta lectura.</span>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>";
                                } ?>
                            </div>
                        </div>

                        <div class="tab-pane" id="VerFal">
                            <div class="post">
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th style="width: 20%;" class="text-center">
                                                <span class="txt-15">Categría</span>
                                            </th>
                                            <th style="width: 60%;" class="text-center">
                                                <span class="txt-15">Pregunta</span>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span class="txt-15">Respuesta alumno</span>
                                            </th>
                                            <th style="width: 10%;" class="text-center">
                                                <span class="txt-15">Estado</span>
                                            </th>
                                        </tr>
                                        <?php 
                                        $index = 1;
                                        foreach($answers_vf as $answer){ ?>
                                        <tr>
                                            <td class="text-center txt-15" style="vertical-align:middle;"><b class="text-azuld"><?php echo $answer->nombre; ?></b></td>
                                            <td>
                                                <span class="txt-15"><b><?php echo $answer->question; ?></b></span>
                                            </td>
                                            <td class="text-center txt-15"><?php echo $answer->answer; ?></td>
                                            <td class="text-center txt-25">
                                                <i class="fa <?php if($answer->status == 'correct'){echo "fa-check-circle text-verde";} else {echo "fa-times-circle text-red";} ?>"></i>
                                            </td>
                                        </tr>
                                        <?php 
                                        $index++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input id="bu" type="hidden" value="<?php echo base_url(); ?>" class="question_hidden">
    <input id="idLectura" type="hidden" value="<?php if(!empty($header_info)){echo $header_info->idLectura;} ?>" class="question_hide">
    <input id="idAlumno" type="hidden" value="<?php if(!empty($header_info)){echo $header_info->idAlumno;} ?>" class="question_hide">
</div>
<script>
  $(function () {
    let baseUrl = $('#bu').val();
    let idLectura = $('#idLectura').val();
    let idAlumno = $('#idAlumno').val();
    //console.log(baseUrl+"-"+idLectura+"-"+idAlumno);

    const data = {
        idLectura: idLectura,
        idAlumno: idAlumno
    };
    $.post(
        baseUrl+"Web/admin/Alumno/getDataChart1",
        data,
        (resp) => {
            let result = JSON.parse(resp);
            // console.log(resp);
            console.log(result);

            let dataChartBar = [];
            let dataChartDonut = [];
            let colorChartDonut = [];

            result.forEach(row => {
                // chart bar
                var objectBar = {
                    y: row.categoria,
                    a: row.correctas,
                    b: row.incorrectas
                } 
                dataChartBar.push(objectBar);

                //color chart donut
                var colorPie = '';

                if(row.percent >= 90 && row.percent <= 100){
                    colorPie = '#02c754'; //green
                } else  if(row.percent >= 70 && row.percent <= 90){
                    colorPie = '#4680ff'; //blue
                } else if(row.percent >= 40 && row.percent <= 69){
                    colorPie = '#ffa500'; //yellow
                } else if(row.percent < 40){
                    colorPie = '#f01a1a'; //red
                }
                colorChartDonut.push(colorPie);

                // data chart bar
                var objectDonut = {
                    label: row.categoria, 
                    value: row.percent,
                    formatted: row.percent+'%'
                };
                dataChartDonut.push(objectDonut);
            });
             console.log(dataChartDonut);
             console.log(colorChartDonut);

            //DONUT CHART
            var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                colors: colorChartDonut,
                data: dataChartDonut,
                formatter: function (value, dona) { return dona.formatted },
                hideHover: 'auto'
            });

            //BAR CHART
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: dataChartBar,
                barColors: ['#02c754', '#f01a1a'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['correctas', 'incorrectas'],
                stacked: false,
                axes: true,
                hideHover: 'auto'
            });
        }
    );
  });
</script>