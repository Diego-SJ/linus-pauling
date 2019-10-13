<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alumno_model extends CI_Model {

    //TRAER TODOS LOS ALUMNOS POR MAESTRO
    function getAlumnosByTeacher($teacher) {
        $this->db->where("idUsuario",$teacher);
        $resultados = $this->db->get("Alumno");
        return $resultados->result();
    }

    function getDetailAlumnoToTeacher($id_alumno){
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("vw_docente_aludetail_progress");
        return $resultado->row();
    }

    function getLecturasAlumnoToTeacher($id_alumno){
        $this->db->where("idEstado","5");
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("vw_docente_aludetail_lecturasfinalizadas");
        return $resultado->result();
    }

    function insertAlumno($data) {
        return $this->db->insert("Alumno",$data);
    }

    function getAlumno($id_alumno) {
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("Alumno");
        return $resultado->row();
    }

    function updateAlumno($data,$id_alumno) {
        $this->db->where('idAlumno', $id_alumno);
        return $this->db->update('Alumno', $data);
    }

    function eliminarAlumno($id_alumno) {
        $this->db->where('idAlumno', $id_alumno);
        return $this->db->delete('Alumno');
    }

    function getHeaderTestResult($id_alumno,$id_lectura){
        $this->db->where("idLectura",$id_lectura);
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("vw_docente_resulttest");
        return $resultado->row();
    }
    function getAnswersOM($id_alumno,$id_lectura){
        $this->db->where("idLectura",$id_lectura);
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("vw_docente_getopcmul");
        return $resultado->result();
    }
    function getAnswersRC($id_alumno,$id_lectura){
        $this->db->where("idLectura",$id_lectura);
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("Answers_rc");
        return $resultado->result();
    }
    function getAnswersVF($id_alumno,$id_lectura){
        $this->db->where("idLectura",$id_lectura);
        $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->get("Answers_vf");
        return $resultado->result();
    }
}