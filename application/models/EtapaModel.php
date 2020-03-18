<?php
class EtapaModel extends CI_Model {
    public function insertEtapa($data){
        $this->db->insert("etapa", $data);
    }
}
