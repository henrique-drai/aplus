<?php
class EventModel extends CI_Model { //evento & horario_duvidas

    public function getClassesByStudentId($id) {
        $query = "select distinct *
            from aluno_aula, curso, ano_letivo, cadeira, aula
            where aula.id = aluno_aula.aula_id
            and cadeira.curso_id = curso.id
            and curso.ano_letivo_id = ano_letivo.id
            and aula.cadeira_id = cadeira.id
            and aluno_aula.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getClassesByTeacherId($id) {
        $query = "select * 
            from professor_aula, curso, ano_letivo, cadeira, aula
            where aula.id = professor_aula.aula_id
            and cadeira.curso_id = curso.id
            and curso.ano_letivo_id = ano_letivo.id
            and aula.cadeira_id = cadeira.id
            and professor_aula.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getFutureEventsByUserId($id) {
        $query = "select * 
            from evento, evento_user
            where evento.id = evento_user.evento_id
            and evento.start_date >= CURDATE()
            and evento_user.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getFutureGroupEventsByUserId($id) {
        $query = "select * 
            from grupo, grupo_aluno, evento_grupo, evento, evento_user
            where grupo.id = grupo_aluno.grupo_id
            and evento_user.user_id = $id
            and evento_user.evento_id = evento.id
            and evento.id = evento_grupo.evento_id
            and evento.start_date >= CURDATE()
            and evento_grupo.grupo_id = grupo.id
            and grupo_aluno.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getFutureSubmissionsByUserId($id) {
        $query = "select * 
            from grupo, grupo_aluno, projeto, cadeira, etapa
            where grupo.id = grupo_aluno.grupo_id
            and etapa.projeto_id = projeto.id
            and projeto.cadeira_id = cadeira.id
            and grupo.projeto_id = projeto.id
            and etapa.deadline >= CURDATE()
            and grupo_aluno.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getFutureSubmissionsByGroupId($grupo_id){
        $id = $this->db->escape($grupo_id);
        $query = "select * 
            from grupo, projeto, etapa
            where etapa.projeto_id = projeto.id
            and grupo.projeto_id = projeto.id
            and etapa.deadline >= CURDATE()
            and grupo.id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getHorarioDuvidasByTeacherId($prof_id) {
        $query = "select * 
            from ano_letivo, faculdade, curso, cadeira, horario_duvidas
            where horario_duvidas.id_cadeira = cadeira.id
            and faculdade.id = curso.faculdade_id
            and cadeira.curso_id = curso.id
            and curso.ano_letivo_id = ano_letivo.id
            and horario_duvidas.id_prof = ".$prof_id;
        return $this->db->query($query)->result_array();
    }

    public function getFutureEventsByGroupId($grupo_id){
        $id = $this->db->escape($grupo_id);
        $query = "select * 
            from grupo g, evento_grupo eg, evento e
            where g.id = eg.grupo_id
            and e.id = eg.evento_id
            and e.start_date >= CURDATE()
            and g.id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getHorarioDuvidasById($id) {
        $query = $this->db->get_where('horario_duvidas', array('id' => $id));
        return $query->row();
    }

    public function insertEvent($data) {
        $this->db->insert('evento', $data);
        return $this->db->insert_id();
    }

    public function insertUserEvent($data) {
        $this->db->insert('evento_user', $data);
    }

    public function insertGroupEvent($data) {
        $this->db->insert('evento_grupo', $data);
    }

    public function insertMeeting($data, $grupo_id) {
        $this->db->insert('evento', $data);
        $evento_id = $this->db->insert_id();
        $this->db->insert('evento_grupo', array(
            "evento_id" => $evento_id,
            "grupo_id" => $grupo_id)
        );
        return $evento_id;
    }

    public function userRelatedToEvent($user_id, $evento_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('evento_id', $evento_id);
        return $this->db->count_all_results('evento_user') > 0;
    }

    public function update($evento_id, $data){
        $this->db->set($data);
        $this->db->where('id', $evento_id);
        return $this->db->update("evento");
    }

    public function delete($id) {
        $this->db->delete('evento', array('id' => $id));
    }

    public function notGoing($user_id, $evento_id) {
        $this->db->delete('evento_user', array(
            'evento_id' => $evento_id,
            'user_id' => $user_id,
        ));
    }

    public function getStudentEvents($user_id) {
        $query = $this->db->get_where('evento_user', array('user_id' => $user_id));
        return $query->result_array();
    }

    public function getEventById($id) {
        $query = $this->db->get_where('evento', array('id' => $id));
        return $query->result_array();
    }

    public function multiplePeopleGoing($data) {
        $this->db->insert_batch("evento_user", $data);
    }
}
