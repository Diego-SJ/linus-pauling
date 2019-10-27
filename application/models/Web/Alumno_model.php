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
        // $this->db->where("idLectura",$id_lectura);
        // $this->db->where("idAlumno",$id_alumno);
        $resultado = $this->db->query("
        SELECT ARC.*, C.nombre FROM Answers_rc ARC
        INNER JOIN Categorias C ON C.idCategoria = ARC.idCategoria
        WHERE idLectura = $id_lectura AND idAlumno = $id_alumno");
        return $resultado->result();
    }
    function getAnswersVF($id_alumno,$id_lectura){
        $resultado = $this->db->query("
        SELECT AVF.*, C.nombre FROM Answers_vf AVF
        INNER JOIN Categorias C ON C.idCategoria = AVF.idCategoria
        WHERE idLectura = $id_lectura AND idAlumno = $id_alumno");
        return $resultado->result();
    }

    public function getCorrectsChart1($idAlumno,$idLectura){
        $result = $this->db->query("
                        SELECT 
                        COUNT(AC.status) as correctas,
                        C.nombre,
                        AC.idCategoria
                        FROM Answers_Categorias AC
                        INNER JOIN Categorias C ON C.idCategoria = AC.idCategoria
                        WHERE AC.status = 'correct' and AC.idAlumno = '".$idAlumno."' and AC.idLectura = '".$idLectura."'
                        GROUP BY AC.idCategoria");
        return $result->result();
    }
    public function getIncorrectsChart1($idAlumno,$idLectura){
        $result = $this->db->query("
                                SELECT 
                                COUNT(AC.status) as incorrectas,
                                C.nombre,
                                AC.idCategoria
                                FROM Answers_Categorias AC
                                INNER JOIN Categorias C ON C.idCategoria = AC.idCategoria
                                WHERE AC.status = 'incorrect' and AC.idAlumno = '".$idAlumno."' and AC.idLectura = '".$idLectura."'
                                GROUP BY AC.idCategoria");
        return $result->result();
    }

    public function getCorrectsChart2($idAlumno){
        $result = $this->db->query("
                        SELECT 
                        COUNT(AC.status) as correctas,
                        C.nombre,
                        AC.idCategoria
                        FROM Answers_Categorias AC
                        INNER JOIN Categorias C ON C.idCategoria = AC.idCategoria
                        WHERE AC.status = 'correct' and AC.idAlumno = '".$idAlumno."'
                        GROUP BY AC.idCategoria");
        return $result->result();
    }
    public function getIncorrectsChart2($idAlumno){
        $result = $this->db->query("
                                SELECT 
                                COUNT(AC.status) as incorrectas,
                                C.nombre,
                                AC.idCategoria
                                FROM Answers_Categorias AC
                                INNER JOIN Categorias C ON C.idCategoria = AC.idCategoria
                                WHERE AC.status = 'incorrect' and AC.idAlumno = '".$idAlumno."'
                                GROUP BY AC.idCategoria");
        return $result->result();
    }
}