<!-- .INICIO CONTENIDO  -->
<div class="content-wrapper">

    <!-- Content Header (Page header)  -->
    <section class="content-header">
        <h1>Administrador de logros (beta)</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Web/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-trophy text-azuld"></i> Logros</li>
        </ol>
    </section>

    <section class="content">
        <form id="frmSubmitAch" class="row" method="POST" action="<?php echo site_url('Web/Logros/save')?>">
            <div class="col-lg-5 col-md-12">
                <div class="box box-solid">
                    <div class="box-header bg-primary text-white">
                          <h3 class="box-title"><i class="fa fa-trophy"></i> Agregar logro</h3>
                    </div>
                    <div class="box-body">
                        <div>    
                            <!-- name -->
                            <div class="form-group">
                                <label for="achName" class="col-form-label"><i class="fa fa-flag text-azuld"></i> Nombre del logro *</label>
                                <input type="text" id="achName" name="achName" class="form-control req irna" placeholder="Gran lector" required>
                            </div>

                            <!-- description -->
                            <div class="form-group">
                                <label for="achDescription" class="col-form-label"><i class="fa fa-file-text text-azuld"></i> Descripción *</label>
                                <textarea type="text" id="achDescription" name="achDescription" class="form-control req irna" placeholder="Logro por completar 50 lectruas." required></textarea>
                            </div>

                            <!-- icon -->
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-cube text-azuld"></i> Icono (opcional)</label> 
                                        <select id="slctIcon" class="form-control select-ach" required>
                                            <option id="ic_0" onclick="setIcon('flag','')" selected>- selecciona un icono -</option>
                                            <option id="ic_1" onclick="setIcon('cube','cubo')">cubo</option>
                                            <option id="ic_2" onclick="setIcon('flag','bandera')">bandera</option>
                                            <option id="ic_3" onclick="setIcon('balance-scale','balanza')">balanza</option>
                                            <option id="ic_4" onclick="setIcon('book','libro')">libro</option>
                                            <option id="ic_5" onclick="setIcon('bell','campana')">campana</option>
                                            <option id="ic_6" onclick="setIcon('check','correcto')">acierto</option>
                                            <option id="ic_7" onclick="setIcon('close','equis')">equis</option>
                                            <option id="ic_8" onclick="setIcon('birthday-cake','pastel')">pastel</option>
                                            <option id="ic_9" onclick="setIcon('image','imagen')">imagen</option>
                                            <option id="ic_10" onclick="setIcon('line-chart','incremento')">incremento</option>
                                            <option id="ic_11" onclick="setIcon('bolt','rayo')">rayo</option>
                                            <option id="ic_12" onclick="setIcon('child','niño')">niño</option>
                                            <option id="ic_13" onclick="setIcon('flag-checkered','meta')">meta</option>
                                            <option id="ic_14" onclick="setIcon('asterisk','asterisco')">asterisco</option>
                                            <option id="ic_15" onclick="setIcon('send','avión')">avión papel</option>
                                            <option id="ic_16" onclick="setIcon('cubes','cubos')">cubos</option>
                                            <option id="ic_17" onclick="setIcon('magic','magia')">magía</option>
                                            <option id="ic_18" onclick="setIcon('heart','corazón')">corazón</option>
                                        </select>
                                    </div>
                                    <input id="icAch" name="icAch" type="text" value="flag" class="question_hide" hidden="hidden" readonly>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-paint-brush text-azuld"></i> Color (opcional)</label> 
                                        <select id="slctIconColor" class="form-control select-ach" required>
                                            <option onclick="setColorIc('maroon')" selected>- selecciona un color -</option>
                                            <option onclick="setColorIc('verde')">verde</option>
                                            <option onclick="setColorIc('red')">rojo</option>
                                            <option onclick="setColorIc('azul')">azul</option>
                                            <option onclick="setColorIc('maroon')">violeta</option>
                                            <option onclick="setColorIc('yellow')">amarillo</option>
                                            <option onclick="setColorIc('teal')">teal</option>
                                            <option onclick="setColorIc('aqua')">aqua</option>
                                            <option onclick="setColorIc('navy')">navy</option>
                                            <option onclick="setColorIc('black')">negro</option>
                                            <option onclick="setColorIc('orange')">naranja</option>
                                            <option onclick="setColorIc('purple')">morado</option>
                                        </select>
                                    </div>
                                    <input id="icAchColor" name="icAchColor" type="text" value="maroon" class="question_hide" hidden="hidden" readonly>
                                </div>
                            </div>
                            <div class="form-group text-center items-center">
                                <div id="icpreview" class="ic-preview text-center">
                                    <i id="previewIcon" class="fa fa-flag txt-20"></i>
                                </div>
                            </div>

                            <!-- image -->
                            <div class="form-group">
                                <label><i class="fa fa-image text-azuld"></i> Imagen (opcional) </label> 
                                <select class="form-control select-ach">
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_0.png';?>',false)" selected>- selecciona una imagen -</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_1.png';?>')">bandera</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_2.png';?>')">cohete</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_3.png';?>')">libros</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_4.png';?>')">bola magica</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_5.png';?>')">meta</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_6.png';?>')">mundo</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_7.png';?>')">pensar</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_8.png';?>')">trofeo</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_9.png';?>')">varita magica</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_10.png';?>')">regalo</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_11.png';?>')">cerebro</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_12.png';?>')">estrellas</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_13.png';?>')">idea</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_14.png';?>')">corazón</option>
                                    <option onclick="setImg('<?php echo base_url().'assets/img/achievements/img_15.png';?>')">creatividad</option>
                                </select>
                                <input id="getImgAch" name="getImgAch" type="text" class="question_hide" hidden="hidden">
                            </div>
                            <div class="form-group">
                                <div class="timeline-body text-center ach-cont">
                                    <div class="circle-ac">
                                        <img id="imgAch" src="<?php echo base_url().'assets/img/achievements/img_0.png';?>" class="">
                                    </div>
                                </div>
                            </div>

                            <!-- btn save -->
                            <div class="form-group">
                                <button id="checkFormAchievement" type="submit" class="btn bg-verde btn-block"><b>Guardar</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <?php 
                if(!empty($this->session->flashdata("error"))){
                    echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                    echo "<span>".$this->session->flashdata("error")."</span><br>";
                    echo "</div>";
                }
                if(!empty($this->session->flashdata("success"))){
                    echo "<div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                    echo "<span>".$this->session->flashdata("success")."</span><br>";
                    echo "</div>";
                } 
                ?>
                <table class="table table-bordered bg-white table-hover text-center">
                    <tbody>
                        <tr>
                            <th class="bg-gray">#</th>
                            <th class="bg-gray">Alumno</th>
                            <th class="bg-gray">
                                <label>
                                    <input id="cbxAllStudents" type="checkbox"> aplicar a todos
                                </label>
                            </th>
                        </tr>
                        <?php 
                        $indice = 1; 
                        if(!empty($alumnos)){ 
                        foreach($alumnos as $alumno){ ?>
                        <tr>
                            <td><?php echo $indice; ?></td>
                            <td><?php echo $alumno->nombre." ".$alumno->a_paterno." ".$alumno->a_materno ?></td>
                            <td>
                                <label>
                                    <input name="getIdAlumno<?php echo $indice; ?>" value="<?php echo $alumno->idAlumno; ?>" type="text" class="question_hide" hidden="hidden">
                                    <input name="idAlumno_<?php echo $indice++; ?>" type="checkbox" class="cbxAchivement"> Asignar logro
                                </label>
                            </td>
                        </tr>
                        <?php 
                        } 
                        } 
                        echo "<input name=\"totalAlumnos\" type=\"text\" value=\"".($indice-1)."\" class=\"question_hide\" hidden=\"hidden\">";
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </section>

</div>

<script>
    function setIcon(icon,word){
        document.getElementById('icAch').value = icon;
        document.getElementById('previewIcon').setAttribute("class","fa fa-"+icon+" txt-20 text-white");
    }

    function setColorIc(color){
        document.getElementById('icAchColor').value = color;
        document.getElementById('icpreview').setAttribute("class","ic-preview text-center bg-"+color+"");
    }

    function setImg(img,x){
        document.getElementById('imgAch').removeAttribute('src');
        document.getElementById('imgAch').setAttribute('src',img);
        if(x == false){
            document.getElementById('getImgAch').setAttribute('value','');
        } else {
            document.getElementById('getImgAch').setAttribute('value',img);
        }
    }

    $(function (){
        $(".cbxAchivement").on("click", function() {
            $(this).attr("checked", this.checked);
            $(this).attr("value", this.checked);
        });
        $("#cbxAllStudents").on("click", function() {
            $(".cbxAchivement").attr("checked", this.checked);
            $(".cbxAchivement").attr("value", this.checked);
        });

        $("#frmSubmitAch").submit(function(e){
            if($('input[type=checkbox]:checked').length === 0) {
                e.preventDefault();
                alert('Debe seleccionar al menos un alumno.');
            }
        });
    })
</script>