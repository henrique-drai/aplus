<?php
class ForumModel extends CI_Model { //forum & thread & thread_post

    public function getForumByID($id) {
        $query = $this->db->get_where("forum", array('id' => $id));
        return $query->row();
    }

    public function getForumByCadeiraID($id) {
        $query = $this->db->get_where("forum", array('cadeira_id' => $id));
        return $query->result_array();
    }

    public function getThreadByID($id) {
        $query = $this->db->get_where("thread", array('id' => $id));
        return $query->row();
    }

    public function insertForum($data) {
        $this->db->insert("forum", $data);
        $data["forum_id"] = $this->db->insert_id();
        return $data;
    }

    public function getThreads($id) {
        $query = $this->db->get_where("thread", array('forum_id' => $id));
        return $query->result_array();
    }

    public function insertThread($data) {
        $this->db->insert("thread", $data);
        $this->db->insert_id();
    }
}