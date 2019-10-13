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
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/indicadores/categorias');
        $this->load->view('admin/layouts/footer');
    }

    public function getAllCategories(){
        $id_usuario =  $this->session->userdata('USER_ID');
        $data = $this->Indicadores_model->getAdminCategories($id_usuario);
        echo $data;
    }

    public function save(){
        if(isset($_POST['name']) && isset($_POST['description'])){
            $success = false;
            $id_usuario =  $this->session->userdata('USER_ID');
            $data = array(
                'nombre'      => $_POST['name'],
                'descripcion' => $_POST['description'],
                'idUsuario'   => $id_usuario,
            );
            
            if($this->Indicadores_model->saveCategory($data)){
                echo "Categoría regristrada correctamente.";
            } 
        }
    }

    public function edit(){
        try {
            if(isset($_POST['id'])){
                $category = $this->Indicadores_model->getCategoryById($_POST['id']);
                echo $category;
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete($idCategoria){
        if($this->Indicadores_model->deleteCategory($idCategoria)){
            $this->session->set_flashdata('success', 'Categoría eliminada.');  
            redirect(base_url().'Web/admin/Indicadores'); 
        } else {
            $this->session->set_flashdata('error', 'Ocurrió un error, intenta más tarde.');  
            redirect(base_url().'Web/admin/Indicadores'); 
        }
    }

    public function update(){
        if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['id'])){
            $success = false;
            $data = array(
                'nombre'      => $_POST['name'],
                'descripcion' => $_POST['description'],
            );
            $id = $_POST['id'];
            if($this->Indicadores_model->updateCategory($data,$id)){
                echo "Categoría actualziada correctamente.";
            } 
        }
    }
}
