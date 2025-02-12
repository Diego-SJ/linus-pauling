<div class="content-wrapper">

    <!--  Content Header (Page header)  -->
    <section class="content-header">
          <h1>
            Panel de administración
            <small>Inicio</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-home text-azuld"></i> Inicio</a></li>
        </ol>
    </section>
    <!-- Content Header (Page header)  -->

    <section class="content">
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-azul">
              <div class="inner">
                <h3>
                <?php if(!empty($teacher_alumnos)){ echo $teacher_alumnos->total_alumnos; } else { echo "0"; } ?>
                </h3>

                <p>Alumnos</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-verde">
              <div class="inner">
                <h3>
                <?php if(!empty($teacher_lecturas)){ echo $teacher_lecturas->total_lecturas; } else { echo "0"; } ?>    
                </h3>

                <p>Lecturas</p>
              </div>
              <div class="icon">
                <i class="fa fa-university"></i>
              </div>
              <a href="<?php echo site_url('Web/Lecturas')?>" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div id="disabled-button-form-ana" class="col-lg-3 col-xs-6 reg-alumno" data-toggle="modal" data-target="#modalNewAlumno">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>+</h3>
                <p>Registrar alumno</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <a class="small-box-footer"> Acceso directo <i class="fa fa-plus-circle"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-xs-6" data-toggle="modal" data-target="#addLecturaModal">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>+</h3>

                <p>Registrar lectura</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a class="small-box-footer"> Acceso directo <i class="fa fa-plus-circle"></i></a>
            </div>
          </div>
        </div>

        <div class="row">

          <!-- col 1 -->
          <div class="col-md-6">
            <div class="box-body bg-white">
              <p><h4><i class="fa fa-files-o text-azuld"></i> Reportes:</h4></p>
              <a type="button" class="btn btn-app" data-toggle="modal" data-target="#customPDFAlumnos">
                <span class="badge bg-azul"><b><i class="fa fa-cog txt-15"></i></b></span>
                <i class="fa fa-users"></i> PDF alumnos
              </a>
              <a type="button" class="btn btn-app" data-toggle="modal" data-target="#customPDFLecturas">
              <span class="badge bg-azul"><b><i class="fa fa-cog txt-15"></i></b></span>
                <i class="fa fa-book"></i> PDF lecturas
              </a>
              <a type="button" class="btn btn-app" data-toggle="modal" data-target="#customPDFAlumno">
              <span class="badge bg-azul"><b><i class="fa fa-cog txt-15"></i></b></span>
                <i class="fa fa-user"></i> PDF alumno
              </a>
              <a type="button" class="btn btn-app" data-toggle="modal" data-target="#customPDFLectura">
              <span class="badge bg-azul"><b><i class="fa fa-cog txt-15"></i></b></span>
                <i class="fa fa-bookmark"></i> PDF lectura
              </a>
            </div>
          </div>

          <!-- col 2 -->
          <div class="col-md-6">
            <?php 
              if(!empty($this->session->flashdata("error_one"))){
                      echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span>".$this->session->flashdata("error_one")."</span><br>";
                      echo "</div>";
              }
              if(!empty($this->session->flashdata("error_two"))){
                      echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span>".$this->session->flashdata("error_two")."</span><br>";
                      echo "</div>";
              }
              if(!empty($this->session->flashdata("error_three"))){
                      echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span>".$this->session->flashdata("error_three")."</span><br>";
                      echo "</div>";
              }
              if(!empty($this->session->flashdata("successUpdt"))){
                      echo "<div class='alert alert-success alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span>".$this->session->flashdata("successUpdt")."</span><br>";
                      echo "</div>";
              } 
            ?>
            <!-- perfil -->
            <div class="row">
              <div class="col-md-12">
                <div class="box box-solid collapsed-box">
                  <div class="box-header">
                    <i class="fa fa-user text-azuld"></i>
                    <h3 class="box-title">Editar datos del perfil</h3>
                    <div class="pull-right box-tools">
                      <button type="button" class="btn btn-azul btn-sm" data-widget="collapse"><i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="box-body">
                    <form class="form-horizontal" method="post" 
                          action="<?php echo site_url('Web/Home/updateUsuario')?>/<?php echo $teacher_info->idUsuario; ?>">
                        <!-- hidden -->
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputName" id="inputName" 
                            value="<?php if(!empty($teacher_info)){echo $teacher_info->nombre;} ?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPaterno" class="col-sm-2 control-label">A. paterno</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputPaterno" id="inputPaterno" 
                            value="<?php if(!empty($teacher_info)){echo $teacher_info->a_paterno;} ?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputMaterno" class="col-sm-2 control-label">A. materno</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputMaterno" id="inputMaterno"
                            value="<?php if(!empty($teacher_info)){echo $teacher_info->a_materno;} ?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputCorreo" class="col-sm-2 control-label">Correo</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" name="inputCorreo" id="inputCorreo"
                            value="<?php if(!empty($teacher_info)){echo $teacher_info->correo;} ?>" required="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-azul"><i class="fa fa-save"></i> Guardar cambios</button>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- password -->
            <div class="row">
              <div class="col-md-12">
                <div class="box box-solid collapsed-box">
                  <div class="box-header">
                    <i class="fa fa-lock text-azuld"></i>

                    <h3 class="box-title">Cambiar contraseña</h3>
                    <div class="pull-right box-tools">
                      <button type="button" class="btn btn-azul btn-sm" data-widget="collapse"><i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form class="form-horizontal" method="post" 
                          action="<?php echo site_url('Web/Home/updatePassword')?>/<?php echo $teacher_info->idUsuario; ?>">
                        <div class="form-group">
                          <label for="inputPassActual" class="col-sm-2 control-label">Contraseña actual</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="inputPassActual" id="inputPassActual" 
                            placeholder="******">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassActual" class="col-sm-2 control-label">Nueva contraseña</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="inputPassNueva" id="inputPassNew" placeholder="******" required pattern=".{8,}" title="Utiliza una mezcla de letras, números y/o carácteres especiales. La contraseña debe tener un minímo de 8 digítos">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassConfirm" class="col-sm-2 control-label">Confirmar contraseña</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="inputPassConfirm" id="inputPassConfirm" placeholder="******" required pattern=".{8,}" title="Utiliza una mezcla de letras, números y/o carácteres especiales. La contraseña debe tener un minímo de 8 digítos">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button id="btnUpdPass" type="button" class="btn btn-azul"><i class="fa fa-save"></i> Actualizar contraseña</button>
                            <button id="sendPass" type="submit" class="btn bg-blue">send</button>
                          </div>
                        </div>
                      </form>

                      <script type="text/javascript">
                        $(document).ready(function (){
                          
                        });
                      </script>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

    </section>
</div>

<!-- FIN CONTENIDO  -->

<div class="modal fade" id="customPDFAlumnos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="pdfAlumnosForm" method="post" action="<?php echo base_url().'Web/Reports/pdfAlumnos' ?>">
      <div class="modal-content">
        <div class="modal-body">
          <table class="table">
            <tbody class="text-center">
              <h4>Generar PDF</h4>
              <tr>
                <td>
                  <div class="row">
                    <h4>Encabezado:</h4>
                    <div class="col-md-6">
                      <div class="form-group">
                        Titulo membrete
                        <input id="alumnosTM" name="alumnosTM" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Asunto
                        <input id="alumnosA" name="alumnosA" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Fecha
                        <input id="alumnosF" name="alumnosF" type="date" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Nombre del pdf
                        <input id="alumnosNA" name="alumnosNA" type="text" class="form-control" required>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="row">
                    <h4>Selecciona los datos que deseas imprimir</h4>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aNombre" name="aNombre" type="checkbox"> Nombre
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aApellP" name="aApellP" type="checkbox"> Apellido paterno
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aApellM" name="aApellM" type="checkbox"> Apellido materno
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aUsuario" name="aUsuario" type="checkbox"> Usuario
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aPassword" name="aPassword" type="checkbox"> Contraseña
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aGrado" name="aGrado" type="checkbox"> Grado
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aGrupo" name="aGrupo" type="checkbox"> Grupo
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aLecturas" name="aLecturas" type="checkbox"> Lecturas completadas
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aAciertos" name="aAciertos" type="checkbox"> Aciertos totales
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aIncorrectos" name="aIncorrectos" type="checkbox"> Incorrectos totales
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="aPromedio" name="aPromedio" type="checkbox"> Promedio general
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="row">
                    <h4>Ordenar por:</h4>
                    <div class="col-md-6 col-xs-6">
                      <select id="alumnoFiltro" name="alumnoFiltro" class="form-control">
                        <option value="0">- elije un filtro -</option>
                        <option id="opt1" hidden="hidden" value="nombre">Nombre</option>
                        <option id="opt2" hidden="hidden" value="a_paterno">Apellido paterno</option>
                        <option id="opt3" hidden="hidden" value="a_materno">Apellido materno</option>
                        <option id="opt4" hidden="hidden" value="usuario">Usuario</option>
                        <option id="opt5" hidden="hidden" value="password">Contraseña</option>
                        <option id="opt6" hidden="hidden" value="grado">Grado</option>
                        <option id="opt7" hidden="hidden" value="grupo">Grupo</option>
                        <option id="opt8" hidden="hidden" value="lecturas">Lecturas completadas</option>
                        <option id="opt9" hidden="hidden" value="aciertos">Aciertos</option>
                        <option id="opt10" hidden="hidden" value="incorrectos">Incorrectos</option>
                        <option id="opt11" hidden="hidden" value="promedio">Promedio</option>
                      </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                      <select id="alumnoOrder" name="alumnoOrder" class="form-control">
                        <option value="asc">ascendente</option>
                        <option value="desc">descendente</option>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cancel-pdf" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary create-pdf"><i class="fa fa-print text-white"></i> Crear PDF</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="customPDFLecturas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="pdfLecturasForm" method="post" action="<?php echo base_url().'Web/Reports/pdfLecturas' ?>">
      <div class="modal-content">
        <div class="modal-body">
          <table class="table">
            <tbody class="text-center">
              <h4>Generar PDF</h4>
              <tr>
                <td>
                  <div class="row">
                    <h4>Encabezado:</h4>
                    <div class="col-md-6">
                      <div class="form-group">
                        Titulo membrete
                        <input id="lecturasTM" name="lecturasTM" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Asunto
                        <input id="lecturasA" name="lecturasA" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Fecha
                        <input id="lecturasF" name="lecturasF" type="date" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Nombre del pdf
                        <input id="lecturasNA" name="lecturasNA" type="text" class="form-control" required>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="row">
                    <h4>Selecciona los datos que deseas imprimir</h4>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="lTtitulo" name="lTtitulo" type="checkbox"> Título
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="lAutor" name="lAutor" type="checkbox"> Autor
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="lDescripcion" name="lDescripcion" type="checkbox"> Descripción
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="lFecha" name="lFecha" type="checkbox"> Fecha creación
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="lTipo" name="lTipo" type="checkbox"> Tipo lectura
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="lReactivos" name="lReactivos" type="checkbox"> Reactivos
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="row">
                    <h4>Ordenar por:</h4>
                    <div class="col-md-6 col-xs-6">
                      <select id="lecturasFiltro" name="lecturasFiltro" class="form-control">
                        <option value="0">- elije un filtro -</option>
                        <option id="opt1l" hidden="hidden" value="titulo">Título</option>
                        <option id="opt2l" hidden="hidden" value="autor">Autor</option>
                        <option id="opt3l" hidden="hidden" value="desc_corta">Descripción</option>
                        <option id="opt4l" hidden="hidden" value="fecha_creacion">Fecha creación</option>
                        <option id="opt5l" hidden="hidden" value="tipo_lectura">Tipo lectura</option>
                        <!-- <option id="opt6l" hidden="hidden" value="attemps">Reactivos</option> -->
                      </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                      <select id="lecturasOrder" name="lecturasOrder" class="form-control">
                        <option value="asc">ascendente</option>
                        <option value="desc">descendente</option>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cancel-pdf" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary create-pdf"><i class="fa fa-print text-white"></i> Crear PDF</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="customPDFAlumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="pdfAlumnoForm" method="post" action="<?php echo base_url().'Web/Reports/pdfAlumno' ?>">
      <div class="modal-content">
        <div class="modal-body">
          <table class="table">
            <tbody class="text-center">
              <h4>Generar PDF</h4>
              <tr>
                <td>
                  <div class="row">
                    <h4>Encabezado:</h4>
                    <div class="col-md-6">
                      <div class="form-group">
                        Titulo membrete
                        <input id="alumnoTM" name="alumnoTM" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Asunto
                        <input id="alumnoA" name="alumnoA" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Fecha
                        <input id="alumnoF" name="alumnoF" type="date" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Nombre del pdf
                        <input id="alumnoNA" name="alumnoNA" type="text" class="form-control" required>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="row">
                    <h4>Selecciona un alumno</h4>
                    <div class="col-sm-12">
                      <select id="adidAlumno" name="adidAlumno" class="form-control">
                        <option value="0">- elije un alumno -</option>
                        <?php 
                        if(!empty($alumnos)){
                          $options = "";
                          foreach($alumnos as $alumno){
                            $options .= "<option value=\"".$alumno->idAlumno."\">".$alumno->nombre." ".$alumno->a_paterno." ".$alumno->a_materno."</option>";
                          }
                          echo $options;
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="row">
                    <h4>Selecciona los datos que deseas imprimir</h4>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="adLogros" name="adLogros" type="checkbox"> Logros
                      </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="adDetalles" name="adDetalles" type="checkbox"> Lecturas completadas
                      </label>
                    </div>
                    <!-- <div class="col-md-4 col-sm-6 col-xs-6 more_detail" hidden="hidden">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="adResultados" name="adResultados" type="checkbox" alt="Resultados de la lectura como aciertos, incorrectas, etc."> Resultados
                      </label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6 more_detail" hidden="hidden">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="adAprovechamiento" name="adAprovechamiento" type="checkbox" alt="Aprovechamiento obtenido por categorías."> Aprovechamiento
                      </label>
                    </div> -->
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cancel-pdf" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary create-pdf"><i class="fa fa-print text-white"></i> Crear PDF</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="customPDFLectura" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="pdfLecturaForm" method="post" action="<?php echo base_url().'Web/Reports/pdfLectura' ?>">
      <div class="modal-content">
        <div class="modal-body">
          <table class="table">
            <tbody class="text-center">
              <h4>Generar PDF</h4>
              <tr>
                <td>
                  <div class="row">
                    <h4>Encabezado:</h4>
                    <div class="col-md-6">
                      <div class="form-group">
                        Titulo membrete
                        <input id="lecturaTM" name="lecturaTM" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Asunto
                        <input id="lecturaA" name="lecturaA" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Fecha
                        <input id="lecturaF" name="lecturaF" type="date" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Nombre del pdf
                        <input id="lecturaNA" name="lecturaNA" type="text" class="form-control" required>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="row">
                    <h4>Selecciona una lectura</h4>
                    <div class="col-sm-12">
                      <select id="ldidLectura" name="ldidLectura" class="form-control">
                        <option value="0">- elije una lectura -</option>
                        <?php 
                        if(!empty($lecturas)){
                          $options = "";
                          foreach($lecturas as $lectura){
                            $options .= "<option value=\"".$lectura->idLectura."\">".$lectura->titulo."</option>";
                          }
                          echo $options;
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="row">
                    <h4>Selecciona los datos que deseas imprimir</h4>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="ldInforeact" name="ldInforeact" type="checkbox"> Información reactivos 
                      </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="ldAlumnos" name="ldAlumnos" type="checkbox"> Alumnos que completarón esta lectura
                      </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 more_detail">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="ldCuestionario" name="ldCuestionario" type="checkbox"> Reactivos tipo cuestionario
                      </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 more_detail">
                      <label class="badge bg-gray btn btn-block mt-1 label-check">
                        <input id="ldCuestionarioResuelto" name="ldCuestionarioResuelto" type="checkbox"> Cuestionario con respuestas
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cancel-pdf" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary create-pdf"><i class="fa fa-print text-white"></i> Crear PDF</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/theme/js/reports-js.js"></script>