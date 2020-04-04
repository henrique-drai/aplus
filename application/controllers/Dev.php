<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dev extends CI_Controller {

    //      dev/dataset/
    public function dataset()
    {
        #$this->db->db_debug = false; //desligar erros da bd


        ///////////////////////////////
        //          ALUNOS
        ///////////////////////////////
        $this->db->delete('user', Array('description'=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Henrique", "surname"=>"Francisco", "email"=>"1@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem")); $aluno1_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Joana",    "surname"=>"Almeida",   "email"=>"2@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Rafael",   "surname"=>"Sousa",     "email"=>"3@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Maria",    "surname"=>"Silva",     "email"=>"4@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"David",    "surname"=>"Peixoto",   "email"=>"5@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Raquel",   "surname"=>"Williams",  "email"=>"6@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"João",     "surname"=>"Smith",     "email"=>"7@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Inês",     "surname"=>"Pereira",   "email"=>"8@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Eduardo",  "surname"=>"Ye",        "email"=>"9@gmail.com", "role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"White",     "email"=>"10@gmail.com","role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Joel",     "surname"=>"Figueiredo","email"=>"11@gmail.com","role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Cecília",  "surname"=>"Gomes",     "email"=>"12@gmail.com","role"=>"student","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Jasmim",   "surname"=>"Pereira",   "email"=>"13@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Pedro",    "surname"=>"Cegueira",  "email"=>"14@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Carolina", "surname"=>"Sousa",     "email"=>"15@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Catarina", "surname"=>"Ricardo",   "email"=>"16@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Joacine",  "surname"=>"Silva",     "email"=>"17@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"Félix",     "email"=>"18@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Geraldo",  "surname"=>"Artur",     "email"=>"19@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Rodolfo",  "surname"=>"Maia",      "email"=>"20@gmail.com","role"=>"teacher","password"=>md5(""),"description"=>"Não alterem"));

        ///////////////////////////////
        //          FACULDADES
        ///////////////////////////////
        $this->db->delete('faculdade', Array('location'=>"Não alterem"));
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Ciências",       "siglas"=>"FCUL", "location"=>"Não alterem")); $faculdade1_id = $this->db->insert_id();
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Direito",        "siglas"=>"FDUL", "location"=>"Não alterem")); $faculdade2_id = $this->db->insert_id();
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Letras",         "siglas"=>"FLUL", "location"=>"Não alterem"));
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Arquitetura",    "siglas"=>"FAUL", "location"=>"Não alterem"));
        $this->db->insert("faculdade", Array("name"=>"Instituto Superior Técnico",  "siglas"=>"IST",  "location"=>"Não alterem"));

        ///////////////////////////////
        //          ANO LETIVO
        ///////////////////////////////
        $this->db->delete('ano_letivo', Array('inicio'=>"2022"));
        $this->db->insert("ano_letivo", Array("inicio"=>"2022", "fim"=>"2023")); $ano1_id = $this->db->insert_id();

        ///////////////////////////////
        //          CURSOS
        ///////////////////////////////
        $this->db->delete('curso', Array('description'=>"Não alterem"));
        $this->db->insert("curso", Array("faculdade_id"=> $faculdade1_id, "ano_letivo_id"=> $ano1_id, "code"=>"MAT2022", "name"=>"Matemática", "description"=>"Não alterem"));
        $this->db->insert("curso", Array("faculdade_id"=> $faculdade1_id, "ano_letivo_id"=> $ano1_id, "code"=>"FS2022", "name"=>"Física", "description"=>"Não alterem"));
        $this->db->insert("curso", Array("faculdade_id"=> $faculdade2_id, "ano_letivo_id"=> $ano1_id, "code"=>"LTI2022", "name"=>"Tecnologias", "description"=>"Não alterem")); $curso1_id = $this->db->insert_id();


        echo "Feito :)";

        #$this->db->db_debug = ENVIRONMENT !== 'production'; //voltar a ligar erros da BD, se necessário
    }

}