<?php
class NotificationModel extends CI_Model {

  public function getNew($user_id){
    $query = $this->db->order_by('date', 'DESC');
    $result = $query->get_where("notification", array("user_id" => $user_id, "seen" => false));
    return $result->result_array();
  }

  public function getAll($user_id){
    $query = $this->db->order_by('date', 'DESC');
    $result = $query->get_where("notification", array("user_id" => $user_id));
    return $result->result_array();
  }

  public function updateSeen($user_id, $notification_id){
    $query = $this->db->set('seen', true);
    $query->where('user_id', $user_id);
    $query->where('id', $notification_id);
    $query->update("notification");
  }

  public function delete($user_id, $notification_id){

    $this->db->delete('notification', array('user_id'=>$user_id, 'id'=>$notification_id));
  }
}