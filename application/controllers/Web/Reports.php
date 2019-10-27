<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Web/Reports_model');
		$this->load->library('pdf');
    }
    
    public function index(){
        $this->load->view('teacher/home/template_pdf');
    }

	public function pdfAlumnos(){
		$membrete = strtoupper($this->input->post('alumnosTM'));	
		$asunto = strtoupper($this->input->post('alumnosA'));
		$filename = $this->input->post('alumnosNA');
		$date = $this->input->post('alumnosF');
		$orderBy = $this->input->post('alumnoFiltro');
		$order = $this->input->post('alumnoOrder');

        $idUsuario = $this->session->userdata('USER_ID');

		$html_content = $this->Reports_model->printPDFAlumnos($idUsuario,$membrete,$asunto,$date,$orderBy,$order);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$filename.".pdf", array("Attachment"=>0));
	}

	public function pdfLecturas(){
		$membrete = strtoupper($this->input->post('lecturasTM'));	
		$asunto = strtoupper($this->input->post('lecturasA'));
		$filename = $this->input->post('lecturasNA');
		$date = $this->input->post('lecturasF');
		$orderBy = $this->input->post('lecturasFiltro');
		$order = $this->input->post('lecturasOrder');

        $idUsuario = $this->session->userdata('USER_ID');

		$html_content = $this->Reports_model->printPDFLecturas($idUsuario,$membrete,$asunto,$date,$orderBy,$order);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$filename.".pdf", array("Attachment"=>0));
	}

	public function pdfAlumno(){
		$membrete = strtoupper($this->input->post('alumnoTM'));	
		$asunto = strtoupper($this->input->post('alumnoA'));
		$filename = $this->input->post('alumnoNA');
		$date = $this->input->post('alumnoF');
		$idAlumno = $this->input->post('adidAlumno');

        $idUsuario = $this->session->userdata('USER_ID');

		$html_content = $this->Reports_model->printPDFAlumno($idUsuario,$membrete,$asunto,$date,$idAlumno);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$filename.".pdf", array("Attachment"=>0));
	}

	public function pdfLectura(){
		$membrete = strtoupper($this->input->post('lecturaTM'));	
		$asunto = strtoupper($this->input->post('lecturaA'));
		$filename = $this->input->post('lecturaNA');
		$date = $this->input->post('lecturaF');
		$idLectura = $this->input->post('ldidLectura');

        $idUsuario = $this->session->userdata('USER_ID');

		$html_content = $this->Reports_model->printPDFLectura($idUsuario,$membrete,$asunto,$date,$idLectura);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$filename.".pdf", array("Attachment"=>0));
		// echo $html_content;
	}

}