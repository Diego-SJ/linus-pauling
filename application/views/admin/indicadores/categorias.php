<!-- .INICIO CONTENIDO  -->
<div class="content-wrapper">

    <!-- Content Header (Page header)  -->
    <section class="content-header">
        <h1>Administrador de categorías para clasificar reactivos</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Web/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-trophy text-azuld"></i> Indicadores</li>
        </ol>
    </section>

    <section class="content">
        <form id="frmSubmitAch" class="row" method="POST" action="<?php echo site_url('Web/Indicadores/save')?>">
            <div class="col-lg-5 col-md-12">
                <div class="box box-solid">
                    <div class="box-header bg-primary text-white">
                          <h3 class="box-title"><i class="fa fa-pie-chart"></i> Agregar categoría</h3>
                    </div>
                    <div class="box-body">
                        <div>    
                            <!-- name -->
                            <div class="form-group">
                                <label for="achName" class="col-form-label"><i class="fa fa-filter text-azuld"></i> Nombre de la categoría <b class="text-red">*</b></label>
                                <input type="text" id="catName" name="achName" class="form-control req irna" placeholder="" required>
                            </div>

                            <!-- description -->
                            <div class="form-group">
                                <label for="achDescription" class="col-form-label"><i class="fa fa-file-text text-azuld"></i> Descripción <b class="text-red">*</b></label>
                                <textarea type="text" id="acatDescription" name="achDescription" class="form-control req irna" placeholder="" required></textarea>
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
                            <th class="bg-gray">Categoría</th>
                            <th class="bg-gray">Descripcioón</th>
                            <th class="bg-gray">Acciones</th>
                        </tr>
                        <?php 
                        $indice = 1; 
                        if(!empty($categories)){ 
                        foreach($categories as $category){ ?>
                        <tr>
                            <td><?php echo $indice; ?></td>
                            <td><?php echo $category->nombre ?></td>
                            <td><?php echo $category->descripcion ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </section>

</div>

<script>
    $(function (){
        // $("#frmSubmitAch").submit(function(e){
        //     if($('input[type=checkbox]:checked').length === 0) {
        //         e.preventDefault();
        //         alert('Debe seleccionar al menos un alumno.');
        //     }
        // });
    })
</script>