<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class docente extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model("Web/admin/Docente_model");
        $this->load->model("Web/admin/Indicadores_model");
        $this->load->model("Web/admin/Alumno_model");
    }

    public function index(){
      if($this->session->userdata('USER_ID') != '' && $this->session->userdata('USER_TYPE') == '3') {  
          //$id_usuario =  $this->session->userdata('USER_ID');
          
          $data = array(
          't_Docentes' => $this->Docente_model->getTotalDocentes(), 
          );

          $this->load->view('admin/layouts/header');
          $this->load->view('admin/docente/docente',$data);
          $this->load->view('admin/layouts/footer');
      } else  {  
          redirect(base_url().'Welcome');  
      } 
    }

    public function studentsTeacher($id_docente){
      if($this->session->userdata('USER_ID') != '' && $this->session->userdata('USER_TYPE') == '3') { 

          $data = array(
              'alumnos' => $this->Alumno_model->getAlumnosByTeacher($id_docente),
              'docente' => $this->Docente_model->getInfoDocente($id_docente),
              'total_lec' => $this->Docente_model->getTotalLecturasByTeacher($id_docente),
              'total_alu' => $this->Docente_model->getTotalAlumnosByTeacher($id_docente),
              'gen_score' => $this->Docente_model->getGrupalScore($id_docente),
          );

          $this->load->view('admin/layouts/header');
          $this->load->view('admin/docente/alumno', $data);
          $this->load->view('admin/layouts/footer');
      } else  {  
          redirect(base_url().'Welcome');  
      } 
    }

    public function detail($id_alumno){
        if($this->session->userdata('USER_ID') != '' && $this->session->userdata('USER_TYPE') == '3') {  
            if($this->Alumno_model->getAlumno($id_alumno) ){
                $data = array(
                    'alumno'          => $this->Alumno_model->getAlumno($id_alumno),
                    'alumno_detail'   => $this->Alumno_model->getDetailAlumnoToTeacher($id_alumno),
                    'alumno_lecturas' => $this->Alumno_model->getLecturasAlumnoToTeacher($id_alumno)
                );

                $this->load->view('admin/layouts/header');
                $this->load->view('admin/docente/alumno_detail', $data);
                $this->load->view('admin/layouts/footer');

            } else {
                redirect(base_url()."Web/admin/Docente");
            }
        } else  {  
            redirect(base_url().'Welcome');  
        } 
    }

    public function getDataChart2(){
        $idUsuario = $this->input->post("idUsuario");

        $categorias = $this->Indicadores_model->getCategories();
        $correctas  = $this->Docente_model->getCorrectsChart2($idUsuario);
        $incorrectas = $this->Docente_model->getIncorrectsChart2($idUsuario);

        $json = array();
        $num_ac = 0;
        $num_inc = 0;
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
            
            $data = array(
                'idCategoria' => $row->idCategoria,
                'categoria' => $row->nombre,
                'correctas' => $num_ac,
                'incorrectas' => $num_inc,
                'percent'  => ($num_ac == 0 && $num_inc == 0)?0:round((100/($num_ac+$num_inc))*$num_ac),
            );
            
            $json[] = $data;

            unset($data);
            $num_inc = 0;
            $num_ac = 0;
            $percent = 0;
        }

        echo json_encode($json);
    }
}
