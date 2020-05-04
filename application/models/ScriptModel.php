<?php
class ScriptModel extends CI_Model {

  public function batch($table, $array) {
    $this->db->insert_batch($table, $array);
  }

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

  public function cadeira($curso_id, $code, $name, $sigla, $semestre, $description, $color) {
      $this->db->insert("cadeira", Array("curso_id"=> $curso_id, "code"=>$code, "name"=>$name, "sigla"=>$sigla, "semestre"=>$semestre, "description"=>$description, "color"=>$color));
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

  public function faculdade($name, $siglas, $location) {
    $this->db->delete("faculdade", ['name' => $name]);
    $this->db->insert("faculdade", Array("name"=> $name, "siglas"=>$siglas, "location"=>$location));
    return $this->db->insert_id();
  }

  public function ano_letivo($inicio, $fim) {
    $this->db->delete("ano_letivo", ['inicio' => $inicio]);
    $this->db->insert("ano_letivo", Array("inicio"=> $inicio, "fim"=>$fim));
    return $this->db->insert_id();
  }

  public function curso($faculdade_id, $ano_id, $code, $name, $description) {
    $this->db->insert("curso", Array("faculdade_id"=> $faculdade_id, "ano_letivo_id"=>$ano_id, "code"=>$code, "name"=>$name, "description"=>$description));
    return $this->db->insert_id();
  }

  public function aula($cadeira_id, $type, $start_time, $end_time, $day_week, $classroom) {
    $this->db->insert("aula", Array("cadeira_id"=> $cadeira_id, "type"=>$type, "start_time"=>$start_time, "end_time"=>$end_time, "day_week"=>$day_week, "classroom"=>$classroom));
    return $this->db->insert_id();
  }

  public function forum($cadeira_id, $name, $description, $teachers_only) {
    $this->db->insert("forum", Array("cadeira_id"=> $cadeira_id, "name"=>$name, "description"=>$description, "teachers_only"=>$teachers_only));
    return $this->db->insert_id();
  }

  public function thread($user_id, $forum_id, $title, $content, $date) {
    $this->db->insert("thread", Array("user_id"=> $user_id, "forum_id"=>$forum_id, "title"=>$title, "content"=>$content, "date"=>$date));
    return $this->db->insert_id();
  }

  public function thread_post($thread_id, $user_id, $content, $date) {
    $this->db->insert("thread_post", Array("thread_id"=>$thread_id, "user_id"=>$user_id, "content"=>$content, "date"=>$date));
    return $this->db->insert_id();
  }  

  public function etapa_submit($grupo_id, $etapa_id, $submit_url) {
    $this->db->insert("etapa_submit", Array("grupo_id"=>$grupo_id, "etapa_id"=>$etapa_id, "submit_url"=>$submit_url));
    return $this->db->insert_id();
  }  
}