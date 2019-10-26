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

}