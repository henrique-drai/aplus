<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dev extends CI_Controller {

    //      dev/dataset/
    public function dataset()
    {
        #$this->db->db_debug = false; //desligar erros da bd
        $this->db->delete('user', Array('email'=>"1@gmail.com"));
        $this->db->delete('user', Array('email'=>"2@gmail.com"));
        $this->db->delete('user', Array('email'=>"3@gmail.com"));
        $this->db->delete('user', Array('email'=>"4@gmail.com"));
        $this->db->delete('user', Array('email'=>"5@gmail.com"));
        $this->db->delete('user', Array('email'=>"6@gmail.com"));
        $this->db->delete('user', Array('email'=>"7@gmail.com"));
        $this->db->delete('user', Array('email'=>"8@gmail.com"));
        $this->db->delete('user', Array('email'=>"9@gmail.com"));
        $this->db->delete('user', Array('email'=>"10@gmail.com"));
        $this->db->delete('user', Array('email'=>"11@gmail.com"));
        $this->db->delete('user', Array('email'=>"12@gmail.com"));
        $this->db->delete('user', Array('email'=>"13@gmail.com"));
        $this->db->delete('user', Array('email'=>"14@gmail.com"));
        $this->db->delete('user', Array('email'=>"15@gmail.com"));
        $this->db->delete('user', Array('email'=>"16@gmail.com"));
        $this->db->delete('user', Array('email'=>"17@gmail.com"));
        $this->db->delete('user', Array('email'=>"18@gmail.com"));
        $this->db->delete('user', Array('email'=>"19@gmail.com"));
        $this->db->delete('user', Array('email'=>"20@gmail.com"));

        echo "Criando os alunos...<br>";
        $this->db->insert("user", Array("name"=>"Henrique", "surname"=>"Francisco", "email"=>"1@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Joana",    "surname"=>"Almeida",   "email"=>"2@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Rafael",   "surname"=>"Sousa",     "email"=>"3@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Maria",    "surname"=>"Silva",     "email"=>"4@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"David",    "surname"=>"Peixoto",   "email"=>"5@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Raquel",   "surname"=>"Williams",  "email"=>"6@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"João",     "surname"=>"Smith",     "email"=>"7@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Inês",     "surname"=>"Pereira",   "email"=>"8@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Eduardo",  "surname"=>"Ye",        "email"=>"9@gmail.com", "role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"White",     "email"=>"10@gmail.com","role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Joel",     "surname"=>"Figueiredo","email"=>"11@gmail.com","role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Cecília",  "surname"=>"Gomes",     "email"=>"12@gmail.com","role"=>"student","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Jasmim",   "surname"=>"Pereira",   "email"=>"13@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Pedro",    "surname"=>"Cegueira",  "email"=>"14@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Carolina", "surname"=>"Sousa",     "email"=>"15@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Catarina", "surname"=>"Ricardo",   "email"=>"16@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Joacine",  "surname"=>"Silva",     "email"=>"17@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"Félix",     "email"=>"18@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Geraldo",  "surname"=>"Artur",     "email"=>"19@gmail.com","role"=>"teacher","password"=>"","description"=>""));
        $this->db->insert("user", Array("name"=>"Rodolfo",  "surname"=>"Maia",      "email"=>"20@gmail.com","role"=>"teacher","password"=>"","description"=>""));


        echo "Criando as faculdades...<br>";




        #$this->db->db_debug = ENVIRONMENT !== 'production'; //voltar a ligar erros da BD, se necessário
    }

}