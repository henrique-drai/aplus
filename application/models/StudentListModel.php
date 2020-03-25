<?php
class StudentListModel extends CI_Model { 

    // gets user_id when cadeira_id given
    public function getStudentsbyCadeiraID($id) {
        $this->db->select("user_id");
        $this->db->where(array('cadeira_id =' => $id));
        $query = $this->db->get('aluno_cadeira');
        return $query->result_array();
    }

    // get student info when user_id given
    public function getStudentsInfo($id) {
        $query = $this->db->get_where('user', array('id =' => $id));
        return $query->result_array();
    }

}