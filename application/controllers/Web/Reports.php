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

	public function pdfdetails(){
		// if($this->uri->segment(3))
		// {
		// 	$customer_id = $this->uri->segment(3);
		// 	$html_content = '<h3 align="center">Convert HTML to PDF in CodeIgniter using Dompdf</h3>';
		// 	$html_content .= $this->htmltopdf_model->fetch_single_details($customer_id);
		// 	$this->pdf->loadHtml($html_content);
		// 	$this->pdf->render();
		// 	$this->pdf->stream("".$customer_id.".pdf", array("Attachment"=>0));
		// }
        $idUsuario = $this->session->userdata('USER_ID');
        $membrete = "COLEGIO LINUS PAULING PROGRESO DE OBREGON HIDALGO 2019";
        $title = "Usuarios y contraseñas de alumnos";
        $filename = "usersandpasswords";
        $date = "21/09/2019";

		$html_content = $this->Reports_model->getDataToPdf($idUsuario,$membrete,$title,$date);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$filename.".pdf", array("Attachment"=>0));
	}

}