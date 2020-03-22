<?php
class SubjectModel extends CI_Model { //cadeira

    public function getSubjectByCode($code) {
        $query = $this->db->get_where('cadeira', array('code' => $code));
        return $query->row();
    }

    public function getSubjectByID($id) {
        $query = $this->db->get_where('cadeira', array('id' => $id));
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
        $query = $this->db->get_where('horario_duvidas', array(
            'id_prof ='         => $data["id_prof"], 
            'id_cadeira ='      => $data["id_cadeira"], 
            'day ='             => $data['day']
        ));

        if ($query->num_rows() > 0) {
            $this->db->where(array(
                'id_prof ='     => $data['id_prof'],
                'id_cadeira ='  => $data["id_cadeira"],
                'day ='         => $data["day"]
            ));
            return $this->db->update('horario_duvidas', $data);
        } else {
            $this->db->insert('horario_duvidas', $data);
            return $this->db->insert_id();
        }
    }

    public function removeHours($data) {
        $this->db->where(array(
            'id_prof ='         => $data['id_prof'],
            'id_cadeira ='      => $data["id_cadeira"],
            'start_time ='      => $data["start_time"],
            'end_time ='        => $data["end_time"],
            'day ='             => $data["day"]
        ));
        return $this->db->delete('horario_duvidas');
    }

    public function getProj($id) {
        $query = $this->db->get_where('projeto', array('cadeira_id =' => $id));
        return $query->result_array();
    }

    public function registerSubject($data){
        $this->db->insert("cadeira", $data);
        $data["cadeira_id"] = $this->db->insert_id();
        return $data;
    }

}