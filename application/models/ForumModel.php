<?php
class ForumModel extends CI_Model { //forum & thread & thread_post

    public function getForumByID($id) {
        $query = $this->db->get_where("forum", array('id' => $id));
        return $query->result_array();
    }

    public function insertForum($data) {
        $this->db->insert("forum", $data);
        $data["forum_id"] = $this->db->insert_id();
        return $data;
    }
}