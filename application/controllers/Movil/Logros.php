<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logros extends CI_Controller {

	public function __construct(){
	    parent:: __construct();
        $this->load->model("Movil/Perfil_modelo");
        $this->load->model("Web/Logros_model");
        if($this->session->userdata('USER_ID') == '' || $this->session->userdata('USER_TYPE') != '1') {  
            redirect(base_url());  
        } 
	}

	public function index(){
		$idAlumno =  $this->session->userdata('USER_ID');   
        $data = array (
            'logros' => $this->Perfil_modelo->getAchievements($idAlumno),
            'logrosStudent' => $this->Logros_model->getLogrosByStudent($idAlumno),
        );

        $this->load->view('student/Layout/header');
        $this->load->view('student/perfil/achievements', $data);
        $this->load->view('student/Layout/footer');
    }   
}