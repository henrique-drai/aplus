<?php
class CourseModel extends CI_Model {

    public function getCourseByCode($code) {
        $query = $this->db->get_where('cadeira', array('code' => $code));
        return $query->row();
    }

}