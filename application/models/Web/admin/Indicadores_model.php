<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Indicadores_model extends CI_Model {

    public function saveCategory($data){
        return $this->db->insert("Categorias",$data);
    }

    function getAdminCategories($idUsuario) {
        $this->db->where("idUsuario",$idUsuario);
        $resultados = $this->db->get("Categorias");
        return $resultados->result();
    }

}