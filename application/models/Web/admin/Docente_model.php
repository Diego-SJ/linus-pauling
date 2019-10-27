<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class docente_model extends CI_Model {

    function getTotalDocentes(){
        $this->db->where("tipo",2);
        $fila = $this->db->get("Usuario");
        return $fila->result();
    }

    function getInfoDocente($idUsuario){
        $this->db->where("idUsuario",$idUsuario);
        $filas = $this->db->get("Usuario");
        return $filas->row();
    }

    function getTotalLecturasByTeacher($idUsuario){
        $this->db->where("idUsuario",$idUsuario);
        $filas = $this->db->get("vw_docente_home_totallecturas");
        return $filas->row();
    }

    function getTotalAlumnosByTeacher($idUsuario){
        $this->db->where("idUsuario",$idUsuario);
        $filas = $this->db->get("vw_docente_home_totalalumnos");
        return $filas->row();
    }

    function getGrupalScore($idUsuario){
        $result = $this->db->query('
        SELECT TRUNCATE(AVG(VW.promedio),2) AS general_score, A.idUsuario FROM vw_docente_aludetail_progress VW 
        INNER JOIN Alumno A ON A.idAlumno = VW.idAlumno
        WHERE A.idUsuario = '.$idUsuario.'');
        return $result->row();
    }

    public function getCorrectsChart2($idUsuario){
        $result = $this->db->query("
                                SELECT 
                                COUNT(AC.status) as correctas,
                                C.nombre,
                                AC.idCategoria,
                                A.idUsuario
                                FROM Answers_Categorias AC
                                INNER JOIN Categorias C ON C.idCategoria = AC.idCategoria
                                INNER JOIN Alumno A on A.idAlumno = AC.idAlumno
                                WHERE AC.status = 'correct' and A.idUsuario = '".$idUsuario."'
                                GROUP BY AC.idCategoria");
        return $result->result();
    }
    public function getIncorrectsChart2($idUsuario){
        $result = $this->db->query("
                                SELECT 
                                COUNT(AC.status) as incorrectas,
                                C.nombre,
                                AC.idCategoria,
                                A.idUsuario
                                FROM Answers_Categorias AC
                                INNER JOIN Categorias C ON C.idCategoria = AC.idCategoria
                                INNER JOIN Alumno A on A.idAlumno = AC.idAlumno
                                WHERE AC.status = 'incorrect' and A.idUsuario = '".$idUsuario."'
                                GROUP BY AC.idCategoria");
        return $result->result();
    }
}
