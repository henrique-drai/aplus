<?php
class TasksModel extends CI_Model { 

    // get tarefa info when grupo_id given
    public function getTarefas($id) {
        $query = $this->db->get_where('tarefa', array('grupo_id =' => $id));
        return $query->result_array();
    }

    public function getMembroNome($id) {
        $query = $this->db->get_where('user', array('id =' => $id));
        return $query->result_array();
    }

    public function insertTask($data) {
        $this->db->insert("tarefa", $data);
        return $this->db->insert_id();
    }

}