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

    public function getEventsByUserId($id) {
        $query = "select * 
            from evento, evento_user
            where evento.id = evento_user.evento_id
            and evento_user.user_id = ".$id;
        $result = $this->db->query($query);
        return $result->result_array();
    }
}


// SELECT name, price, photo
// FROM drinks, drinks_photos
// WHERE drinks.id = drinks_id 
// GROUP BY drinks_id