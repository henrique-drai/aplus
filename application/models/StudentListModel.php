<?php
class StudentListModel extends CI_Model { 

    // gets user_id when cadeira_id given
    public function getStudentsbyCadeiraID($id) {
        $this->db->select("user_id");
        $this->db->where(array('cadeira_id =' => $id));
        $query = $this->db->get('aluno_cadeira');
        return $query->result_array();
    }

    public function verifyStudentInCadeira($user_id, $cadeira_id){
        return $this->db->get_where("aluno_cadeira", array("user_id" => $user_id, "cadeira_id" => $cadeira_id))->row();
    }

    // get student info when user_id given
    public function getStudentsInfo($id) {
        $query = $this->db->get_where('user', array('id =' => $id));
        return $query->result_array();
    }

}