<?php
class ChatModel extends CI_Model { //provate_chat & private_chat_msg

    // public function last_record_privateMsg($id_receiver,$id_sender)
    // { 
    //     $query = $this->db->query("SELECT * FROM private_msg WHERE id_receiver=$id_receiver AND id_sender=$id_sender ORDER BY date LIMIT 1");
    //     $result = $query->result_array();
    //     return $result;
    // }
    // $query = $this->db->query("SELECT * FROM private_msg WHERE (id_sender, date) IN (SELECT id_sender, MAX(date) FROM private_msg WHERE id_receiver=$session_id OR id_sender=$session_id GROUP BY id_sender)");

    // $query = $this->db->query("SELECT id_sender,content FROM private_msg WHERE id_receiver=$session_id OR id_sender=$session_id GROUP BY id_sender");
    // $query = $this->db->query("SELECT * FROM (SELECT id_sender,content,date FROM private_msg WHERE id_receiver=$session_id OR id_sender=$session_id ORDER BY date ASC) AS sub GROUP BY id_sender");

    
    public function getChatLogs($session_id){ 
        $query = $this->db->query("SELECT least(m.id_receiver, m.id_sender) as sender, greatest(m.id_receiver, m.id_sender) as receiver, max(m.id)AS max_id, MAX(date) FROM private_msg m WHERE id_receiver=$session_id OR id_sender=$session_id GROUP BY sender,receiver");
        $result = $query->result_array();
        return $result;
    }

    public function getChatHistory($session_id, $id_sender){
        $id_sender = $this->db->escape($id_sender);

        $query = $this->db->query("SELECT * FROM private_msg WHERE (id_receiver=$session_id AND id_sender=$id_sender) OR (id_receiver=$id_sender AND id_sender=$session_id) ORDER BY date ASC");
        $result = $query->result_array();
        return $result;
    }

    public function getChatGroupHistory($grupo_id){
        $grupo_id = $this->db->escape($grupo_id);
        $query = $this->db->query("SELECT * FROM grupo_msg WHERE grupo_id=$grupo_id ORDER BY date ASC");
        $result = $query->result_array();
        return $result;
    }

    public function sendMessage($data){
        $this->db->insert('private_msg', $data);
    }

    public function sendMessageGroup($data){
        $this->db->insert('grupo_msg', $data);
    }

    public function getLastConvo($session_id){
        $query = $this->db->query("SELECT date,Type,ID FROM ((SELECT date, 'Grupo' AS Type, grupo_id AS ID FROM grupo_msg WHERE user_id=$session_id) UNION ALL (SELECT date,'Privado' AS Type, id_receiver AS ID FROM private_msg WHERE id_sender=$session_id) ) AS `some_table_name_lol_this_is_an_alias` ORDER BY date DESC LIMIT 1");
        $result = $query->result_array();
        return $result;
    }
}

