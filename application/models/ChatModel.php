<?php
class ChatModel extends CI_Model { //provate_chat & private_chat_msg

    public function last_record_privateMsg($id_receiver,$id_sender)
    { 
        $query = $this->db->query("SELECT * FROM private_msg WHERE id_receiver=$id_receiver AND id_sender=$id_sender ORDER BY date LIMIT 1");
        $result = $query->result_array();
        return $result;
    }
    
    public function getChatLogs($id_receiver)
    { 
        $query = $this->db->query("SELECT * FROM user WHERE id IN (SELECT DISTINCT id_sender FROM private_msg WHERE id_receiver=$id_receiver)");
        $result = $query->result_array();
        return $result;
    }
}