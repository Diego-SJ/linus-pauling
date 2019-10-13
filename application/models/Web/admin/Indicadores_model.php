<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Indicadores_model extends CI_Model {

    public function saveCategory($data){
        return $this->db->insert("Categorias",$data);
    }

    public function getAdminCategories($idUsuario) {
        $this->db->where("idUsuario",$idUsuario);
        $resultados = $this->db->get("Categorias");
        $json = array();
        foreach($resultados->result_array() as $row){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'id' => $row['idCategoria'] 
            );
        }
        return json_encode($json);
    }

    public function getCategoryById($idCategory) {
        $id_usuario =  $this->session->userdata('USER_ID');
        $this->db->where("idUsuario",$id_usuario);
        $this->db->where("idCategoria",$idCategory);
        $resultados = $this->db->get("Categorias");
        $json = array();
        $row = $resultados->row_array();
        if(isset($row)){
            $json = array(
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'idCategoria' => $row['idCategoria'],
            );
        }
        return json_encode($json);
    }

    public function updateCategory($data, $idCategoria){
        $id_usuario =  $this->session->userdata('USER_ID');
        $this->db->where('idUsuario',$id_usuario);
        $this->db->where('idCategoria',$idCategoria);
        $result = $this->db->update('Categorias',$data);
        return $result;
    }

    public function deleteCategory($idCategoria){
        $this->db->where('idCategoria',$idCategoria);
        $result = $this->db->delete('Categorias');
        return $result;
    }
}