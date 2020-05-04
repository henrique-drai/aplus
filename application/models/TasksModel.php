<?php
class TasksModel extends CI_Model { 

    // get tarefa info when grupo_id given
    public function getTarefas($id) {
        $query = $this->db->get_where('tarefa', array('grupo_id =' => $id));
        return $query->result_array();
    }

}