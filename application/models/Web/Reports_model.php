<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model {
	
	function getDataToPdf($idUsuario,$membrete,$title,$date) {
        $this->db->where("idUsuario",$idUsuario);
		$resultados = $this->db->get("Alumno");
		
		$output = '
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
						<b>Asunto:</b> '.$title.'<br>
						<b>Docente:</b> '.(ucwords($this->session->userdata('USER_NAME'))).'<br>
						<b>Fecha:</b> <span class="text-navy-active">'.$date.'</span>
					</div>
				</div>
			</section>
			<hr class="hr-table text-center">
			<table id="tablePDF" class="table table-striped table-bordered" style="width:100%;">
				<tbody>
					<tr>
						<th style="width: 10px">#</th>
						<th>Nombre</th>
						<th>A. Paterno</th>
						<th>A. Materno</th>
						<th>usuario</th>
						<th>Contraseña</th>
					</tr>';
				foreach($resultados->result() as $row)
				{
					$output .= '
					<tr>
						<td>1.</td>
						<td>'.$row->nombre.'</td>
						<td>'.$row->a_paterno.'</td>
						<td>'.$row->a_materno.'</td>
						<td>'.$row->usuario.'</td>
						<td>'.$row->password.'</td>
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
}

?>