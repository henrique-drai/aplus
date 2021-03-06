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

    public function deleteTaskById($id) {
        return $this->db->delete("tarefa", array("id =" => $id));
    }

    public function getTaskById($id) {
        $query = $this->db->get_where('tarefa', array('id' => $id));
        return $query->result_array();
    }

    public function insertTaskDate($date, $user_id, $task_id, $mode) {
        if($mode == "start") {
            $this->db->set(array('start_date' => $date, 'user_id' => $user_id));
            $this->db->where(array('id' => $task_id));
            $this->db->update('tarefa');
        } else if($mode == "end") {
            $this->db->set('done_date', $date);
            $this->db->where(array('id' => $task_id));
            $this->db->update('tarefa');
        }
    }

    public function updateTask($data, $id){
        return $this->db->update("tarefa", $data, ['id' => $id]);
    }

    public function updateTaskById($task_id, $name, $desc) {
        $this->db->set(array('name' => $name, 'description' => $desc));
        $this->db->where(array('id' => $task_id));
        $this->db->update('tarefa');
    }
}