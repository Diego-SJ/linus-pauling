<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicadores extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model("Web/admin/Docente_model");
        $this->load->model("Web/admin/Indicadores_model");
        if($this->session->userdata('USER_ID') == '' && $this->session->userdata('USER_TYPE') != '3') { 
            redirect(base_url().'Welcome');  
        } 
    }

    public function index(){
        $id_usuario =  $this->session->userdata('USER_ID');
          
        $data = array(
            'categories' => $this->indicadores_model->getAdminCategories(), 
        );

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/indicadores/categorias',$data);
        $this->load->view('admin/layouts/footer');
    }

    public function save(){
        try {
            $id_usuario =  $this->session->userdata('USER_ID');
            $success = false;
            $data = array(
                'nombre'      => $this->input->post("catName"),
                'descripcion' => $this->input->post("acatDescription"),
                'idUsuario'   => $id_usuario,
            );
            
            if($this->Indicadores_model->saveCategory($data)){
                $success = true;
            } 
            
            if($success){
                $this->session->set_flashdata('success', 'Categoría regristrada correctamente.');  
                redirect(base_url().'Web/admin/Indicadores'); 
            } else {
                $this->session->set_flashdata('error', 'Ocurrio un error, intenta más tarde.');  
                redirect(base_url().'Web/admin/Indicadores'); 
            }
        } catch (\Throwable $th) {
            $this->session->set_flashdata('error', $th.'');  
            redirect(base_url().'Web/admin/Indicadores'); 
        }
    }
}
