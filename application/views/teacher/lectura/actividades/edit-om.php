

<div class="row">
    <div id="fila-actualizar-agregar-pagina" class="col-md-12">
      <div id="contenido-columna-pagina" class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body pad">
          <div class="form-group">
                    <h4 for="num_pag" class="col-form-label text-yellow"><b><i class="fa fa-list-ul"></i> EDITAR OPCIÓN MULTIPLE</b></h4>
                </div>
            <form id="frm_edit_om" method="POST" action="<?php echo site_url('Web/Actividades/updateOM');?>/<?php echo $opc_m->idOpcionMultiple; ?>">

                <!-- DATA HIDDEN -->  
                <input id="reesp_om" name="reesp_om" type="text" value="<?php echo $opc_m->resp_correcta; ?>" hidden="true">
                <input id="idLectura" name="idLectura" type="text" value="<?php echo $id_lectura->idLectura; ?>" hidden="true">
                <input id="idCategoriaOM" name="idCategoriaOM" type="hidden" value="<?php echo $opc_m->idCategoria; ?>" hidden="true">

                <div class="row mb-1">
                  <div class="col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon bg-maroon"><i class="fa fa-list"></i> Categoría</span>
                      <select id="ec_om" name="ec_om" class="form-control">
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
                    <div class="col-xs-12">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul"><i class="fa  fa-question-circle"></i> pregunta</span>
                        <input value="<?php echo $opc_m->pregunta; ?>" name="fom_pregunta" type="text" class="form-control" required>
                      </div>
                    </div>
                </div>
                <h4>Respuestas</h4>
                <div class="row">
                    <div class="col-xs-12">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul"> A)</span>
                        <input value="<?php echo $opc_m->resp_1; ?>" name="fom_resp1" type="text" class="form-control" required>
                        <span class="input-group-addon bg-gray">
                          <input id="resp_A" name="fom_resp_chk" value="A" type="radio">
                        </span>
                      </div>
                    </div>
                </div>
                <h4></h4>
                <div class="row">
                    <div class="col-xs-12">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">B)</span>
                        <input value="<?php echo $opc_m->resp_2; ?>" name="fom_resp2" type="text" class="form-control" required>
                        <span class="input-group-addon bg-gray">
                          <input id="resp_B" name="fom_resp_chk" value="B" type="radio">
                        </span>
                      </div>
                    </div>
                </div>
                <h4></h4>
                <div class="row">
                    <div class="col-xs-12">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">C)</span>
                        <input value="<?php echo $opc_m->resp_3; ?>" name="fom_resp3" type="text" class="form-control" required>
                        <span class="input-group-addon bg-gray">
                          <input id="resp_C" name="fom_resp_chk" value="C" type="radio">
                        </span>
                      </div>
                    </div>
                </div>
                <h4></h4>
                <div class="row">
                    <div class="col-xs-12">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul">D)</span>
                        <input value="<?php echo $opc_m->resp_4; ?>" name="fom_resp4" type="text" class="form-control" required>
                        <span class="input-group-addon bg-gray">
                          <input id="resp_D" name="fom_resp_chk" value="D" type="radio">
                        </span>
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
                  var respuesta = $("#reesp_om").val();

                  if(respuesta == "A"){
                    $("#resp_A").prop("checked",true);
                  } else if (respuesta == "B"){
                    $("#resp_B").prop("checked",true);
                  } else if (respuesta == "C"){
                    $("#resp_C").prop("checked",true);
                  } else {
                    $("#resp_D").prop("checked",true);
                  }

                  var categoria = $("#idCategoriaOM").val();
                  console.log(categoria);
                  $('#ec_om ').val(categoria);
                  $('#frm_edit_om').submit((e) => {
                    if($('#ec_om option:selected').val() == 0){
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