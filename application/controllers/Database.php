<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

    //      database/s1/
    public function s1()
    {
        /*PONTO DE SITUAÇÂO:
            user
            faculdade
            ano_letivo
            aula
            aluno_aula
            projeto
            etapa
            curso
            cadeira
            aluno_cadeira
            professor_cadeira
            etapa
        */

        #$this->db->db_debug = false; //desligar erros da bd
        #$this->db->db_debug = ENVIRONMENT !== 'production'; //voltar a ligar erros da BD, se necessário

        ///////////////////////////////
        //          ALUNOS
        ///////////////////////////////
        $this->db->delete('user', Array('description'=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Henrique", "surname"=>"Francisco", "email"=>"1@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem")); $aluno1_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Joana",    "surname"=>"Almeida",   "email"=>"2@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem")); $aluno2_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Rafael",   "surname"=>"Sousa",     "email"=>"3@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Maria",    "surname"=>"Silva",     "email"=>"4@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"David",    "surname"=>"Peixoto",   "email"=>"5@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Raquel",   "surname"=>"Williams",  "email"=>"6@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"João",     "surname"=>"Smith",     "email"=>"7@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Inês",     "surname"=>"Pereira",   "email"=>"8@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Eduardo",  "surname"=>"Ye",        "email"=>"9@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"White",     "email"=>"10@gmail.com","role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Joel",     "surname"=>"Figueiredo","email"=>"11@gmail.com","role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Cecília",  "surname"=>"Gomes",     "email"=>"12@gmail.com","role"=>"student","password"=>md5(""),
            "description"=>"Não alterem"));
        $this->db->insert("user", Array("name"=>"Jasmim",   "surname"=>"Pereira",   "email"=>"13@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"3.1.19")); $prof1_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Pedro",    "surname"=>"Cegueira",  "email"=>"14@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"3.2.15")); $prof2_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Carolina", "surname"=>"Sousa",     "email"=>"15@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"A234"));
        $this->db->insert("user", Array("name"=>"Catarina", "surname"=>"Ricardo",   "email"=>"16@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"7.23.4"));
        $this->db->insert("user", Array("name"=>"Joacine",  "surname"=>"Silva",     "email"=>"17@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"3.4.5"));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"Félix",     "email"=>"18@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"Lisboa"));
        $this->db->insert("user", Array("name"=>"Geraldo",  "surname"=>"Artur",     "email"=>"19@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"6.2123"));
        $this->db->insert("user", Array("name"=>"Rodolfo",  "surname"=>"Maia",      "email"=>"20@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Não alterem", "gabinete"=>"1.2.3"));

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
        $this->db->insert("curso", Array("faculdade_id"=> $faculdade1_id, "ano_letivo_id"=> $ano1_id, "code"=>"MAT2022", "name"=>"Matemática",
            "description"=>"Descição positiva"));
        $this->db->insert("curso", Array("faculdade_id"=> $faculdade1_id, "ano_letivo_id"=> $ano1_id, "code"=>"FS2022", "name"=>"Física",
            "description"=>"Descriçao com erros")); $curso1_id = $this->db->insert_id();
        $this->db->insert("curso", Array("faculdade_id"=> $faculdade2_id, "ano_letivo_id"=> $ano1_id, "code"=>"LTI2022", "name"=>"Tecnologias",
            "description"=>"10/10 IGN")); $curso2_id = $this->db->insert_id();

        ///////////////////////////////
        //          CADEIRAS
        ///////////////////////////////

        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"SI2387",   "name"=>"Sistemas Interativos",
            "description"=>"Kekerino"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"TI298",    "name"=>"Teoria de Imagem",
            "description"=>"Não tem descriçao"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"EDM24653", "name"=>"Elementos de Matemática",
            "description"=>"Adoro Gelatina"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"CIN234",   "name"=>"Cinematografia",
            "description"=>"Crocodildo"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"TEA84",    "name"=>"Teatro",
            "description"=>"Ewwwww")); $cadeira1_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"ADC23523", "name"=>"Arquitetura de Computadores",
            "description"=>"Espinafres na sopa")); $cadeira2_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"RED0923",  "name"=>"Redes",
            "description"=>"Blach blah")); $cadeira3_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"LE34",     "name"=>"Línguas Estrangeiras",
            "description"=>"Nope")); $cadeira4_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"HO182",    "name"=>"História do Oriente",
            "description"=>"Podem escrever mais aqui.")); $cadeira5_id = $this->db->insert_id();

        ///////////////////////////////
        //          INSCRIÇÔES DE ALUNOS EM CADEIRAS
        ///////////////////////////////
        $this->db->insert("aluno_cadeira", Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "image_url"=>"1"));
        $this->db->insert("aluno_cadeira", Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "image_url"=>"2"));
        $this->db->insert("aluno_cadeira", Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>False, "image_url"=>"3"));
        $this->db->insert("aluno_cadeira", Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "image_url"=>"4"));
        $this->db->insert("aluno_cadeira", Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "image_url"=>"5"));
        
        ///////////////////////////////
        //          INSCRIÇÔES DE PROFESSORES EM CADEIRAS
        ///////////////////////////////
        $this->db->insert("professor_cadeira", Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira1_id, "image_url"=>"1"));
        $this->db->insert("professor_cadeira", Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira2_id, "image_url"=>"2"));
        $this->db->insert("professor_cadeira", Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira3_id, "image_url"=>"3"));
        $this->db->insert("professor_cadeira", Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira4_id, "image_url"=>"4"));

        ///////////////////////////////
        //          AULAS
        ///////////////////////////////
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira1_id, "type"=>"PL", "start_time"=>"10:30", "end_time"=>"12:00",
            "day_week"=>"quinta-feira", "classroom"=>"1.3.35")); $aula1_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira1_id, "type"=>"T", "start_time"=>"10:00", "end_time"=>"12:00",
            "day_week"=>"terça-feira", "classroom"=>"1.3.40")); $aula2_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira1_id, "type"=>"TP", "start_time"=>"15:30", "end_time"=>"17:00",
            "day_week"=>"segunda-feira", "classroom"=>"1.3.35")); $aula3_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira2_id, "type"=>"PL", "start_time"=>"16:30", "end_time"=>"18:00",
            "day_week"=>"sexta-feira", "classroom"=>"3.1.35")); $aula4_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira2_id, "type"=>"T", "start_time"=>"08:00", "end_time"=>"9:30",
            "day_week"=>"terça-feira", "classroom"=>"6.3.10")); $aula5_id = $this->db->insert_id();

        ///////////////////////////////
        //          INSCRIÇÔES EM AULAS
        ///////////////////////////////
        $this->db->insert("aluno_aula", Array("user_id"=> $aluno1_id, "aula_id"=>$aula1_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $aluno1_id, "aula_id"=>$aula2_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $aluno1_id, "aula_id"=>$aula3_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $aluno1_id, "aula_id"=>$aula4_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $aluno1_id, "aula_id"=>$aula5_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $prof1_id,  "aula_id"=>$aula1_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $prof1_id,  "aula_id"=>$aula2_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $prof1_id,  "aula_id"=>$aula3_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $prof1_id,  "aula_id"=>$aula4_id));
        $this->db->insert("aluno_aula", Array("user_id"=> $prof1_id,  "aula_id"=>$aula5_id));

        ///////////////////////////////
        //          PROJETOS
        ///////////////////////////////
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira1_id, "nome"=>"Evolução da Ciência", "description"=>"Texto que descreve este projeto científico.",
            "min_elementos"=>1, "max_elementos"=>2, "enunciado_url"=>"")); $projeto1_id = $this->db->insert_id();
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira1_id, "nome"=>"História das Artes", "description"=>"Ninguém quer saber quando escolhe artes, mas pronto",
            "min_elementos"=>3, "max_elementos"=>4, "enunciado_url"=>""));
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira2_id, "nome"=>"Inteligência Artificial", "description"=>"Quando não percebes o código que escreveste...",
            "min_elementos"=>2, "max_elementos"=>6, "enunciado_url"=>""));


        ///////////////////////////////
        //          ETAPAS
        ///////////////////////////////
        $this->db->insert("etapa", Array("projeto_id"=> $projeto1_id, "deadline"=>"2020-12-12 11:11:00", "enunciado_url"=>"",
            "nome"=>"Pesquisa", "description"=>"Façam pesquisa no StackOverflow.")); $etapa1_id = $this->db->insert_id();
        $this->db->insert("etapa", Array("projeto_id"=> $projeto1_id, "deadline"=>"2020-10-11 11:10:00", "enunciado_url"=>"",
            "nome"=>"Implementação", "description"=>"Copiem o código do StackOverflow."));
        

        






        $this->load->helper('url'); $data["base_url"] = base_url(); $this->load->view('templates/head', $data);
        echo "</head><body><main><h2>Processo concluído.</h2><h3>Exemplos</h3>";
        echo "<p><b>Aluno principal</b> 1@gmail.com</p>";
        echo "<p><b>Prof principal</b> 13@gmail.com</p>";
        echo "<p><b>Cadeira principal</b> Teatro</p>";
        echo "<p><b>Projeto principal</b> Evolução da Ciência</p>";
        echo "</main>"; $this->load->view('templates/footer');
    }

}