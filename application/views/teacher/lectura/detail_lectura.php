


        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                      <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tabla_alumnos_lectura_detail" class="table table-bordered table-hover">
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
                            <tr>                                <td class="text-center"><?php echo $indice++; ?></td>
                                <td class="text-center"><?php echo $dal->nombre; ?></td>
                                <td class="text-center"><?php echo $dal->gyg; ?></td>
                                <td class="text-center"><?php echo $dal->aciertos; ?></td>
                                <td class="text-center"><?php echo $dal->incorrectos; ?></td>
                                <td class="text-center"><?php echo $dal->calificacion; ?></td>
                                <td class="text-center">
                                    <form method="post" action="<?php echo site_url('Web/Alumno/resultTest');?>" class="question_hide" hidden="hidden">
                                        <input type="text" class="question_hide" hidden="hidden" name="id_alumno" value="<?php echo $dal->idAlumno; ?>">
                                        <input type="text" class="question_hide" hidden="hidden" name="id_lectura" value="<?php echo $dal->idLectura; ?>">
                                        <button id="btn_id_<?php echo $dal->idAlumno; ?>" type="submit" class="btn bg-azul question_hide" hidden="hidden"></button>
                                    </form>
                                    <a class="btn bg-azul" onclick="updateUI('btn_id_<?php echo $dal->idAlumno; ?>')">
                                        <span class="fa fa-list text-white"></span>
                                    </a>
                                    <a href="<?php echo site_url('Web/Alumno/detail');?>/<?php echo $dal->idAlumno; ?>" class="btn bg-verde">
                                        <span class="fa fa-user text-white"></span>
                                    </a>
                                </td>
                            </tr>
                            <script>
                                function updateUI(id){
                                    document.getElementById(id).click();
                                }
                            </script>
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