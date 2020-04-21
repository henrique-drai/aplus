<?php
class EventModel extends CI_Model { //evento & horario_duvidas

    public function getClassesByStudentId($id) {
        $query = "select *
            from aluno_aula, curso, ano_letivo, cadeira, aula
            where aula.id = aluno_aula.aula_id
            and cadeira.curso_id = curso.id
            and curso.ano_letivo_id = ano_letivo.id
            and aula.cadeira_id = cadeira.id
            and aluno_aula.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getClassesByTeacherId($id) {
        $query = "select * 
            from professor_aula, curso, ano_letivo, cadeira, aula
            where aula.id = professor_aula.aula_id
            and cadeira.curso_id = curso.id
            and curso.ano_letivo_id = ano_letivo.id
            and aula.cadeira_id = cadeira.id
            and professor_aula.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getFutureEventsByUserId($id) {
        $query = "select * 
            from evento, evento_user
            where evento.id = evento_user.evento_id
            and evento.start_date >= CURDATE()
            and evento_user.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getFutureGroupEventsByUserId($id) {
        $query = "select * 
            from grupo, grupo_aluno, evento_grupo, evento
            where grupo.id = grupo_aluno.grupo_id
            and evento.id = evento_grupo.evento_id
            and evento.start_date >= CURDATE()
            and evento_grupo.grupo_id = grupo.id
            and grupo_aluno.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getFutureSubmissionsByUserId($id) {
        $query = "select * 
            from grupo, grupo_aluno, projeto, etapa, cadeira
            where grupo.id = grupo_aluno.grupo_id
            and etapa.projeto_id = projeto.id
            and projeto.cadeira_id = cadeira.id
            and grupo.projeto_id = projeto.id
            and etapa.deadline >= CURDATE()
            and grupo_aluno.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    
    public function userRelatedToEvent($user_id, $evento_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('evento_id', $evento_id);
        return $this->db->count_all_results('evento_user') > 0;
    }

    public function delete($id) {
        $this->db->delete('evento', array('id' => $id));
    }
}
