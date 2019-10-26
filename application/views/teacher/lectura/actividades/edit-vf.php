

<div class="row">
    <div id="fila-actualizar-agregar-pagina" class="col-md-12">
      <div id="contenido-columna-pagina" class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body pad">
          <div class="form-group">
            <h4 for="num_pag" class="col-form-label text-yellow">
              <b><i class="fa fa-check-square-o"></i> EDITAR VERDADERO FALSO</b></h4>
            </div>

            <form id="frm_edit_vf" method="POST" 
            action="<?php echo site_url('Web/Actividades/updateVF');?>/<?php echo $ver_f->idVerdaderoFalso; ?>">

              <div class="row mb-1">
                <div class="col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon bg-maroon"><i class="fa fa-list"></i> Categoría</span>
                    <select id="ec_vf" name="ec_vf" class="form-control">
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

              <!-- DATA HIDDEN -->  
              <input id="reesp_vf" name="reesp_om" type="hidden" value="<?php echo $ver_f->resp_correcta; ?>" hidden="true">
              <input id="idCategoria" name="idCategoria" type="hidden" value="<?php echo $ver_f->idCategoria; ?>" hidden="true">
              <input id="idLectura" name="idLectura" type="hidden" value="<?php echo $id_lectura->idLectura; ?>" hidden="true">
                <div class="row">
                  <input name="tr_vf" type="text" value="2" hidden="true">
                    <div class="col-xs-12">
                      <div class="input-group">
                        <span class="input-group-addon bg-azul" style="height:20px !important;"><i class="fa  fa-question-circle"></i></span>
                        <input value="<?php echo $ver_f->pregunta; ?>" name="fvf_or" type="text" class="form-control" placeholder="Oración, pregunta, etc." required>
                        <span class="input-group-addon bg-azul">
                          <select id="slc_vf" name="fvf_slc" class="text-purple">
                            <option value="verdadero" selected>verdadero</option>
                            <option value="falso">falso</option>
                          </select>
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
                  var respuesta = $("#reesp_vf").val();
                  var categoria = $("#idCategoria").val();
                  console.log(categoria);
                  $("#slc_vf").val(respuesta);
                  $('#ec_vf ').val(categoria);
                  $('#frm_edit_vf').submit((e) => {
                    if($('#ec_vf option:selected').val() == 0){
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