<?php
class GroupModel extends CI_Model { //grupo & member_classification & grupo_msg

    public function getAllGroups($proj_id){
        return $this->db->get_where("grupo", array("projeto_id" => $proj_id)) -> result_array();
    }

    public function getStudents($group_id){
        return $this->db->get_where("grupo_aluno", array("grupo_id" => $group_id)) -> result_array();
    }

    public function getGroups($user_id){
        return $this->db->get_where("grupo_aluno", array("user_id" => $user_id)) -> result_array();
    }

    public function getProjectId($group_id){
        return $this->db->get_where("grupo", array("id" => $group_id)) -> result_array();
    }

    public function isValidGroup($grupo_id,$user_id) {
        $query = $this->db->get_where('grupo_aluno', array('grupo_id' => $grupo_id,'user_id'=>$user_id));
        return ($query->num_rows() > 0)? true : false;
    }

    public function getProjectAndSubjectInfo($grupo_id){
        $grupo_id = $this->db->escape($grupo_id);
        $query = "select * 
            from grupo, projeto, cadeira
            where grupo.projeto_id = projeto.id 
            and projeto.cadeira_id = cadeira.id
            and grupo.id = $grupo_id";
        return $this->db->query($query)->row();
    }

    public function getClassVal($grupo_id, $userId){
        return $this->db->get_where("member_classification", array("grupo_id" => $grupo_id, "classificado_id" => $userId)) -> row();
    }

    public function insertClassification($data){
        $this->db->insert("member_classification", $data);    
    }

    public function getGroupById($group_id){
        return $this->db->get_where("grupo", array("id" => $group_id)) -> result_array();
    }

    public function userInGroup($group_id,$user_id){
        return $this->db->get_where("grupo_aluno", array("grupo_id" => $group_id, "user_id" =>$user_id)) -> row();
    }
    
    public function leaveGroup($user_id, $group_id){
        $this->db->where("user_id", $user_id);
        $this->db->where("grupo_id", $group_id);
        $this->db->delete('grupo_aluno');
    }

    public function countElements($group_id){
        $q = $this->db->get_where("grupo_aluno", array("grupo_id" => $group_id));
        return $q->num_rows();
    }

    public function createGroup($data){
        $this->db->insert("grupo", $data);
        $data["grupo"] = $this->db->insert_id();
        return $data;
    }

    public function addElementGroup($data){
        $this->db->insert("grupo_aluno", $data);
        $data["grupo_aluno"] = $this->db->insert_id();
        return $data;
    }

    public function deleteGroup($group_id){
        $this->db->where("id", $group_id);
        $this->db->delete('grupo');
    }

    public function getTeachersByGroupId($grupo_id){
        $grupo_id = $this->db->escape($grupo_id);
        $query = "select pc.user_id, pc.cadeira_id, u.name, u.surname, u.picture 
            from grupo g, projeto p, cadeira c, professor_cadeira pc, user u
            where u.id = pc.user_id
            and pc.cadeira_id = c.id
            and p.cadeira_id = c.id
            and p.id = g.projeto_id
            and g.id = $grupo_id";
        return $this->db->query($query)->result_array();
    }

    public function getFicheiroGrupoByURLSub($ficheiro_url, $grupo_id){
        return $this->db->get_where("ficheiros_grupo", array("url_original" => $ficheiro_url, "grupo_id" => $grupo_id))->row();
    }

    public function submit_ficheiro_areagrupo($data){
        $this->db->insert("ficheiros_grupo", $data);  
        return $this->db->insert_id();  
    }

    public function getFicheirosGrupo($grupo_id){
        return $this->db->get_where("ficheiros_grupo", array("grupo_id" => $grupo_id))->result_array();
    }

    public function getFicheiroGrupoById($id){
        return $this->db->get_where("ficheiros_grupo", array("id" => $id))->result_array();
    }

    public function removeFicheiroAreaGrupo($ficheiro_id){
        $this->db->where("id", $ficheiro_id);
        $this->db->delete("ficheiros_grupo");
    }

    public function verifyGroupStudent($user_id, $group_id){
        return $this->db->get_where("grupo_aluno", array("user_id" => $user_id, "grupo_id" => $group_id))->row();
    }

    public function change_ficheiro_areagrupo_url($name_enunciado, $grupo_id){
        $this->db->set("url", $name_enunciado);
        $this->db->where("grupo_id", $grupo_id);
        $this->db->update("ficheiros_grupo");
    }

    public function confirmNameInProject($proj_id, $groupName){
        return $this->db->get_where("grupo", array("projeto_id" => $proj_id, "name" => $groupName))->row();
    }
}