<?php
class NotificationModel extends CI_Model {

  public function getNew($user_id){
    $query = $this->db->select('type, title, content, link, date');
    $result = $query->get_where("notification", array("user_id" => $user_id, "seen" => false));
    return $result->result_array();
  }

}


