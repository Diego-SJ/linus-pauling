

<div class="row">
    <div id="fila-actualizar-agregar-pagina" class="col-md-12">
      <div id="contenido-columna-pagina" class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body pad">
          <div class="form-group">
                    <h4 for="num_pag" class="col-form-label text-yellow"><b><i class="fa fa-exchange"></i> EDITAR RELACIONAR COLUMNAS</b></h4>
                </div>
            <form id="frm_edit_rc" method="POST" action="<?php echo site_url('Web/Actividades/updateRC')?>/<?php echo $rel_c->idRelacionarColumnas ?>">

                <!-- DATA HIDDEN -->  
                <input id="idLectura" name="idLectura" type="text" value="<?php echo $id_lectura->idLectura; ?>" hidden="true">
                <input id="idCategoriaRC" name="idCategoriaRC" type="hidden" value="<?php echo $rel_c->idCategoria; ?>" hidden="true">
                <input id="idx_r1" type="text" value="<?php echo $rel_c->idx_r1; ?>" hidden="true">
                <input id="idx_r2" type="text" value="<?php echo $rel_c->idx_r2; ?>" hidden="true">
                <input id="idx_r3" type="text" value="<?php echo $rel_c->idx_r3; ?>" hidden="true">
                <input id="idx_r4" type="text" value="<?php echo $rel_c->idx_r4; ?>" hidden="true">
                <div class="row mb-1">
                  <div class="col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon bg-maroon"><i class="fa fa-list"></i> Categoría</span>
                      <select id="ec_rc" name="ec_rc" class="form-control">
                        <option value="0">- selecciona una categoría -</option>
                        <?php 
                        $template = "";
                        foreach($categories as $row){
                          $template .="<option value=\"".$row->idCategoria."\">".$row->nombre."</option>";
                        }
                        echo $template;
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- tipoReactivo -->
                  <input name="tr_rc" type="text" value="3" hidden="true">
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">1)</span>
                        <input value="<?php echo $rel_c->preg_1; ?>" name="frc_o1" type="text" class="form-control" placeholder="Oración 1" required>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-gray">
                          <select id="slc_1" name="frc_slc1" class="">
                            <option name="frc_slc1" value="1">1</option>
                            <option name="frc_slc1" value="2">2</option>
                            <option name="frc_slc1" value="3">3</option>
                            <option name="frc_slc1" value="4">4</option>
                          </select>
                        </span>
                        <input value="<?php echo $rel_c->resp_1; ?>" name="frc_r1" type="text" class="form-control" placeholder="Respuesta" required>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">2)</span>
                        <input value="<?php echo $rel_c->preg_2; ?>" name="frc_o2" type="text" class="form-control" placeholder="Oración 2" required>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-gray">
                          <select id="slc_2" name="frc_slc2" class="">
                            <option name="frc_slc2" value="1">1</option>
                            <option name="frc_slc2" value="2">2</option>
                            <option name="frc_slc2" value="3">3</option>
                            <option name="frc_slc2" value="4">4</option>
                          </select>
                        </span>
                        <input value="<?php echo $rel_c->resp_2 ?>" name="frc_r2" type="text" class="form-control" placeholder="Respuesta" required>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">3)</span>
                        <input value="<?php echo $rel_c->preg_3 ?>" name="frc_o3" type="text" class="form-control" placeholder="Oración 3" required>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-gray">
                          <select id="slc_3" name="frc_slc3" class="">
                            <option name="frc_slc3" value="1">1</option>
                            <option name="frc_slc3" value="2">2</option>
                            <option name="frc_slc3" value="3">3</option>
                            <option name="frc_slc3" value="4">4</option>
                          </select>
                        </span>
                        <input value="<?php echo $rel_c->resp_3 ?>" name="frc_r3" type="text" class="form-control" placeholder="Respuesta" required>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">4)</span>
                        <input value="<?php echo $rel_c->preg_4 ?>" name="frc_o4" type="text" class="form-control" placeholder="Oración 4" required>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="input-group">
                        <span class="input-group-addon bg-gray">
                          <select id="slc_4" name="frc_slc4" class="">
                            <option name="frc_slc4" value="1">1</option>
                            <option name="frc_slc4" value="2">2</option>
                            <option name="frc_slc4" value="3">3</option>
                            <option name="frc_slc4" value="4" selected>4</option>
                          </select>
                        </span>
                        <input value="<?php echo $rel_c->resp_4 ?>" name="frc_r4" type="text" class="form-control" placeholder="Respuesta" required>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <h1></h1>
                  <div class="col-xs-12">
                    <button type="submit" class="btn bg-azul"><i class="fa fa-save"></i> Guardar cambios</button>
                    <button type="button" class="btn bg-gray" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button> 
                  </div>
                </div>
            </form>
            <script type="text/javascript">
              $(document).ready(function(){
                  var slc_index_1 = $("#idx_r1").val();
                  $("#slc_1").val(slc_index_1);

                  var slc_index_2 = $("#idx_r2").val();
                  $("#slc_2").val(slc_index_2);

                  var slc_index_3 = $("#idx_r3").val();
                  $("#slc_3").val(slc_index_3);

                  var slc_index_4 = $("#idx_r4").val();
                  $("#slc_4").val(slc_index_4);

                  var categoria = $("#idCategoriaRC").val();
                  console.log(categoria);
                  $('#ec_rc ').val(categoria);
                  $('#frm_edit_rc').submit((e) => {
                    if($('#ec_rc option:selected').val() == 0){
                      e.preventDefault();
                      alert('Selecciona una categoría');
                    } 
                  });
              });
            </script>
        </div>
      </div>
    </div>
</div>