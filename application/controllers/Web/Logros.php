<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logros extends CI_Controller {


    /*===================================================================================
                              ** CONSTRUCTOR DE INICIO **
    ===================================================================================*/

    public function __construct(){
        parent:: __construct();
        $this->load->model("Web/Logros_model");
        $this->load->model("Web/Alumno_model");
        if($this->session->userdata('USER_ID') == '' || $this->session->userdata('USER_TYPE') != '2') {  
            redirect(base_url().'Welcome');  
        }  
    }

	public function index(){
        $idUsuario = $this->session->userdata('USER_ID');
        $data = array( 
            'alumnos' => $this->Alumno_model->getAlumnosByTeacher($idUsuario)
        );
        $this->load->view('layouts/header');
        $this->load->view('teacher/alumno/achievements', $data);
        $this->load->view('layouts/footer');  
    }

    public function save(){
        $idUsuario = $this->session->userdata('USER_ID');
        $totalAlumnos = $this->input->post("totalAlumnos");
        $success = false;
        for($i = 1 ; $i <= $totalAlumnos ; $i++){
            $idAlumno = $this->input->post("idAlumno_".$i);
            if($idAlumno == 'true'){
                $data = array(
                    'nombre'      => $this->input->post("achName"),
                    'descripcion' => $this->input->post("achDescription"),
                    'icono'       => $this->input->post("icAch"),
                    'color'       => ($this->input->post("icAchColor") == '')?'maroon':$this->input->post("icAchColor"),
                    'imagen'      => ($this->input->post("getImgAch") == '')?'empty':$this->input->post("getImgAch"),
                    'idAlumno'    => $this->input->post("getIdAlumno".$i),
                );
                
                if($this->Logros_model->saveAchievement($data)){
                    $success = true;
                } 
            }
            
        }
        if($success){
            $this->session->set_flashdata('success', 'Logro regristrado correctamente.');  
            redirect(base_url().'Web/Logros'); 
        } else {
            $this->session->set_flashdata('error', 'Ocurrio un error, intenta más tarde.');  
            redirect(base_url().'Web/Logros'); 
        }
        
    }
    
}