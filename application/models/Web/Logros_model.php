<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logros_model extends CI_Model {

    public function saveAchievement($data){
        return $this->db->insert("Logros",$data);
    }

    function getLogrosByStudent($idAlumno) {
        $this->db->where("idAlumno",$idAlumno);
        $resultados = $this->db->get("Logros");
        return $resultados->result();
    }

}