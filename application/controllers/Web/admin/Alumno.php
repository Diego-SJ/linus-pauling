<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model("Web/admin/Alumno_model");
        $this->load->model("Web/admin/Indicadores_model");
        if($this->session->userdata('USER_ID') == '' || $this->session->userdata('USER_TYPE') != '3') {  
            redirect(base_url().'Welcome');  
        } 
    }

	public function index(){
        $data = array( 
            'alumnos'       => $this->Alumno_model->getAllAlumnos(),
        );
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/alumno/alumnos', $data);
        $this->load->view('admin/layouts/footer');
	}

    public function detail($id_alumno){
        if($this->Alumno_model->getAlumno($id_alumno)){
            $data = array(
                'alumno'          => $this->Alumno_model->getAlumno($id_alumno),
                'alumno_detail'   => $this->Alumno_model->getDetailAlumnoToTeacher($id_alumno),
                'alumno_lecturas' => $this->Alumno_model->getLecturasAlumnoToTeacher($id_alumno)
            );

            $this->load->view('admin/layouts/header');
            $this->load->view('admin/docente/alumno_detail', $data);
            $this->load->view('admin/layouts/footer');

        } else {
            redirect(base_url()."Web/Alumno");
        }
    }

    // RESULTADOS DEL ALUMNO POR LECTURA
    public function resultTest(){
        $id_alumno = $this->input->post("id_alumno");
        $id_lectura = $this->input->post("id_lectura");

        if($this->Alumno_model->getHeaderTestResult($id_alumno,$id_lectura)){
            $data = array(
                'header_info' => $this->Alumno_model->getHeaderTestResult($id_alumno,$id_lectura),
                'answers_om'  => $this->Alumno_model->getAnswersOM($id_alumno,$id_lectura),
                'answers_rc'  => $this->Alumno_model->getAnswersRC($id_alumno,$id_lectura),
                'answers_vf'  => $this->Alumno_model->getAnswersVF($id_alumno,$id_lectura),
            );

            $this->load->view('admin/layouts/header');
            $this->load->view('admin/alumno/lecture_results', $data);
            $this->load->view('admin/layouts/footer');

        } else {
            redirect(base_url()."Web/Alumno");
        }
    }

    public function getDataChart1(){
        $idAlumno = $this->input->post("idAlumno");
        $idLectura = $this->input->post("idLectura");

        $categorias = $this->Indicadores_model->getCategories();
        $correctas  = $this->Indicadores_model->getCorrectsChart1($idAlumno,$idLectura);
        $incorrectas = $this->Indicadores_model->getIncorrectsChart1($idAlumno,$idLectura);

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

    public function getDataChart2(){
        $idAlumno = $this->input->post("idAlumno");

        $categorias = $this->Indicadores_model->getCategories();
        $correctas  = $this->Indicadores_model->getCorrectsChart2($idAlumno);
        $incorrectas = $this->Indicadores_model->getIncorrectsChart2($idAlumno);

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
