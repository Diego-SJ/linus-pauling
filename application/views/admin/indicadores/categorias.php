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
        <form id="catForm" class="row">
            <div class="col-lg-4 col-md-12">
                <div class="box box-solid">
                    <div class="box-header bg-primary text-white">
                          <h3 class="box-title"><i class="fa fa-pie-chart"></i> Agregar categoría</h3>
                    </div>
                    <div class="box-body">
                        <div>    
                            <!-- name -->
                            <div class="form-group">
                                <input type="text" id="catId" name="catId" class="form-control question_hide" hidden="hidden">
                            </div>

                            <div class="form-group">
                                <label for="catName" class="col-form-label"><i class="fa fa-filter text-azuld"></i> Nombre de la categoría <b class="text-red">*</b></label>
                                <input type="text" id="catName" name="catName" class="form-control req irna" placeholder="" required>
                            </div>

                            <!-- description -->
                            <div class="form-group">
                                <label for="catDescription" class="col-form-label"><i class="fa fa-file-text text-azuld"></i> Descripción <b class="text-red">*</b></label>
                                <textarea type="text" id="catDescription" name="catDescription" style="height: 300px;" class="form-control req irna" placeholder="" required></textarea>
                            </div>
                            <!-- btn save -->
                            <div class="form-group">
                                <button id="checkFormCategory" type="submit" class="btn bg-verde btn-block"><b>Guardar</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="deletesuccess" class="alert alert-success alert-dismissible" hidden="true">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span class="response"></span><br>
                </div>
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
                    <tr>
                        <th class="bg-gray">#</th>
                        <th class="bg-gray">Categoría</th>
                        <th class="bg-gray">Descripcioón</th>
                        <th class="bg-gray" style="width: 150px;">Acciones</th>
                    </tr>
                    <tbody id="body-cat">
                    </tbody>
                </table>
            </div>
        </form>
    </section>

</div>