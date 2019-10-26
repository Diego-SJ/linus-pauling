<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model("Movil/Perfil_modelo");
		$this->load->model("Movil/Lectura_modelo");
		$this->load->model("Movil/Actividades_modelo");
		if($this->session->userdata('USER_ID') == '' || $this->session->userdata('USER_TYPE') != '1') {  
            redirect(base_url());  
        } 
	}

	public function index(){
	}

	public function opcion_multiple($id_lectura){
		if($this->Lectura_modelo->getInfoLectura($id_lectura)){
			$id_teacher  = $this->session->userdata('USER_TEACHER');
			$id_alumno   = $this->session->userdata('USER_ID');

			$data = array (
				'lectura'   => $this->Lectura_modelo->getInfoLectura($id_lectura),
				'reactivos' => $this->Actividades_modelo->getReactOMByLectura($id_lectura,$id_teacher),
				'lec_alumno'   => $this->Lectura_modelo->getLecturaDetailByStudent($id_lectura,$id_alumno),
			);

			$this->load->view('student/Layout/header');
			$this->load->view('student/lectura/activities/opcion-multiple',$data);
			$this->load->view('student/Layout/footer');
		} else {
			redirect(base_url()."Movil/Lecturas");  
		}
	}

	public function verdadero_falso($id_lectura){
		if($this->Lectura_modelo->getInfoLectura($id_lectura)){
			$id_teacher  = $this->session->userdata('USER_TEACHER');
			$id_alumno   = $this->session->userdata('USER_ID');

			$data = array (
				'lectura'   => $this->Lectura_modelo->getInfoLectura($id_lectura),
				'reactivos' => $this->Actividades_modelo->getReactVFByLectura($id_lectura,$id_teacher),
				'lec_alumno'   => $this->Lectura_modelo->getLecturaDetailByStudent($id_lectura,$id_alumno),
			);

			$this->load->view('student/Layout/header');
			$this->load->view('student/lectura/activities/verdadero-falso',$data);
			$this->load->view('student/Layout/footer');
		} else {
			redirect(base_url()."Movil/Lecturas");  
		}
	}

	public function relacionar_columnas($id_lectura){
		if($this->Lectura_modelo->getInfoLectura($id_lectura)){
			$id_teacher  = $this->session->userdata('USER_TEACHER');
			$id_alumno   = $this->session->userdata('USER_ID');
			
			$data = array (
				'lectura'   => $this->Lectura_modelo->getInfoLectura($id_lectura),
				'reactivos' => $this->Actividades_modelo->getReactRCByLectura($id_lectura,$id_teacher),
				'lec_alumno'   => $this->Lectura_modelo->getLecturaDetailByStudent($id_lectura,$id_alumno),
			);

			$this->load->view('student/Layout/header');
			$this->load->view('student/lectura/activities/relacionar-columnas', $data);
			$this->load->view('student/Layout/footer');
		} else {
			redirect(base_url()."Movil/Lecturas");  
		}
	}

	public function verificar_om($id_lectura){

		$id_alumno      = $this->session->userdata('USER_ID');
		$attemps_lec    = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
		$num_reactivos  = $this->input->post("num_r");
		$correctos      = $attemps_lec['aciertos'];
		$incorrectos    = $attemps_lec['incorrectos'];
		$correctos_aux  = 0;
		$incorrectos_aux= 0;
		$new_attemps    = array('intentos_om' => $attemps_lec['intentos_om']+1);

		if($this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$new_attemps)){

			$test_result= "<div class=\"box box-solid box-shadow-sm\">
			<div class=\"box-header bg-maroon\">
			<h3 class=\"box-title\">Tus resultados son los siguientes.</h3>
			</div>
			<div class=\"box-body\">
			<form method=\"post\" action=\"".base_url()."Movil/Actividades/finishTestOm/".$id_lectura."\">
			<input class=\"question_hide\" value=\"".$num_reactivos."\" name=\"num_r\" hidden='hidden'>";

			for ($i=1; $i <= $num_reactivos ; $i++) { 
				$id_om = $this->input->post("idrom".$i);
				$p_om  = $this->input->post("question".$i);
				$r_om  = $this->input->post("resp".$i);
				$status= $this->input->post("status_".$i);
				$idCategoria = $this->input->post("idcat".$i);

				$questionsTestArray [] = array(
					"idOpcionMultiple" => $id_om, 
					"answer" => ($r_om == '')?'sin responder':$r_om, 
					"status"           => ($r_om == $status)?'correct':'incorrect',
					"idAlumno" => $id_alumno,
					"idLectura" => $id_lectura,
					"idCategoria" => $idCategoria,
				);

				$test_result = $test_result."
				<div class=\"padding-square-no-top-bottom\">
				<blockquote class=\"no-padding bg-block-gray\">
				<input class=\"question_hide\" value=\"".$id_om."\" name=\"idrom".$i."\" hidden='hidden'>";

				if($r_om == ''){
					$test_result = $test_result.
					"<input class=\"question_hide\" value=\"".$r_om."\" name=\"resp".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>
					<h4 class=\"no-padding-bottom text-rojo\"><b class=\"respuesta\">".$p_om."</b></h4>
					<div id=\"sdd\" class=\" no-padding-top\">
					<p>
					<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
					<label class='text-red'>¡Incorrecto!</label> No has respondido esta pregunta.
					</p>
					</div>";
					$incorrectos++;
					$incorrectos_aux++;
				} else if($this->Actividades_modelo->checkReactiveOM($id_om,$r_om)){
					$test_result = $test_result. 
					"<input class=\"question_hide\" value=\"".$r_om."\" name=\"resp".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>
					<h4 class=\"no-padding-bottom text-green\"><b class=\"respuesta\">".$p_om."</b></h4>
					<div id=\"sdd\" class=\" no-padding-top\">
					<p>
					<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
					<label class='text-verde-dark'>¡Correcto!</label> Tu respuesta fue la opción: ".$r_om."
					</p>
					</div>";
					$correctos++;
					$correctos_aux++;
				} else {
					$test_result = $test_result.
					"<input class=\"question_hide\" value=\"".$r_om."\" name=\"resp".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>
					<h4 class=\"no-padding-bottom text-rojo\"><b class=\"respuesta\">".$p_om."</b></h4>
					<div id=\"sdd\" class=\" no-padding-top\">
					<p>
					<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
					<label class='text-red'>¡Incorrecto!</label> Tu respuesta fue la opción: ".$r_om."
					</p>
					</div>";
					$incorrectos++;
					$incorrectos_aux++;
				}
				$test_result = $test_result."</blockquote></div>";
			}

			$attemps_lec = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
			$enable_attemps = $this->Lectura_modelo->getLecturaArray($id_lectura);
			$test_result = $test_result.($this->show_result_test($id_lectura,
				$correctos_aux,
				$incorrectos_aux,
				$attemps_lec['intentos_om'],
				$enable_attemps["attemps"],
				1));
			$test_result = $test_result." </form> </div>";

			echo $test_result;

			$aip = array(
				'aciertos'    => $correctos,
				'incorrectos' => $incorrectos,
				'fin_om'      => 1,
			);
			if($attemps_lec['intentos_om'] == $enable_attemps["attemps"] && $attemps_lec['fin_om'] != 1){
				if($this->saveAnswersStudent(json_encode($questionsTestArray),'om')){
					$this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$aip);
					$this->updt_score($id_lectura);
				}
			}
		}
	}

	public function verificar_vf($id_lectura){

		$id_alumno      = $this->session->userdata('USER_ID');
		$attemps_lec    = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
		$num_reactivos  = $this->input->post("num_r");
		$correctos      = $attemps_lec['aciertos'];
		$incorrectos    = $attemps_lec['incorrectos'];
		$correctos_aux  = 0;
		$incorrectos_aux= 0;
		$new_attemps    = array('intentos_vf' => $attemps_lec['intentos_vf']+1);

		if($this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$new_attemps)){

			$test_result= "<div class=\"box box-solid box-shadow-sm\">
			<div class=\"box-header bg-maroon\">
			<h3 class=\"box-title\">Tus resultados son los siguientes.</h3>
			</div>
			<div class=\"box-body\">
			<form method=\"post\" action=\"".base_url()."Movil/Actividades/finishTestVf/".$id_lectura."\">
			<input class=\"question_hide\" value=\"".$num_reactivos."\" name=\"num_r\" hidden='hidden'>";

			for ($i=1; $i <= $num_reactivos ; $i++) { 
				$id_vf = $this->input->post("idrvf".$i);
				$p_vf  = $this->input->post("question_".$i);
				$r_vf  = $this->input->post("resp_".$i);
				$status= $this->input->post("status_".$i);
				$idCategoria= $this->input->post("idcat".$i);

				$questionsTestArray [] = array(
					"idVerdaderoFalso" => $id_vf, 
					"question"         => $p_vf,
					"answer"           => ($r_vf == '')?'sin responder':$r_vf, 
					"status"           => ($r_vf == $status)?'correct':'incorrect',
					"idAlumno"         => $id_alumno,
					"idLectura"        => $id_lectura,
					"idCategoria"        => $idCategoria,
				);

				$test_result = $test_result."
				<div class=\"padding-square-no-top-bottom\">
				<blockquote class=\"no-padding bg-block-gray\">
				<input class=\"question_hide\" value=\"".$id_vf."\" name=\"id_vf".$i."\" hidden='hidden'>";

				if($r_vf == ''){
					$test_result = $test_result.
					"<input class=\"question_hide\" value=\"".$p_vf."\" name=\"question_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$r_vf."\" name=\"resp_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>
					<h4 class=\"no-padding-bottom text-rojo\"><b class=\"respuesta\">".$p_vf."</b></h4>
					<div id=\"sdd\" class=\" no-padding-top\">
					<p>
					<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
					<label class='text-red'>¡Incorrecto!</label> No has respondido esta pregunta.
					</p>
					</div>";
					$incorrectos++;
					$incorrectos_aux++;
				} else if($this->Actividades_modelo->checkReactiveVF($id_vf,$r_vf)){
					$test_result = $test_result. 
					"<input class=\"question_hide\" value=\"".$p_vf."\" name=\"question_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$r_vf."\" name=\"resp_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>
					<h4 class=\"no-padding-bottom text-green\"><b class=\"respuesta\">".$p_vf."</b></h4>
					<div id=\"sdd\" class=\" no-padding-top\">
					<p>
					<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
					<label class='text-verde-dark'>¡Correcto!</label> Tu respuesta fue la opción: ".$r_vf."
					</p>
					</div>";
					$correctos++;
					$correctos_aux++;
				} else {
					$test_result = $test_result.
					"<input class=\"question_hide\" value=\"".$p_vf."\" name=\"question_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$r_vf."\" name=\"resp_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."\" hidden='hidden'>
					<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>
					<h4 class=\"no-padding-bottom text-rojo\"><b class=\"respuesta\">".$p_vf."</b></h4>
					<div id=\"sdd\" class=\" no-padding-top\">
					<p>
					<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
					<label class='text-red'>¡Incorrecto!</label> Tu respuesta fue la opción: ".$r_vf."
					</p>
					</div>";
					$incorrectos++;
					$incorrectos_aux++;
				}
				$test_result = $test_result."</blockquote></div>";
			}

			$attemps_lec    = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
			$enable_attemps = $this->Lectura_modelo->getLecturaArray($id_lectura);
			$test_result    = $test_result.($this->show_result_test($id_lectura,
				$correctos_aux,
				$incorrectos_aux,
				$attemps_lec['intentos_vf'],
				$enable_attemps["attemps"],
				2));
			$test_result = $test_result." </form> </div>";

			echo $test_result;

			$aip = array(
				'aciertos'    => $correctos,
				'incorrectos' => $incorrectos,
				'fin_vf'      => 1,
			);
			if($attemps_lec['intentos_vf'] == $enable_attemps["attemps"] && $attemps_lec['fin_vf'] != 1){
				if($this->saveAnswersStudent(json_encode($questionsTestArray),'vf')){
					$this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$aip);
					$this->updt_score($id_lectura);
				}
			}
		}
	}

	public function verificar_rc($id_lectura){

		$id_alumno      = $this->session->userdata('USER_ID');
		$attemps_lec    = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
		$num_reactivos  = $this->input->post("num_r");
		$correctos      = $attemps_lec['aciertos'];
		$incorrectos    = $attemps_lec['incorrectos'];
		$correctos_aux  = 0;
		$incorrectos_aux= 0;
		$new_attemps    = array('intentos_rc' => $attemps_lec['intentos_rc']+1);

		if($this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$new_attemps)){

			$test_result= "<div class=\"box box-solid box-shadow-sm\">
			<div class=\"box-header bg-maroon\">
			<h3 class=\"box-title\">Tus resultados son los siguientes.</h3>
			</div>
			<div class=\"box-body\">
			<form method=\"post\" action=\"".base_url()."Movil/Actividades/finishTestRc/".$id_lectura."\">
			<input class=\"question_hide\" value=\"".$num_reactivos."\" name=\"num_r\" hidden='hidden'>";

			for ($i=1; $i <= $num_reactivos ; $i++) { 
				$id_rc  = $this->input->post("idrrc".$i);
				$idCategoria = $this->input->post("idcat".$i);

				$test_result = $test_result."
				<div class=\"padding-square-no-top-bottom\">
				<blockquote class=\"no-padding bg-block-gray\">
				<input class=\"question_hide\" value=\"".$id_rc."\" name=\"idrrc".$i."\" hidden='hidden'>
				<input class=\"question_hide\" value=\"".$idCategoria."\" name=\"idcat".$i."\" hidden='hidden'>";
				
				for($j = 1 ; $j <= 4 ;$j++){
					$question   = $this->input->post("question_".$i."_".$j);
					$idx_p  = $this->input->post("p_".$i."_".$j);
					$idx_r  = $this->input->post("r_".$i."_".$j);
					$answer_alumno  = $this->input->post("rt_".$i."_".$j);
					$status = ($idx_p == $idx_r)?'correct':'incorrect';
					

					$questionsTestArray [] = array(
						"idRelacionarColumnas" => $id_rc, 
						"question_".$i."_".$j => $question, 
						"answer_".$i."_".$j   => ($answer_alumno != '')?$answer_alumno:'sin responder',
						"status_".$i."_".$j   => $status,
						"idAlumno"     => $id_alumno,
						"idLectura"    => $id_lectura,
						"idCategoria"    => $idCategoria,
					);

					if($answer_alumno == ''){
						$test_result = $test_result.
						"<input class=\"question_hide\" value=\"".$question."\" name=\"question_".$i."_".$j."\" hidden='hidden'>
						<input class=\"question_hide\" value=\"".$answer_alumno."\" name=\"rt_".$i."_".$j."\" hidden='hidden'>
						<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."_".$j."\" hidden='hidden'>
						<h4 class=\"no-padding-bottom text-rojo\"><b class=\"respuesta\">".$question."</b></h4>
						<div id=\"sdd\" class=\" no-padding-top\">
						<p>
						<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
						<label class='text-red'>¡Incorrecto!</label> No has respondido esta pregunta.
						</p>
						</div>";
						$incorrectos++;
						$incorrectos_aux++;
					} else if($idx_p == $idx_r){
						$test_result = $test_result. 
						"<input class=\"question_hide\" value=\"".$question."\" name=\"question_".$i."_".$j."\" hidden='hidden'>
						<input class=\"question_hide\" value=\"".$answer_alumno."\" name=\"rt_".$i."_".$j."\" hidden='hidden'>
						<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."_".$j."\" hidden='hidden'>
						<h4 class=\"no-padding-bottom text-green\"><b class=\"respuesta\">".$question."</b></h4>
						<div id=\"sdd\" class=\" no-padding-top\">
						<p>
						<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
						<label class='text-verde-dark'>¡Correcto!</label> Tu respuesta fue: ".$answer_alumno."
						</p>
						</div>";
						$correctos++;
						$correctos_aux++;
					} else {
						$test_result = $test_result.
						"<input class=\"question_hide\" value=\"".$question."\" name=\"question_".$i."_".$j."\" hidden='hidden'>
						<input class=\"question_hide\" value=\"".$answer_alumno."\" name=\"rt_".$i."_".$j."\" hidden='hidden'>
						<input class=\"question_hide\" value=\"".$status."\" name=\"status_".$i."_".$j."\" hidden='hidden'>
						<h4 class=\"no-padding-bottom text-rojo\"><b class=\"respuesta\">".$question."</b></h4>
						<div id=\"sdd\" class=\" no-padding-top\">
						<p>
						<input type=\"radio\" name=\"r3\" class=\"flat-red\" disabled>
						<label class='text-red'>¡Incorrecto!</label> Tu respuesta fue: ".$answer_alumno."
						</p>
						</div>";
						$incorrectos++;
						$incorrectos_aux++;
					}
				}
				$arrayRelacionarColumnas [] = array(
					"item_".$i => $questionsTestArray,
				);
				unset($questionsTestArray);
				$test_result = $test_result."</blockquote></div>";
			}

			$attemps_lec = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
			$enable_attemps = $this->Lectura_modelo->getLecturaArray($id_lectura);
			$test_result = $test_result.($this->show_result_test($id_lectura,
				$correctos_aux,
				$incorrectos_aux,
				$attemps_lec['intentos_rc'],
				$enable_attemps["attemps"],
				3));
			$test_result = $test_result." </form> </div>";

			echo $test_result;

			$aip = array(
				'aciertos'    => $correctos,
				'incorrectos' => $incorrectos,
				'fin_rc'      => 1,
			);
			if($attemps_lec['intentos_rc'] == $enable_attemps["attemps"] && $attemps_lec['fin_rc'] != 1){
				if($this->saveAnswersStudent(json_encode($arrayRelacionarColumnas),'rc')){
					$this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$aip);
					$this->updt_score($id_lectura);
				}
			}
		}
	}

	public function show_result_test($id_lectura,$correctos_aux,$incorrectos_aux,$attemps_a,$attemps_l,$actividad){

		$test_result = "";
		$id_alumno   = $this->session->userdata('USER_ID');

		$test_result = $test_result."<div>
		<input class=\"question_hide\" hidden=\"hidden\" name=\"type_reactive\" value=\"".$actividad."\" readonly>
		<div class='row'>
		<div class='col-sm-1'></div>
		<div class='col-sm-5 border-right'>
		<div class='box box-widget widget-user-2 no-shadow'>
		<div class='widget-user-header' style='padding: 10px 10px 5px 10px;''>
		<div class='widget-user-image'>
		<img class='img-circle img-thumbnail circle-green' 
		src='".base_url()."assets/img/star.png' alt='User Avatar'>
		</div>
		<h5 class='widget-user-desc text-gris'>Aciertos</h5>
		<h4 class='widget-user-desc box-title'>
		<input class='label-input' type='text' name='aciertos_result' value='".$correctos_aux."' readonly>
		</h4>
		<h5 class='widget-user-desc text-verde-dark'>
		<i class='fa fa-check-circle'></i> Aciertos por actividad 
		</h5>
		</div>
		</div>
		</div>
		<div class='col-sm-1'></div>

		<div class='col-sm-5 border-right'>
		<div class='box box-widget widget-user-2 no-shadow'>
		<div class='widget-user-header' style='padding: 10px 10px 5px 10px;'>
		<div class='widget-user-image'>
		<img class='img-circle img-thumbnail circle-red' 
		src='".base_url()."assets/img/error.png' alt='User Avatar'>
		</div>
		<h5 class='widget-user-desc text-gris'>Incorrectos</h5>
		<h4 class='widget-user-desc box-title'>
		<input class='label-input' type='text' name='incorrectos_result' value='".$incorrectos_aux."' readonly>
		</h4>
		<h5 class='widget-user-desc text-rojo'>
		<i class='fa fa-times-circle'></i> Incorrectos por actividad 
		</h5>
		</div>
		</div>
		</div>
		</div>
		<div class='box-footer text-center'>";

		$attemps_lec = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
		$enable_attemps = $this->Lectura_modelo->getLecturaArray($id_lectura);

		if($attemps_a < $attemps_l){
			switch ($actividad) {
				case 1:
				$test_result = $test_result."<button type='submit' class='btn btn-flat bg-maroon'><i class='fa fa-check-circle'></i> Guardar</button>
				<a href=\"".base_url()."Movil/Actividades/opcion_multiple/".$id_lectura."\" class=\"btn btn-flat btn-defaul bg-gray\"><i class=\"fa fa-refresh\"></i> Repetir</a>";
				break;
				case 2:
				$test_result = $test_result."<button type='submit' class='btn btn-flat bg-maroon'><i class='fa fa-check-circle'></i> Guardar</button>
				<a href=\"".base_url()."Movil/Actividades/verdadero_falso/".$id_lectura."\" class=\"btn btn-flat btn-defaul bg-gray\"><i class=\"fa fa-refresh\"></i> Repetir</a>";
				break;
				case 3:
				$test_result = $test_result."<button type='submit' class='btn btn-flat bg-maroon'><i class='fa fa-check-circle'></i> Guardar</button>
				<a href=\"".base_url()."Movil/Actividades/relacionar_columnas/".$id_lectura."\" class=\"btn btn-flat btn-defaul bg-gray\"><i class=\"fa fa-refresh\"></i> Repetir</a>";
				break;
			}
		} else {
			$test_result = $test_result."<h1 class='text-yellow'>¡Te has quedado sin intentos!</h1>
			<a href='".base_url().'Movil/Lecturas/detail/'.$id_lectura."' class='btn btn-flat bg-yellow'>
			<i class='fa fa-check-circle'></i> Aceptar
			</a>";
		}

		$test_result = 
		$test_result."  </div>
		</div>";

		return $test_result;
	}

	public function updt_aip($id_lectura){
		$id_teacher  = $this->session->userdata('USER_TEACHER');
		$id_alumno   = $this->session->userdata('USER_ID');
		$aciertos    = $this->input->post('aciertos_result');
		$incorrectos = $this->input->post('incorrectos_result');
		$actividad   = $this->input->post('type_reactive');

		$attemps_lec = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
		$new_aip     = array();

		switch ($actividad) {
			case 1:
				$new_aip = array(
					'aciertos'    => ($attemps_lec['aciertos']+$aciertos),
					'incorrectos' => ($attemps_lec['incorrectos']+$incorrectos),
					'fin_om'      => 1,
				);
				if($this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$new_aip)){
					$this->updt_score($id_lectura);
					$this->session->set_flashdata('success', '¡Felicidades! Tus resultados se han registrado exitosamente.');
                	redirect(base_url()."Movil/Actividades/opcion_multiple/".$id_lectura);
				} else {
					$this->session->set_flashdata('error', '¡Vaya! Algo salió mal, intenta más tarde. :(');
                	redirect(base_url()."Movil/Actividades/opcion_multiple/".$id_lectura);
				}
			break;

			case 2:
				$new_aip = array(
					'aciertos'    => ($attemps_lec['aciertos']+$aciertos),
					'incorrectos' => ($attemps_lec['incorrectos']+$incorrectos),
					'fin_vf'      => 1,
				);
				if($this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$new_aip)){
					$this->updt_score($id_lectura);
					$this->session->set_flashdata('success', '¡Felicidades! Tus resultados se han registrado exitosamente.');
                	redirect(base_url()."Movil/Actividades/verdadero_falso/".$id_lectura);
				} else {
					$this->session->set_flashdata('error', '¡Vaya! Algo salió mal, intenta más tarde. :(');
                	redirect(base_url()."Movil/Actividades/verdadero_falso/".$id_lectura);
				}
			break;

			case 3:
				$new_aip = array(
					'aciertos'    => ($attemps_lec['aciertos']+$aciertos),
					'incorrectos' => ($attemps_lec['incorrectos']+$incorrectos),
					'fin_rc'      => 1,
				);
				if($this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$new_aip)){
					$this->updt_score($id_lectura);
					$this->session->set_flashdata('success', '¡Felicidades! Tus resultados se han registrado exitosamente.');
                	redirect(base_url()."Movil/Actividades/relacionar_columnas/".$id_lectura);
				} else {
					$this->session->set_flashdata('error', '¡Vaya! Algo salió mal, intenta más tarde. :(');
                	redirect(base_url()."Movil/Actividades/relacionar_columnas/".$id_lectura);
				}
			break;

			default:
				$this->session->set_flashdata('default', '¡Vaya! Algo salió mal, intenta más tarde. :(');
				redirect(base_url()."Movil/Lecturas/detail/".$id_lectura);
			break;
		}
	}

	public function updt_score($id_lectura){
		$id_teacher  = $this->session->userdata('USER_TEACHER');
		$id_alumno   = $this->session->userdata('USER_ID');

		$tabla_lectura        = $this->Lectura_modelo->getLecturaArray($id_lectura);
		$tabla_lectura_alumno = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);

		if($tabla_lectura_alumno["num_complete_activities"] < $tabla_lectura["num_active_activities"]){
			$countActivitiesComplete = $tabla_lectura_alumno["num_complete_activities"]+1;
			$actividad_completada = array(
				'num_complete_activities' => $countActivitiesComplete,
			);
			$this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$actividad_completada);
		} 

		$lectura_alumno = $this->Actividades_modelo->getLecturaAlumnoArray($id_lectura,$id_alumno);
		if($lectura_alumno["num_complete_activities"] === $tabla_lectura["num_active_activities"]){
			$aciertos        = $lectura_alumno["aciertos"];
			$total_reactivos = ($lectura_alumno["incorrectos"]+$lectura_alumno["aciertos"]);
			$calificacion    = (100/$total_reactivos)*$aciertos;
			$lectura_completada = array(
				'calificacion' => $calificacion,
				'reactivos'    => "Completo",
				'idEstado'     => "5",
				'fecha'        => date('Y-m-d'),
			);
			$this->Lectura_modelo->updtLecturaAlumno($id_lectura,$id_alumno,$lectura_completada);
		}
	}

	public function saveAnswersStudent($answersStudents, $reactiveType){
		$success = false;
		$answers = json_decode($answersStudents,true);

		switch($reactiveType){
			//save answers of om
			case 'om':
				foreach($answers as $answer) {
					if($answer['answer'] != "null"){
						$data = array (
							'idOpcionMultiple' => $answer['idOpcionMultiple'],
							'answer'           => $answer['answer'],
							'status'           => $answer['status'],
							'idAlumno'         => $answer['idAlumno'],
							'idLectura'        => $answer['idLectura'],
							'idCategoria'        => $answer['idCategoria'],
						);
						if($this->Actividades_modelo->saveAnswersOm($data)){
							$success = true;
						}
					}
				}
			break;
			//save answers of rc 
			case 'rc':
				for($i = 0 ; $i < count($answers) ; $i++){
					$idRc = ($answers[$i]['item_'.($i+1)][0]['idRelacionarColumnas']);
					$que1 = ($answers[$i]['item_'.($i+1)][0]['question_'.($i+1).'_1']);
					$ans1 = ($answers[$i]['item_'.($i+1)][0]['answer_'.($i+1).'_1']);
					$sta1 = ($answers[$i]['item_'.($i+1)][0]['status_'.($i+1).'_1']);
					$que2 = ($answers[$i]['item_'.($i+1)][1]['question_'.($i+1).'_2']);
					$ans2 = ($answers[$i]['item_'.($i+1)][1]['answer_'.($i+1).'_2']);
					$sta2 = ($answers[$i]['item_'.($i+1)][1]['status_'.($i+1).'_2']);
					$que3 = ($answers[$i]['item_'.($i+1)][2]['question_'.($i+1).'_3']);
					$ans3 = ($answers[$i]['item_'.($i+1)][2]['answer_'.($i+1).'_3']);
					$sta3 = ($answers[$i]['item_'.($i+1)][2]['status_'.($i+1).'_3']);
					$que4 = ($answers[$i]['item_'.($i+1)][3]['question_'.($i+1).'_4']);
					$ans4 = ($answers[$i]['item_'.($i+1)][3]['answer_'.($i+1).'_4']);
					$sta4 = ($answers[$i]['item_'.($i+1)][3]['status_'.($i+1).'_4']);
					$idAl = ($answers[$i]['item_'.($i+1)][0]['idAlumno']);
					$idLec = ($answers[$i]['item_'.($i+1)][0]['idLectura']);
					$idCategoria = ($answers[$i]['item_'.($i+1)][0]['idCategoria']);

					$data = array(
						'idRelacionarColumnas' => $idRc,
						'question_1'           => $que1,
						'answer_1'             => $ans1,
						'status_1'             => $sta1,
						'question_2'           => $que2,
						'answer_2'             => $ans2,
						'status_2'             => $sta2,
						'question_3'           => $que3,
						'answer_3'             => $ans3,
						'status_3'             => $sta3,
						'question_4'           => $que4,
						'answer_4'             => $ans4,
						'status_4'             => $sta4,
						'idAlumno'             => $idAl,
						'idLectura'            => $idLec,
						'idCategoria'          => $idCategoria,
					);
					if($this->Actividades_modelo->saveAnswersRc($data)){
						unset($data);
						$success = true;
					} 
				}
			break;

			//save answers of vf
			case 'vf':
				foreach($answers as $answer) {
					$data = array (
						'idVerdaderoFalso' => $answer['idVerdaderoFalso'],
						'question'         => $answer['question'],
						'answer'           => $answer['answer'],
						'status'           => $answer['status'],
						'idAlumno'         => $answer['idAlumno'],
						'idLectura'        => $answer['idLectura'],
						'idCategoria'        => $answer['idCategoria'],
					);
					if($this->Actividades_modelo->saveAnswersVf($data)){
						unset($data);
						$success = true;
					}
				}
				
			break;
		}
		
		return $success;
	}


	public function finishTestOm($id_lectura){
		$id_alumno   = $this->session->userdata('USER_ID');

		$questionsTestArray [] = array(
			"idOpcionMultiple" => "null", 
			"answer"           => "null", 
			"idAlumno"         => "null",
			"idLectura"        => "null",
			"idCategoria"      => "null",
		);

		$num_reactivos  = $this->input->post("num_r");
		for ($i=1; $i <= $num_reactivos ; $i++) { 
			$id_om = $this->input->post("idrom".$i);
			$p_om  = $this->input->post("question".$i);
			$r_om  = $this->input->post("resp".$i);
			$status= $this->input->post("status_".$i);
			$idCategoria = $this->input->post("idcat".$i);

			$questionsTestArray [] = array(
				"idOpcionMultiple" => $id_om, 
				"answer"           => ($r_om != '')?$r_om:'sin responder', 
				"status"           => ($r_om == $status)?'correct':'incorrect',
				"idAlumno"         => $id_alumno,
				"idLectura"        => $id_lectura,
				"idCategoria"      => $idCategoria,
			);
		}
		if($this->saveAnswersStudent(json_encode($questionsTestArray),'om')){
			$this->updt_aip($id_lectura);
		} else {
			$this->session->set_flashdata('default', '¡Vaya! Algo salió mal, intenta más tarde. :(');
			redirect(base_url()."Movil/Lecturas/detail/".$id_lectura);
		}
	}

	public function finishTestRc($id_lectura){
		$id_alumno   = $this->session->userdata('USER_ID');

		$num_reactivos  = $this->input->post("num_r");
		for ($i=1; $i <= $num_reactivos ; ++$i) { 

			for( $j = 1 ; $j <= 4 ; $j++ ){

				$id_rc = $this->input->post("idrrc".$i);
				$question  = $this->input->post("question_".$i."_".$j);
				$answer    = $this->input->post("rt_".$i."_".$j);
				$status    = $this->input->post("status_".$i."_".$j);
				$idCategoria = $this->input->post("idcat".$i);

				$questionsTestArray [] = array(
					"idRelacionarColumnas" => $id_rc, 
					"question_".$i."_".$j => $question, 
					"answer_".$i."_".$j   => ($answer != '')?$answer:'sin responder',
					"status_".$i."_".$j   => $status,
					"idAlumno"     => $id_alumno,
					"idLectura"    => $id_lectura,
					"idCategoria"    => $idCategoria,
				);
			}
			$arrayRelacionarColumnas [] = array(
				"item_".$i => $questionsTestArray,
			);
			unset($questionsTestArray);
		}
		if($this->saveAnswersStudent(json_encode($arrayRelacionarColumnas),'rc')){
			$this->updt_aip($id_lectura);
		} else {
			$this->session->set_flashdata('default', '¡Vaya! Algo salió mal, intenta más tarde. :(');
			redirect(base_url()."Movil/Lecturas/detail/".$id_lectura);
		}
	}

	public function finishTestVf($id_lectura){
		$id_alumno   = $this->session->userdata('USER_ID');

		$num_reactivos  = $this->input->post("num_r");

		for ($i=1; $i <= $num_reactivos ; $i++) { 
			$id_vf = $this->input->post("id_vf".$i);
			$p_vf  = $this->input->post("question_".$i);
			$r_vf  = $this->input->post("resp_".$i);
			$status= $this->input->post("status_".$i);
			$idCategoria = $this->input->post("idcat".$i);

			$questionsTestArray [] = array(
				"idVerdaderoFalso" => $id_vf, 
				"question"         => $p_vf,
				"answer"           => ($r_vf == '')?'sin responder':$r_vf, 
				"status"           => ($r_vf == $status)?'correct':'incorrect',
				"idAlumno"         => $id_alumno,
				"idLectura"        => $id_lectura,
				'idCategoria'      => $idCategoria,
			);
		}
		if($this->saveAnswersStudent(json_encode($questionsTestArray),'vf')){
			$this->updt_aip($id_lectura);
		} else {
			$this->session->set_flashdata('default', '¡Vaya! Algo salió mal, intenta más tarde. :(');
			redirect(base_url()."Movil/Lecturas/detail/".$id_lectura);
		}
	}
}

