

<!-- =====================.INICIO CONTENIDO ========================== -->
<div class="content-wrapper">

    <!--=========== Content Header (Page header) =========== -->
    <section class="content-header">
        <h1>Docentes registrados</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Web/admin/Home')?>"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-users"></i> Docentes</li>
        </ol>
    </section>
    <!--=========== Content Header (Page header) =========== -->

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="admin_docente" class="table table-bordered table-hover">
                            <thead class="bg-azul">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Apellido paterno</th>
                                    <th class="text-center">Apellido materno</th>
                                    <th class="text-center">Correo</th>
                                    <th class="text-center">Usuario</th>
                                    <th style="width: 20%" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $indice = 1; ?>
                                <?php if(!empty($t_Docentes)): ?>
                                    <?php foreach($t_Docentes as $docente): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $docente->idUsuario; ?></td>
                                            <td class="text-center"><?php echo $docente->nombre; ?></td>
                                            <td class="text-center"><?php echo $docente->a_paterno; ?></td>
                                            <td class="text-center"><?php echo $docente->a_materno; ?></td>
                                            <td class="text-center"><?php echo $docente->correo; ?></td>
                                            <td class="text-center"><?php echo $docente->usuario; ?></td>

                                            <td class="text-center">
                                                <a href="<?php echo site_url('Web/admin/lectura/lecturas_docente');?>/<?php echo $docente->idUsuario; ?>" class="btn bg-azul">
                                                    <span class="fa fa-book text-white"></span>
                                                </a>
                                                <a href="<?php echo site_url('Web/admin/Docente/studentsTeacher');?>/<?php echo $docente->idUsuario; ?>" value="<?php echo $docente->idUsuario; ?>" class="btn bg-verde">
                                                    <span class="fa fa-users text-white"></span>
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

                    


