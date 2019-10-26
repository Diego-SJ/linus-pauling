<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model {

	function printPDFAlumnos($idUsuario,$membrete,$asunto,$fecha,$by,$order) {

		$select = array();
		$thead = "";
		$tsizeText = "";
		$num_columns = 0;

		if($this->input->post('aNombre') == true){array_push($select, "nombre");$num_columns++;$thead .="<th>Nombre</th>";} 
		if($this->input->post('aApellP') == true){array_push($select, "a_paterno");$num_columns++; $thead .="<th>A. Paterno</th>";}
		if($this->input->post('aApellM') == true){array_push($select, "a_materno");$num_columns++; $thead .="<th>A. Materno</th>";} 
		if($this->input->post('aGrado') == true){array_push($select, "grado");$num_columns++; $thead .="<th>Grado</th>";} 
		if($this->input->post('aGrupo') == true){array_push($select, "grupo");$num_columns++; $thead .="<th>Grupo</th>";} 
		if($this->input->post('aUsuario') == true){array_push($select, "usuario");$num_columns++; $thead .="<th>Usuario</th>";}
		if($this->input->post('aPassword') == true){array_push($select, "password");$num_columns++; $thead .="<th>Contraseña</th>";} 
		if($this->input->post('aLecturas') == true){array_push($select, "lecturas");$num_columns++; $thead .="<th>Lecturas completadas</th>";} 
		if($this->input->post('aAciertos') == true){array_push($select, "aciertos");$num_columns++; $thead .="<th>Total de aciertos</th>";} 
		if($this->input->post('aIncorrectos') == true){array_push($select, "incorrectos");$num_columns++; $thead .="<th>Total de incorrectas</th>";}
		if($this->input->post('aPromedio') == true){array_push($select, "promedio");$num_columns++; $thead .="<th>Promedio general</th>";} 

		$tsizeText = $this->countColumns($num_columns); 

		$this->db->order_by($by, $order);
		$this->db->where("idUsuario",$idUsuario);
		$this->db->select($select);
		$resultados = $this->db->get("vw_reports_alumnos");
		
		$header = $this->headerPDF($membrete,$asunto,$fecha);
		$output = $header.'
			<table id="tablePDF" class="table table-striped table-bordered text-center" style="width:100%;">
				<tbody style="font-size:'.$tsizeText.'px">
					<tr>
						<th>#</th>
						'.$thead.'
					</tr>';
				$index = 1;
				foreach($resultados->result() as $row)
				{
					$output .= '
					<tr>
						<td>'.$index++.'</td>';
					if($this->input->post('aNombre') == true){
						$output .="<td>".$row->nombre."</td>";} 
					if($this->input->post('aApellP') == true){
						$output .="<td>".$row->a_paterno."</td>";}
					if($this->input->post('aApellM') == true){
						$output .="<td>".$row->a_materno."</td>";} 
					if($this->input->post('aGrado') == true){
						$output .="<td>".$row->grado."</td>";} 
					if($this->input->post('aGrupo') == true){
						$output .="<td>".$row->grupo."</td>";} 
					if($this->input->post('aUsuario') == true){
						$output .="<td>".$row->usuario."</td>";}
					if($this->input->post('aPassword') == true){
						$output .="<td>".$row->password."</td>";} 
					if($this->input->post('aLecturas') == true){
						$output .="<td>".$row->lecturas."</td>";} 
					if($this->input->post('aAciertos') == true){
						$output .="<td>".$row->aciertos."</td>";} 
					if($this->input->post('aIncorrectos') == true){
						$output .="<td>".$row->incorrectos."</td>";}
					if($this->input->post('aPromedio') == true){
						$output .="<td>".$row->promedio."</td>";} 
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

		if($this->input->post('lTtitulo') == true){array_push($select, "titulo");$num_columns++;$thead .="<th>Título</th>";} 
		if($this->input->post('lAutor') == true){array_push($select, "autor");$num_columns++; $thead .="<th>Autor</th>";}
		if($this->input->post('lDescripcion') == true){array_push($select, "desc_corta");$num_columns++; $thead .="<th>Descripción</th>";} 
		if($this->input->post('lFecha') == true){array_push($select, "fecha_creacion");$num_columns++; $thead .="<th>Fecha creación</th>";} 
		if($this->input->post('lTipo') == true){array_push($select, "tipo_lectura");$num_columns++; $thead .="<th>Tipo lectura</th>";} 
		if($this->input->post('lReactivos') == true){$num_columns++; $thead .="<th>Reactivos</th>";}

		$tsizeText = $this->countColumns($num_columns); 

		$this->db->order_by($by, $order);
		$this->db->where("idUsuario",$idUsuario);
		$this->db->select($select);
		$resultados = $this->db->get("Lectura");
		
		$header = $this->headerPDF($membrete,$asunto,$fecha);
		$output = $header.'
			<table id="tablePDF" class="table table-striped table-bordered text-center" style="width:100%;">
				<thead>
					<tr>
						<th>#</th>
						'.$thead.'
					</tr>
				</thead>
				<tbody style="font-size: 12px">';
				$index = 1;
				foreach($resultados->result() as $row){
					$output .= '
					<tr>
						<td>'.$index++.'</td>';
					if($this->input->post('lTtitulo') == true){
						$output .="<td>".$row->titulo."</td>";} 
					if($this->input->post('lAutor') == true){
						$output .="<td>".$row->autor."</td>";}
					if($this->input->post('lDescripcion') == true){
						$output .="<td>".$row->desc_corta."</td>";} 
					if($this->input->post('lFecha') == true){
						$output .="<td>".$row->fecha_creacion."</td>";} 
					if($this->input->post('lTipo') == true){
						$output .=($row->tipo_lectura == 1)?"<td>Personalizado</td>":"<td>PDF</td>";} 
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
		</head>
		<body>
		<hr class="hr-table text-center">
			<section class="invoice membrete" style="border: 0px !important;">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="page-header text-center text-navy" style="margin: 5px 0px 5px 0px !important; padding: 0px !important;">
						<i class="fa fa-globe"></i> '.$membrete.'
						</h2>
					</div>
				</div>
				<hr class="hr-membrete">
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