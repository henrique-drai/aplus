<?php
class ScriptModel extends CI_Model {

  public function student($name, $surname, $email, $password, $description) {
    $this->db->delete("user", ['email' => $email]);
    $this->db->insert("user", Array("name"=>$name, "surname"=>$surname, "email"=>$email, "role"=>"student", "password"=>md5($password), "description"=>$description));
    return $this->db->insert_id();
  }

  public function teacher($name, $surname, $email, $password, $description, $gabinete) {
      $this->db->delete("user", ['email' => $email]);
      $this->db->insert("user", Array("name"=>$name, "surname"=>$surname, "email"=>$email, "role"=>"teacher", "password"=>md5($password), "description"=>$description, "gabinete"=>$gabinete));
      return $this->db->insert_id();
  }

  public function notification($user_id, $type, $title, $content, $link, $seen, $date) {
      $this->db->insert("notification", Array("user_id"=>$user_id, "type"=>$type, "title"=>$title, "content"=>$content, "link"=>$link, "seen"=>$seen, "date"=>$date,));
      return $this->db->insert_id();
  }

  public function cadeira($curso_id, $code, $name, $sigla, $description, $color) {
      $this->db->insert("cadeira", Array("curso_id"=> $curso_id, "code"=>$code, "name"=>$name, "sigla"=>$sigla, "description"=>$description, "color"=>$color));
      return $this->db->insert_id();
  }

  public function evento($start_date, $end_date, $name, $description, $location) {
      $this->db->delete("evento", ['description' => $description]);
      $this->db->insert("evento", Array("start_date"=> $start_date, "end_date"=>$end_date, "name"=>$name, "description"=>$description, "location"=>$location));
      return $this->db->insert_id();
  }

  public function projeto($cadeira_id, $nome, $description, $min_elementos, $max_elementos, $enunciado_url) {
      $this->db->insert("projeto", Array("cadeira_id"=> $cadeira_id, "nome"=>$nome, "description"=>$description, "min_elementos"=>$min_elementos, "max_elementos"=>$max_elementos, "enunciado_url"=>$enunciado_url));
      return $this->db->insert_id();
  }

  public function etapa($projeto_id, $deadline, $enunciado_url, $nome, $description) {
      $this->db->insert("etapa", Array("projeto_id"=> $projeto_id, "deadline"=>$deadline, "enunciado_url"=>$enunciado_url, "nome"=>$nome, "description"=>$description));
      return $this->db->insert_id();
  }

  public function grupo($projeto_id, $name) {
      $this->db->insert("grupo", Array("projeto_id"=> $projeto_id, "name"=>$name));
      return $this->db->insert_id();
  }
}


