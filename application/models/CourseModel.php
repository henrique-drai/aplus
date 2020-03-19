<?php
class CourseModel extends CI_Model {

    public function getCourseByCode($code) {
        $query = $this->db->get_where('cadeira', array('code' => $code));
        return $query->row();
    }

    public function getCadeiras($id) {
        $this->db->select("cadeira_id");
        $this->db->where(array('user_id =' => $id));
        $query = $this->db->get('professor_cadeira');
        return $query->result_array();
    }

    public function getCadeiraInfo($id) {
        $query = $this->db->get_where('cadeira', array('id =' => $id));
        return $query->result_array();
    }

    public function getDescription($id) {
        $query = $this->db->get_where('cadeira', array('code =' => $id));
        return $query->result_array();
    }

    public function getHours($id) {
        $query = $this->db->get_where('horario_duvidas', array('id_cadeira =' => $id));
        return $query->result_array();
    }

    public function insertText($data) {
        $this->db->set('description', $data["text"]);
        $this->db->where('code', $data["id"]);
        $data = $this->db->update('cadeira');
    }

    public function saveHours($data) {
        $this->db->where('id_prof', $data['id_prof']);
        $this->db->delete('horario_duvidas');

        $this->db->insert('horario_duvidas', $data);
        return $this->db->insert_id();
    }

}