<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

    public function index() {
        $this->load->helper('url'); $data["base_url"] = base_url();
        $this->load->view('templates/head', $data);
        echo "</head><body><main><h2>Scripts da BD:</h2>";
        echo "<br><a href='".base_url()."database/s1'>Reset dos dados s1</a>";
        echo "</main>";$this->load->view('templates/footer'); 
    }


    public function s1()
    {
        /*PONTO DE SITUAÇÂO:
            aluno_aula
            aluno_cadeira
            aluno_curso
            ano_letivo
            aula
            curso
            cadeira
            etapa
            faculdade
            grupo
            grupo_aluno
            professor_aula
            professor_cadeira
            projeto
            user

        FALTA:
            etapa_submit
            evento
            evento_grupo
            evento_user
            forum
            grupo_msg
            horario_duvidas
            member_classification
            provate_chat
            private_chat_msg
            tarefa
            thread
            thread_post
        */

        $time_start = microtime(true); 
        #$this->db->db_debug = false; //desligar erros da bd
        #$this->db->db_debug = ENVIRONMENT !== 'production'; //voltar a ligar erros da BD, se necessário

        ///////////////////////////////
        //          ALUNOS
        ///////////////////////////////
        $this->db->where_in('email', Array("1@gmail.com","2@gmail.com","3@gmail.com","4@gmail.com","5@gmail.com","6@gmail.com",
            "7@gmail.com","8@gmail.com","9@gmail.com","10@gmail.com","11@gmail.com","12@gmail.com","13@gmail.com","14@gmail.com",
            "15@gmail.com","16@gmail.com","17@gmail.com","18@gmail.com","19@gmail.com","20@gmail.com",)); $this->db->delete('user');

        $this->db->insert("user", Array("name"=>"Henrique", "surname"=>"Francisco", "email"=>"1@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"This a great description"));
            $aluno1_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Joana",    "surname"=>"Almeida",   "email"=>"2@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Gosto de entrar em salas do Zoom."));
            $aluno2_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Rafael",   "surname"=>"Sousa",     "email"=>"3@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Está calor hoje"));
            $aluno3_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Maria",    "surname"=>"Silva",     "email"=>"4@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Tue eras aquela"));
            $aluno4_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"David",    "surname"=>"Peixoto",   "email"=>"5@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Que eu mais queria"));
            $aluno5_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Raquel",   "surname"=>"Williams",  "email"=>"6@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"P'ra me dar algum conforto e companhia"));
            $aluno6_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"João",     "surname"=>"Smith",     "email"=>"7@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Era só contigo que eu sonhava andar"));
            $aluno7_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Inês",     "surname"=>"Pereira",   "email"=>"8@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"P'ra todo lado e até quem sabe"));
            $aluno8_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Eduardo",  "surname"=>"Ye",        "email"=>"9@gmail.com", "role"=>"student","password"=>md5(""),
            "description"=>"Talvez casar"));
            $aluno9_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"White",     "email"=>"10@gmail.com","role"=>"student","password"=>md5(""),
            "description"=>"Ai o que eu passei"));
            $aluno10_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Joel",     "surname"=>"Figueiredo","email"=>"11@gmail.com","role"=>"student","password"=>md5(""),
            "description"=>"Só por te amar"));
            $aluno11_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Cecília",  "surname"=>"Gomes",     "email"=>"12@gmail.com","role"=>"student","password"=>md5(""),
            "description"=>"A saliva que eu gastei para te mudar"));
            $aluno12_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Jasmim",   "surname"=>"Pereira",   "email"=>"13@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Mas esse teu mundo era mais forte do que eu", "gabinete"=>"3.1.19"));
            $prof1_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Pedro",    "surname"=>"Cegueira",  "email"=>"14@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"E nem com a força da música ele se moveu", "gabinete"=>"3.2.15"));
            $prof2_id = $this->db->insert_id();
        $this->db->insert("user", Array("name"=>"Carolina", "surname"=>"Sousa",     "email"=>"15@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Mesmo sabendo que não gostavas", "gabinete"=>"A234"));
        $this->db->insert("user", Array("name"=>"Catarina", "surname"=>"Ricardo",   "email"=>"16@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"EMpenhei o meu anel de rubi", "gabinete"=>"7.23.4"));
        $this->db->insert("user", Array("name"=>"Joacine",  "surname"=>"Silva",     "email"=>"17@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"P'ra te levar ao concerto", "gabinete"=>"3.4.5"));
        $this->db->insert("user", Array("name"=>"Cristina", "surname"=>"Félix",     "email"=>"18@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Que havia no rivolli", "gabinete"=>"Lisboa"));
        $this->db->insert("user", Array("name"=>"Geraldo",  "surname"=>"Artur",     "email"=>"19@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"E era só a ti que eu mais queria", "gabinete"=>"6.2123"));
        $this->db->insert("user", Array("name"=>"Rodolfo",  "surname"=>"Maia",      "email"=>"20@gmail.com","role"=>"teacher","password"=>md5(""),
            "description"=>"Ao meu lado no concerto nesse dia", "gabinete"=>"1.2.3"));

        ///////////////////////////////
        //          FACULDADES
        ///////////////////////////////
        $this->db->where_in('siglas', Array("FCUL","FDUL","FLUL","FAUL","IST")); $this->db->delete('faculdade');
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Ciências",       "siglas"=>"FCUL", "location"=>"Campo Grande")); $faculdade1_id = $this->db->insert_id();
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Direito",        "siglas"=>"FDUL", "location"=>"Campus da UL")); $faculdade2_id = $this->db->insert_id();
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Letras",         "siglas"=>"FLUL", "location"=>"Reitoria da UL"));
        $this->db->insert("faculdade", Array("name"=>"Faculdade de Arquitetura",    "siglas"=>"FAUL", "location"=>"Ninguém sabe"));
        $this->db->insert("faculdade", Array("name"=>"Instituto Superior Técnico",  "siglas"=>"IST",  "location"=>"Alameda, Lisboa"));

        ///////////////////////////////
        //          ANO LETIVO
        ///////////////////////////////
        $this->db->delete('ano_letivo', Array('inicio'=>"2019"));
        $this->db->insert("ano_letivo", Array("inicio"=>"2019", "fim"=>"2020")); $ano1_id = $this->db->insert_id();

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

        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"SI2387",   "name"=>"Sistemas Interativos", "sigla"=>"SI",
            "description"=>"Kekerino"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"TI298",    "name"=>"Teoria de Imagem", "sigla"=>"TI",
            "description"=>"Não tem descriçao"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"EDM24653", "name"=>"Elementos de Matemática", "sigla"=>"EM",
            "description"=>"Adoro Gelatina"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso1_id, "code"=>"CIN234",   "name"=>"Cinematografia", "sigla"=>"Cinema",
            "description"=>"Crocodildo"));
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"TEA84",    "name"=>"Teatro", "sigla"=>"Teatro",
            "description"=>"Ewwwww")); $cadeira1_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"ADC23523", "name"=>"Arquitetura de Computadores", "sigla"=>"AC",
            "description"=>"Espinafres na sopa")); $cadeira2_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"RED0923",  "name"=>"Redes", "sigla"=>"Redes",
            "description"=>"Blach blah")); $cadeira3_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"LE34",     "name"=>"Línguas Estrangeiras", "sigla"=>"LingE",
            "description"=>"Nope")); $cadeira4_id = $this->db->insert_id();
        $this->db->insert("cadeira", Array("curso_id"=> $curso2_id, "code"=>"HO182",    "name"=>"História do Oriente", "sigla"=>"HO",
            "description"=>"Podem escrever mais aqui.")); $cadeira5_id = $this->db->insert_id();

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
        //          INSCRIÇÔES EM CURSOS
        ///////////////////////////////
        $this->db->insert_batch('aluno_curso', Array(
            Array("user_id"=> $aluno1_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
            Array("user_id"=> $aluno2_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
            Array("user_id"=> $aluno3_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
            Array("user_id"=> $aluno4_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
            Array("user_id"=> $aluno5_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
            Array("user_id"=> $aluno6_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
        ));
        ///////////////////////////////
        //          INSCRIÇÔES DE ALUNOS EM CADEIRAS
        ///////////////////////////////
        $this->db->insert_batch('aluno_cadeira', Array(
            Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "image_url"=>"1", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "image_url"=>"2", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>False, "image_url"=>"3", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "image_url"=>"4", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "image_url"=>"5", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno2_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "image_url"=>"1", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno2_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "image_url"=>"2", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno3_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>True,  "image_url"=>"3", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno3_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "image_url"=>"4", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno4_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "image_url"=>"5", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno5_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "image_url"=>"1", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno6_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "image_url"=>"2", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno6_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>False, "image_url"=>"3", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno7_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "image_url"=>"4", "last_visited"=>date('Y-m-d H:i:s')),
            Array("user_id"=> $aluno8_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "image_url"=>"5", "last_visited"=>date('Y-m-d H:i:s')),
        ));       
        ///////////////////////////////
        //          INSCRIÇÔES DE PROFESSORES EM CADEIRAS
        ///////////////////////////////
        $this->db->insert_batch('professor_cadeira', Array(
            Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira1_id, "image_url"=>"1"),
            Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira2_id, "image_url"=>"2"),
            Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira3_id, "image_url"=>"3"),
            Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira4_id, "image_url"=>"4"),
            Array("user_id"=> $prof2_id, "cadeira_id"=>$cadeira1_id, "image_url"=>"1"),
            Array("user_id"=> $prof2_id, "cadeira_id"=>$cadeira2_id, "image_url"=>"2"),
        )); 
        ///////////////////////////////
        //          INSCRIÇÔES EM AULAS
        ///////////////////////////////
        $this->db->insert_batch('aluno_aula', Array(
            Array("user_id"=> $aluno1_id, "aula_id"=>$aula5_id),
            Array("user_id"=> $aluno1_id, "aula_id"=>$aula4_id),
            Array("user_id"=> $aluno1_id, "aula_id"=>$aula3_id),
            Array("user_id"=> $aluno1_id, "aula_id"=>$aula2_id),
            Array("user_id"=> $aluno1_id, "aula_id"=>$aula1_id),
            Array("user_id"=> $aluno2_id, "aula_id"=>$aula1_id),
            Array("user_id"=> $aluno2_id, "aula_id"=>$aula2_id)
        )); 
        $this->db->insert_batch('professor_aula', Array(
            Array("user_id"=> $prof1_id,  "aula_id"=>$aula5_id),
            Array("user_id"=> $prof1_id,  "aula_id"=>$aula4_id),
            Array("user_id"=> $prof1_id,  "aula_id"=>$aula3_id),
            Array("user_id"=> $prof1_id,  "aula_id"=>$aula2_id),
            Array("user_id"=> $prof1_id,  "aula_id"=>$aula1_id)
        )); 
        
        ///////////////////////////////
        //          PROJETOS
        ///////////////////////////////
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira1_id, "nome"=>"Evolução da Ciência", "description"=>"Texto que descreve este projeto científico.",
            "min_elementos"=>1, "max_elementos"=>2, "enunciado_url"=>"")); $projeto1_id = $this->db->insert_id();
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira1_id, "nome"=>"História das Artes", "description"=>"Ninguém quer saber quando escolhe artes, mas pronto",
            "min_elementos"=>3, "max_elementos"=>4, "enunciado_url"=>"")); $projeto2_id = $this->db->insert_id();
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira2_id, "nome"=>"Inteligência Artificial", "description"=>"Quando não percebes o código que escreveste...",
            "min_elementos"=>2, "max_elementos"=>6, "enunciado_url"=>""));
        ///////////////////////////////
        //          ETAPAS
        ///////////////////////////////
        $this->db->insert("etapa", Array("projeto_id"=> $projeto1_id, "deadline"=>"2020-12-12 11:11:00", "enunciado_url"=>"",
            "nome"=>"Pesquisa", "description"=>"Façam pesquisa no StackOverflow.")); $etapa1_id = $this->db->insert_id();
        $this->db->insert("etapa", Array("projeto_id"=> $projeto1_id, "deadline"=>"2020-10-11 11:10:00", "enunciado_url"=>"",
            "nome"=>"Implementação", "description"=>"Copiem o código do StackOverflow."));
        ///////////////////////////////
        //          GRUPO
        ///////////////////////////////
        $this->db->insert("grupo", Array("projeto_id"=> $projeto1_id, "name"=>"1")); $grupo1_id = $this->db->insert_id();
        $this->db->insert("grupo", Array("projeto_id"=> $projeto1_id, "name"=>"2")); $grupo2_id = $this->db->insert_id();
        $this->db->insert("grupo", Array("projeto_id"=> $projeto1_id, "name"=>"Nome Customizado")); $grupo3_id = $this->db->insert_id();
        $this->db->insert("grupo", Array("projeto_id"=> $projeto2_id, "name"=>"3")); $grupo4_id = $this->db->insert_id();
        ///////////////////////////////
        //          INSCRIÇÔES EM GRUPOS
        ///////////////////////////////
        $this->db->insert_batch('grupo_aluno', Array(
            Array("user_id"=> $aluno1_id,  "grupo_id"=>$grupo1_id),
            Array("user_id"=> $aluno1_id,  "grupo_id"=>$grupo2_id),
            Array("user_id"=> $aluno2_id,  "grupo_id"=>$grupo1_id),
            Array("user_id"=> $aluno3_id,  "grupo_id"=>$grupo1_id),
            Array("user_id"=> $aluno2_id,  "grupo_id"=>$grupo2_id),
            Array("user_id"=> $aluno3_id,  "grupo_id"=>$grupo3_id),
            Array("user_id"=> $aluno1_id,  "grupo_id"=>$grupo4_id),
            Array("user_id"=> $aluno5_id,  "grupo_id"=>$grupo3_id),
            Array("user_id"=> $aluno3_id,  "grupo_id"=>$grupo4_id),
        )); 
        


        $execution_time = microtime(true) - $time_start;

        $this->load->helper('url'); $data["base_url"] = base_url(); $this->load->view('templates/head', $data);
        echo "</head><body><main><h2>Processo concluído em ".$execution_time." segundos </h2><h3>Exemplos</h3>";
        echo "<p><b>Aluno principal</b> -> 1@gmail.com</p>";
        echo "<p><b>Prof principal</b> -> 13@gmail.com</p>";
        echo "<p><b>Cadeira principal</b> -> Teatro</p>";
        echo "<p><b>Projeto principal</b> -> Evolução da Ciência</p>";
        echo "</main>"; $this->load->view('templates/footer');
    }

}