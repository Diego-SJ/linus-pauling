<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model {

	function printPDFAlumnos($idUsuario,$membrete,$asunto,$fecha,$by,$order) {

		$select = array();
		$thead = "";
		$tsizeText = "";
		$num_columns = 0;

		if($this->input->post('aNombre') == true){array_push($select, "nombre");$num_columns++;$thead .="<th class=\"tva\">Nombre</th>";} 
		if($this->input->post('aApellP') == true){array_push($select, "a_paterno");$num_columns++; $thead .="<th class=\"tva\">A. Paterno</th>";}
		if($this->input->post('aApellM') == true){array_push($select, "a_materno");$num_columns++; $thead .="<th class=\"tva\">A. Materno</th>";} 
		if($this->input->post('aGrado') == true){array_push($select, "grado");$num_columns++; $thead .="<th class=\"tva\">Grado</th>";} 
		if($this->input->post('aGrupo') == true){array_push($select, "grupo");$num_columns++; $thead .="<th class=\"tva\">Grupo</th>";} 
		if($this->input->post('aUsuario') == true){array_push($select, "usuario");$num_columns++; $thead .="<th class=\"tva\">Usuario</th>";}
		if($this->input->post('aPassword') == true){array_push($select, "password");$num_columns++; $thead .="<th class=\"tva\">Contraseña</th>";} 
		if($this->input->post('aLecturas') == true){array_push($select, "lecturas");$num_columns++; $thead .="<th class=\"tva\">Lecturas completadas</th>";} 
		if($this->input->post('aAciertos') == true){array_push($select, "aciertos");$num_columns++; $thead .="<th class=\"tva\">Total de aciertos</th>";} 
		if($this->input->post('aIncorrectos') == true){array_push($select, "incorrectos");$num_columns++; $thead .="<th class=\"tva\">Total de incorrectas</th>";}
		if($this->input->post('aPromedio') == true){array_push($select, "promedio");$num_columns++; $thead .="<th class=\"tva\">Promedio general</th>";} 

		$tsizeText = $this->countColumns($num_columns); 

		$this->db->order_by($by, $order);
		$this->db->where("idUsuario",$idUsuario);
		$this->db->select($select);
		$resultados = $this->db->get("vw_reports_alumnos");
		
		$header = $this->headerPDF($membrete,$asunto,$fecha);
		$output = $header.'
			<br>
			<table id="tablePDF" class="table table-striped table-bordered text-center" style="width:100%;">
				<tbody style="font-size:'.$tsizeText.'px">
					<tr class="bg-gray">
						<th class="tva">#</th>
						'.$thead.'
					</tr>';
				$index = 1;
				foreach($resultados->result() as $row)
				{
					$output .= '
					<tr>
						<td>'.$index++.'</td>';
					if($this->input->post('aNombre') == true){
						$output .="<td class=\"tva\">".$row->nombre."</td>";} 
					if($this->input->post('aApellP') == true){
						$output .="<td class=\"tva\">".$row->a_paterno."</td>";}
					if($this->input->post('aApellM') == true){
						$output .="<td class=\"tva\">".$row->a_materno."</td>";} 
					if($this->input->post('aGrado') == true){
						$output .="<td class=\"tva\">".$row->grado."</td>";} 
					if($this->input->post('aGrupo') == true){
						$output .="<td class=\"tva\">".$row->grupo."</td>";} 
					if($this->input->post('aUsuario') == true){
						$output .="<td class=\"tva\">".$row->usuario."</td>";}
					if($this->input->post('aPassword') == true){
						$output .="<td class=\"tva\">".$row->password."</td>";} 
					if($this->input->post('aLecturas') == true){
						$output .="<td class=\"tva\">".$row->lecturas."</td>";} 
					if($this->input->post('aAciertos') == true){
						$output .="<td class=\"tva\">".$row->aciertos."</td>";} 
					if($this->input->post('aIncorrectos') == true){
						$output .="<td class=\"tva\">".$row->incorrectos."</td>";}
					if($this->input->post('aPromedio') == true){
						$output .="<td class=\"tva\">".$row->promedio."</td>";} 
					$output .= '
					</tr>
					';
				}
		$output .='
				</tbody>
			</table>
		</body>
		</html>';
		return $output;
	}

	function printPDFLecturas($idUsuario,$membrete,$asunto,$fecha,$by,$order) {

		$select    = array();
		array_push($select, "idLectura");
		$thead     = "";
		$tsizeText = "";
		$num_columns = 0;

		if($this->input->post('lTtitulo') == true){array_push($select, "titulo");$num_columns++;$thead .="<th class=\"tva\">Título</th>";} 
		if($this->input->post('lAutor') == true){array_push($select, "autor");$num_columns++; $thead .="<th class=\"tva\">Autor</th>";}
		if($this->input->post('lDescripcion') == true){array_push($select, "desc_corta");$num_columns++; $thead .="<th class=\"tva\">Descripción</th>";} 
		if($this->input->post('lFecha') == true){array_push($select, "fecha_creacion");$num_columns++; $thead .="<th class=\"tva\">Fecha creación</th>";} 
		if($this->input->post('lTipo') == true){array_push($select, "tipo_lectura");$num_columns++; $thead .="<th class=\"tva\">Tipo lectura</th>";} 
		if($this->input->post('lReactivos') == true){$num_columns++; $thead .="<th>Reactivos</th>";}

		$tsizeText = $this->countColumns($num_columns); 

		$this->db->order_by($by, $order);
		$this->db->where("idUsuario",$idUsuario);
		$this->db->select($select);
		$resultados = $this->db->get("Lectura");
		
		$header = $this->headerPDF($membrete,$asunto,$fecha);
		$output = $header.'
			<br>
			<table class="table table-striped table-bordered text-center" style="width:100%; vertical-align:middle !important;">
				<thead>
					<tr class="bg-gray">
						<th class="tva">#</th>
						'.$thead.'
					</tr>
				</thead>
				<tbody style="font-size: 12px">';
				$index = 1;
				foreach($resultados->result() as $row){
					$output .= '
					<tr>
						<td class="tva">'.$index++.'</td>';
					if($this->input->post('lTtitulo') == true){
						$output .="<td class=\"tva\">".$row->titulo."</td>";} 
					if($this->input->post('lAutor') == true){
						$output .="<td class=\"tva\">".$row->autor."</td>";}
					if($this->input->post('lDescripcion') == true){
						$output .="<td class=\"tva\">".$row->desc_corta."</td>";} 
					if($this->input->post('lFecha') == true){
						$output .="<td class=\"tva\">".$row->fecha_creacion."</td>";} 
					if($this->input->post('lTipo') == true){
						$output .=($row->tipo_lectura == 1)?"<td class=\"tva\">Personalizado</td>":"<td class=\"tva\">PDF</td>";} 
					if($this->input->post('lReactivos') == true){
						$consult = '
						SELECT COUNT(idCategoria) as num_by_cat, nombre, SUM(idOpcionMultiple) as check_om,
						SUM(idRelacionarColumnas) as check_rc, SUM(idVerdaderoFalso) as check_vf FROM vw_reports_lecturas
						where idLectura = '.$row->idLectura.' and idUsuario = '.$idUsuario.'
						group by nombre';
						$sub_row = $this->db->query($consult);
						$om = 0; $rc =0; $vf=0;
						$list_reactives = "<ul style=\"font-size:10px; list-style:none; padding: 5px !important;\">";
						$list_reactives .= "<li><b>Categorias:</b></li>";
						foreach($sub_row->result() as $content){
							($content->check_om > 0)?$om++:0;
							($content->check_rc > 0)?$rc++:0;
							($content->check_vf > 0)?$vf++:0;
							$list_reactives .= "<li>$content->nombre: <b>$content->num_by_cat</b></li>";
						}
						$list_reactives .= "</ul><ul style=\"font-size:10px; list-style:none; padding: 5px !important;\">";
						$list_reactives .= "<li><b>Tipos:</b></li>";
						$list_reactives .= ($om > 0)?"<li>Opción multiple</li>":"";
						$list_reactives .= ($rc > 0)?"<li>Relacionar columnas</li>":"";
						$list_reactives .= ($vf > 0)?"<li>Verdadero falso</li>":"";
						$list_reactives .= "</ul>";
						$output .="<td style=\"text-align:left !important;\"> $list_reactives </td>";
					}
					$output .= '
					</tr>
					';
				}
		$output .='
				</tbody>
			</table>
		</body>
		</html>';
		return $output;
	}

	function printPDFAlumno($idUsuario,$membrete,$asunto,$fecha,$idAlumno) {
		$this->load->model("Web/Alumno_model");
        $this->load->model("Web/admin/Indicadores_model");
		$info_student = "";
		
		if($idAlumno != ''){
			$header = $this->headerPDF($membrete,$asunto,$fecha);

			// QUERY ALUMNO DATA
			$this->db->where("idAlumno",$idAlumno);
			$alumno = $this->db->get("Alumno");
			$a = $alumno->row();

			$info_student .= '
			<br>
			<p>Información del alumno:</p>
			<table class="table table-striped table-bordered text-center" style="width:100%;">
				<tbody>
					<tr>
						<th class="bg-gray" style="vertical-align:middle !important;">Alumno:</th>
						<td style="vertical-align:middle !important;">'.$a->nombre.' '.$a->a_paterno.' '.$a->a_materno.'</td>
						<th class="bg-gray" style="vertical-align:middle !important;">Usuario:</th>
						<td style="vertical-align:middle !important;">'.$a->usuario.'</td>
						<th class="bg-gray" style="vertical-align:middle !important;">Grado:</th>
						<td style="vertical-align:middle !important;">'.$a->grado.'</td>
						<th class="bg-gray" style="vertical-align:middle !important;">Grupo</th>
						<td style="vertical-align:middle !important;">'.$a->grupo.'</td>
					</tr>
				</tbody>
			</table>';

			//QUERY ALUMNO PROGRESS
			$this->db->where("idAlumno",$idAlumno);
			$alumnoDetail = $this->db->get("vw_docente_aludetail_progress");
			$ad = $alumnoDetail->row();

			$info_student .= '
			<p>Progreso general:</p>
			<table class="table table-striped table-bordered text-center" style="width:100%;">
				<tbody>
					<tr class="bg-gray">
						<th style="vertical-align:middle !important;">Lecturas completadas</th>
						<th style="vertical-align:middle !important;">Aciertos totales</th>
						<th style="vertical-align:middle !important;">Incorrectos totales</th>
						<th style="vertical-align:middle !important;">Promedio general</th>
					</tr>
					<tr style="text-align: center !important;">
						<td><span class="badge bg-azul">'.((!empty($ad->lecturas))?$ad->lecturas:'0').'</span></td>
						<td><span class="badge bg-verde">'.((!empty($ad->aciertos))?$ad->aciertos:'0').'</span></td>
						<td><span class="badge bg-red">'.((!empty($ad->incorrectos))?$ad->incorrectos:'0').'</span></td>
						<td><span class="badge bg-yellow">'.((!empty($ad->promedio))?$ad->promedio:'0').'</span></td>
					</tr>
				</tbody>
			</table>';

			//QUERY ALUMNO APROVECHAMIENTO
			$categorias = $this->Indicadores_model->getCategories();
			$correctas  = $this->Alumno_model->getCorrectsChart2($idAlumno);
			$incorrectas = $this->Alumno_model->getIncorrectsChart2($idAlumno);

			$num_ac = 0;
			$num_inc = 0;
			$info_student .= '
			<p>Aprovechamiento general:</p>
			<table class="table table-striped table-bordered text-center" style="width:100%;">
				<thead>
					<tr class="bg-gray">
						<th style="vertical-align:middle !important;">Categoría</th>
						<th style="vertical-align:middle !important;">Aprovechamiento</th>
					</tr>
				</thead>
				<tbody>';
			foreach($categorias as $row){

				foreach($correctas as $row2){
					if($row->nombre == $row2->nombre){
						$num_ac = $row2->correctas;
					} 
				}

				foreach($incorrectas as $row3){
					if($row->nombre == $row3->nombre){
						$num_inc = $row3->incorrectas;
					} 
				}

				$info_student .= '
				<tr>
					<td style="vertical-align:middle !important;">'.$row->nombre.'</td>
					<td style="vertical-align:middle !important;">'.(($num_ac == 0 && $num_inc == 0)?'0%':(round(100/($num_ac+$num_inc))*$num_ac).'%').'</td>
				</tr>';
				$num_inc = 0;
				$num_ac = 0;
				$percent = 0;
			}

			$info_student .= '
				</tbody>
			</table>';

			if($this->input->post('adLogros') == true){
				$this->db->where("idAlumno",$idAlumno);
				$logros = $this->db->get("Logros");
				$logro = $logros->result();

				$info_student .= '
				<p>Logros obtenidos:</p>
				<table class="table table-striped table-bordered text-center" style="width:100%;">
					<thead>
						<tr class="bg-gray">
							<th style="vertical-align:middle !important;">Nombre logro</th>
							<th style="vertical-align:middle !important;">Descripción</th>
						</tr>
					</thead>
					<tbody>';

				foreach($logro as $l){
					$info_student .= '
					<tr>
						<td style="vertical-align:middle !important;">'.$l->nombre.'</td>
						<td style="vertical-align:middle !important;">'.$l->descripcion.'</td>
					</tr>';
				}
				$info_student .= '
					</tbody>
				</table>';
			} 

			if($this->input->post('adDetalles') == true){
				$this->db->where("idAlumno",$idAlumno);
				$lecturas = $this->db->get("vw_docente_aludetail_lecturasfinalizadas");
				$lectura = $lecturas->result();

				$info_student .= '
				<p>Lecturas finalizadas:</p>
				<table class="table table-striped table-bordered text-center" style="width:100%;">
					<thead>
						<tr class="bg-gray">
							<th style="vertical-align:middle !important;">Título</th>
							<th style="vertical-align:middle !important;">Aciertos</th>
							<th style="vertical-align:middle !important;">Incorrectos</th>
							<th style="vertical-align:middle !important;">Calificación</th>
							<th style="vertical-align:middle !important;">Fecha de conclusión</th>
						</tr>
					</thead>
					<tbody>';

				foreach($lectura as $l){
					$info_student .= '
					<tr>
						<td style="vertical-align:middle !important;">'.$l->titulo.'</td>
						<td style="vertical-align:middle !important;"><span class="badge bg-verde">'.$l->aciertos.'</span></td>
						<td style="vertical-align:middle !important;"><span class="badge bg-red">'.$l->incorrectos.'</span></td>
						<td style="vertical-align:middle !important;"><span class="badge bg-yellow">'.$l->calificacion.'</span></td>
						<td style="vertical-align:middle !important;">'.$l->fecha.'</td>
					</tr>';
				}
				$info_student .= '
					</tbody>
				</table>';
			} 

			return $header.$info_student;
		} else {
			$info_student ='
			<h3>Llena de nuevo el formulario.</h3>
			';

			return $info_student;
		}
	}

	function printPDFLectura($idUsuario,$membrete,$asunto,$fecha,$idLectura) {
		$this->load->model("Web/Lectura_model");
		$this->load->model("Movil/Actividades_modelo");
		$info_lectura = "";
		
		if($idLectura != ''){
			$idUsuario = $this->session->userdata('USER_ID');
			$header = $this->headerPDF($membrete,$asunto,$fecha);

			// QUERY ALUMNO DATA
			$this->db->where("idLectura",$idLectura);
			$lectura = $this->db->get("Lectura");
			$lec = $lectura->row();

			$info_lectura .= '
			<br>
			<p>Información de la lectura:</p>
			<table class="table table-striped table-bordered text-center" style="width:100%;">
				<tbody>
					<tr>
						<th class="bg-gray" style="vertical-align:middle !important;">Título:</th>
						<td style="vertical-align:middle !important;">'.$lec->titulo.'</td>
						<th class="bg-gray" style="vertical-align:middle !important;">Autor:</th>
						<td style="vertical-align:middle !important;">'.$lec->autor.'</td>
					</tr>
					<tr>
						<th class="bg-gray" style="vertical-align:middle !important;">Descripción:</th>
						<td style="vertical-align:middle !important;">'.$lec->desc_corta.'</td>
						<th class="bg-gray" style="vertical-align:middle !important;">Fecha de creación</th>
						<td style="vertical-align:middle !important;">'.$lec->fecha_creacion.'</td>
					</tr>
				</tbody>
			</table>';

			//QUERY INFO REACTIVOS
			if($this->input->post('ldInforeact') == true){
				$consult = '
				SELECT COUNT(idCategoria) as num_by_cat, nombre, SUM(idOpcionMultiple) as check_om,
				SUM(idRelacionarColumnas) as check_rc, SUM(idVerdaderoFalso) as check_vf FROM vw_reports_lecturas
				where idLectura = '.$idLectura.' and idUsuario = '.$idUsuario.'
				group by nombre';
				$sub_row = $this->db->query($consult);
				$om = 0; $rc =0; $vf=0;
				$list_1 = ""; $list_2 = "";

				$info_lectura .= '
				<p>Información sobre los reactivos:</p>
				<table class="table table-striped table-bordered text-center" style="width:100%;">
					<thead>
						<tr class="bg-gray">
							<th style="vertical-align:middle !important;">Categorías que abarca esta lectura</th>
							<th style="vertical-align:middle !important;">Reactivos que hay en la lectura</th>
						</tr>
					</thead>
					<tbody>';

				$list_1 = "<ul style=\"list-style:none; padding: 5px !important;\">";
				foreach($sub_row->result() as $content){
					($content->check_om > 0)?$om++:0;
					($content->check_rc > 0)?$rc++:0;
					($content->check_vf > 0)?$vf++:0;
					$list_1 .= "<li>$content->nombre: <b>$content->num_by_cat</b></li>";
				}
				$list_1 .= "</ul>";

				$list_2 .= "<ul style=\"list-style:none; padding: 5px !important;\">";
				$list_2 .= ($om > 0)?"<li>Opción multiple</li>":"";
				$list_2 .= ($rc > 0)?"<li>Relacionar columnas</li>":"";
				$list_2 .= ($vf > 0)?"<li>Verdadero falso</li>":"";
				$list_2 .= "</ul>";

				$info_lectura .="
					<tr>
						<td style=\"text-align:left !important;\">".$list_1."</td>
						<td style=\"text-align:left !important;\">".$list_2."</td>
					</tr>
					</tbody>
				</table>";
			} 

			//QUERY ALUMNO THAT FINISHED THIS LECTURA
			if($this->input->post('ldAlumnos') == true){
				$this->db->where('idEstado', "5");
				$this->db->where('idLectura', $idLectura);
				$resultado = $this->db->get('vw_docente_lecdetail_tablealumnos');
				$ad = $resultado->result();

				$info_lectura .= '
				<p>Alumnos que han completado esta lectura:</p>
				<table class="table table-striped table-bordered text-center" style="width:100%;">
					<thead>
						<tr class="bg-gray">
							<th style="vertical-align:middle !important;">Alumno</th>
							<th style="vertical-align:middle !important;">Grado y grupo</th>
							<th style="vertical-align:middle !important;">Aciertos</th>
							<th style="vertical-align:middle !important;">Incorrectos</th>
							<th style="vertical-align:middle !important;">Calificación</th>
						</tr>
					</thead>
					<tbody>';

				foreach($ad as $alumno){
					$info_lectura .= '
					<tr>
						<td style="vertical-align:middle !important;">'.$alumno->nombre.'</td>
						<td style="vertical-align:middle !important;">'.$alumno->gyg.'</td>
						<td style="vertical-align:middle !important;">'.$alumno->aciertos.'</td>
						<td style="vertical-align:middle !important;">'.$alumno->incorrectos.'</td>
						<td style="vertical-align:middle !important;">'.$alumno->calificacion.'</td>
					</tr>';
				}
				$info_lectura .= '
					</tbody>
				</table>';
			} 

			//QUERY TEST
			if($this->input->post('ldCuestionario') == true){
				$react_om = $this->Actividades_modelo->getReactOMByLectura($idLectura,$idUsuario);
				$react_rc = $this->Actividades_modelo->getReactRCByLectura($idLectura,$idUsuario);
				$react_vf = $this->Actividades_modelo->getReactVFByLectura($idLectura,$idUsuario);
				$index = 1;
				$info_lectura .= '
					<p>Cuestionario:</p>';
				if($react_om != ''){
					$info_lectura .= '
					<p><i>Lee la oración y elije la reespuesta correcta.</i></p>
					<table class="text-left" style="width:100%; border: 0px !important;">
						<tbody>';
					foreach($react_om as $om){
						$info_lectura .= '
						<tr><th>'.$index.') '.$om->pregunta.'</th><th></th><th></th><th></th></tr>
						<tr>
							<td style="padding-bottom: 20px !important;">A) '.$om->resp_1.'</td>
							<td style="padding-bottom: 20px !important;">B) '.$om->resp_2.'</td>
							<td style="padding-bottom: 20px !important;">C) '.$om->resp_3.'</td>
							<td style="padding-bottom: 20px !important;">D) '.$om->resp_4.'</td>
						</tr>';
						$index++;
					}
					$info_lectura .= '
						</tbody>
					</table>';
				}
				if($react_vf != ''){
					$info_lectura .= '
					<p><i>Lee la oración y escribe sobre la línea si es verdadero (V) o falso (F).</i></p>
					<table class="text-left" style="width:100%; border: 0px !important;">
						<tbody>';
					foreach($react_vf as $vf){
							$info_lectura .= '
							<tr>
								<td style="padding-bottom: 20px !important;">
									<b>'.$index.') '.$vf->pregunta.'. __________<b>
								</td>
							</tr>';
							$index++;
					}
					$info_lectura .= '
						</tbody>
					</table>';
				}
				if($react_rc != ''){
					$info_lectura .= '
					<p><i>Lee la oración y une con una línea la respuesta correcta.</i></p>
					<table class="text-left" style="width:100%; border: 0px !important;">
						<tbody>';
					foreach($react_rc as $rc){
							$info_lectura .= '
							<tr>
								<td style="padding-bottom: 10px !important;"><b>1) '.$rc->preg_1.'<b></td>
								<td style="padding-bottom: 10px !important;">A) '.$rc->resp_1.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>2) '.$rc->preg_2.'<b></td>
								<td style="padding-bottom: 10px !important;">B) '.$rc->resp_2.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>3) '.$rc->preg_3.'<b></td>
								<td style="padding-bottom: 10px !important;">C) '.$rc->resp_3.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>4) '.$rc->preg_4.'<b></td>
								<td style="padding-bottom: 10px !important;">D) '.$rc->resp_4.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>______________<b></td>
								<td style="padding-bottom: 10px !important;"></td>
							</tr>';
					}
					$info_lectura .= '
						</tbody>
					</table>';
				}
			} 

			//QUERY TEST RESOLVED
			if($this->input->post('ldCuestionarioResuelto') == true){
				$react_om = $this->Actividades_modelo->getReactOMByLectura($idLectura,$idUsuario);
				$react_rc = $this->Actividades_modelo->getReactRCByLectura($idLectura,$idUsuario);
				$react_vf = $this->Actividades_modelo->getReactVFByLectura($idLectura,$idUsuario);
				$index = 1;
				$info_lectura .= '
					<p class="text-azuld">Solución del cuestionario:</p>';
				if($react_om != ''){
					$info_lectura .= '
					<p><i>Lee la oración y elije la reespuesta correcta.</i></p>
					<table class="text-left" style="width:100%; border: 0px !important;">
						<tbody>';
					foreach($react_om as $om){
						$info_lectura .= '
						<tr><th>'.$index.') '.$om->pregunta.'</th><th></th><th></th><th></th></tr>
						<tr>
							<td style="padding-bottom: 20px !important;">'.(($om->resp_correcta == 'A')?'<u>A) '.$om->resp_1.'</u>':'A) '.$om->resp_1).'</td>
							<td style="padding-bottom: 20px !important;">'.(($om->resp_correcta == 'B')?'<u>B) '.$om->resp_2.'</u>':'B) '.$om->resp_1).'</td>
							<td style="padding-bottom: 20px !important;">'.(($om->resp_correcta == 'C')?'<u>C) '.$om->resp_3.'</u>':'C) '.$om->resp_1).'</td>
							<td style="padding-bottom: 20px !important;">'.(($om->resp_correcta == 'D')?'<u>D) '.$om->resp_4.'</u>':'D) '.$om->resp_1).'</td>
						</tr>';
						$index++;
					}
					$info_lectura .= '
						</tbody>
					</table>';
				}
				if($react_vf != ''){
					$info_lectura .= '
					<p><i>Lee la oración y escribe sobre la línea si es verdadero (V) o falso (F).</i></p>
					<table class="text-left" style="width:100%; border: 0px !important;">
						<tbody>';
					foreach($react_vf as $vf){
							$info_lectura .= '
							<tr>
								<td style="padding-bottom: 20px !important;">
									<b>'.$index.') '.$vf->pregunta.'. <b>'.(($vf->resp_correcta == 'verdadero')?'<u>V</u>':'<u>F</u>').'
								</td>
							</tr>';
							$index++;
					}
					$info_lectura .= '
						</tbody>
					</table>';
				}
				if($react_rc != ''){
					$info_lectura .= '
					<p><i>Lee la oración y une con una línea la respuesta correcta.</i></p>
					<table class="text-left" style="width:100%; border: 0px !important;">
						<tbody>';
					foreach($react_rc as $rc){
							$info_lectura .= '
							<tr>
								<td style="padding-bottom: 10px !important;"><b>1) '.$rc->preg_1.'<b></td>
								<td style="padding-bottom: 10px !important;">'.$rc->idx_r1.') '.$rc->resp_1.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>2) '.$rc->preg_2.'<b></td>
								<td style="padding-bottom: 10px !important;">'.$rc->idx_r2.') '.$rc->resp_2.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>3) '.$rc->preg_3.'<b></td>
								<td style="padding-bottom: 10px !important;">'.$rc->idx_r3.') '.$rc->resp_3.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>4) '.$rc->preg_4.'<b></td>
								<td style="padding-bottom: 10px !important;">'.$rc->idx_r4.') '.$rc->resp_4.'</td>
							</tr>
							<tr>
								<td style="padding-bottom: 10px !important;"><b>______________<b></td>
								<td style="padding-bottom: 10px !important;"></td>
							</tr>';
					}
					$info_lectura .= '
						</tbody>
					</table>';
				}
			} 

			return $header.$info_lectura;
		} else {
			$info_lectura ='
			<h3>Llena de nuevo el formulario.</h3>
			';

			return $info_lectura;
		}
	}
	
	function headerPDF($membrete,$asunto,$fecha){
		$header = '
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>Document</title>
			<link rel="stylesheet" href="'.base_url().'assets/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/theme/css/AdminLTE.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/theme/css/custom_theme.css">
			<link rel="stylesheet" href="'.base_url().'assets/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/theme/css/skins/_all-skins.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/datatables/css/dataTable.min.css">
		</head>
		<body>
		<hr class="hr-table text-center">
			<section class="invoice membrete" style="border: 0px !important;">
				<div class="row">
					<div class="col-xs-12">
						<h3 class="text-center text-navy header-text" style="margin: 5px 0px 5px 0px !important; padding: 0px !important;">
						<i class="fa fa-globe"></i> '.$membrete.'
						</h3>
					</div>
				</div>
				<div class="row invoice-info">
					<div class="col-sm-4 invoice-col text-navy">
						<b>Asunto:</b> '.$asunto.'<br>
						<b>Docente:</b> '.(ucwords($this->session->userdata('USER_NAME'))).'<br>
						<b>Fecha:</b> <span class="text-navy-active">'.$fecha.'</span>
					</div>
				</div>
			</section>
			<hr class="hr-table text-center">';



		return $header;
	}

	function countColumns($num_columns){
		$output = "14";
		if($num_columns == 10){
			$output = "13";
		} else if($num_columns > 10){
			$output = "10";
		}
		return $output;
	}
}

?>