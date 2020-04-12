<?php
class EventModel extends CI_Model { //evento & horario_duvidas

    public function getClassesByStudentId($id) {
        $query = "select *
            from aula, aluno_aula
            where aula.id = aluno_aula.aula_id
            and aluno_aula.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getClassesByTeacherId($id) {
        $query = "select * 
            from aula, professor_aula
            where aula.id = professor_aula.aula_id
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
            from grupo, grupo_aluno, projeto, etapa
            where grupo.id = grupo_aluno.grupo_id
            and etapa.projeto_id = projeto.id
            and grupo.projeto_id = projeto.id
            and etapa.deadline >= CURDATE()
            and grupo_aluno.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }
}


// SELECT name, price, photo
// FROM drinks, drinks_photos
// WHERE drinks.id = drinks_id 
// GROUP BY drinks_id