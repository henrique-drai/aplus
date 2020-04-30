<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

    public function index() {
        $this->load->helper('url'); $data["base_url"] = base_url();

        $this->load->view('templates/head', $data);
        $this->load->view('database', $data);
        $this->load->view('templates/footer'); 
    }


    public function reset()
    {
        /*
        FALTA:
            etapa_submit
            grupo_msg
            member_classification
            provate_msg
            tarefa
        */

        $time_start = microtime(true); 

        ///////////////////////////////
        //          ALUNOS
        ///////////////////////////////

        $aluno1_id  = $this->student("Henrique", "Francisco", "1@gmail.com", "", "This a great description");
        $aluno2_id  = $this->student("Joana", "Almeida", "2@gmail.com", "", "Gosto de entrar em salas do Zoom.");
        $aluno3_id  = $this->student("Rafael", "Sousa", "3@gmail.com", "", "Está calor hoje");
        $aluno4_id  = $this->student("Maria", "Silva", "4@gmail.com", "", "Tu eras aquela");
        $aluno5_id  = $this->student("David", "Peixoto", "5@gmail.com", "", "Que eu mais queria");
        $aluno6_id  = $this->student("Raquel", "Williams", "6@gmail.com", "", "P'ra me dar algum conforto e companhia");
        $aluno7_id  = $this->student("João", "Smith", "7@gmail.com", "", "Era só contigo que eu sonhava andar");
        $aluno8_id  = $this->student("Inês", "Pereira", "8@gmail.com", "", "P'ra todo lado e até quem sabe");
        $aluno9_id  = $this->student("Eduardo", "Ye", "9@gmail.com", "", "Talvez casar");
        $aluno10_id = $this->student("Cristina", "White", "10@gmail.com", "", "Ai o que eu passei");
        $aluno11_id = $this->student("Joel", "Figueiredo", "11@gmail.com", "", "Só por te amar");
        $aluno12_id = $this->student("Cecília", "Gomes", "12@gmail.com", "", "A saliva que eu gastei para te mudar");

        $prof1_id = $this->teacher("Jasmim", "Pereira", "13@gmail.com", "", "Mas esse teu mundo era mais forte do que eu", "3.1.19");
        $prof2_id = $this->teacher("Pedro", "Cegueira", "14@gmail.com", "", "E nem com a força da música ele se moveu", "3.2.15");
        $prof3_id = $this->teacher("Carolina", "Sousa", "15@gmail.com", "", "Mesmo sabendo que não gostavas", "A234");
        $prof4_id = $this->teacher("Catarina", "Ricardo", "16@gmail.com", "", "Empenhei o meu anel de rubi", "7.23.4");
        $prof5_id = $this->teacher("Joacine", "Silva", "17@gmail.com", "", "P'ra te levar ao concerto", "3.4.5");
        $prof6_id = $this->teacher("Cristina", "Félix", "18@gmail.com", "", "Que havia no rivolli", "Lisboa, Nº20, 2º Esq.");
        $prof7_id = $this->teacher("Geraldo", "Artur", "19@gmail.com", "", "E era só a ti que eu mais queria", "6.2123");
        $prof8_id = $this->teacher("Rodolfo", "Maia", "20@gmail.com", "", "Ao meu lado no concerto nesse dia", "1.2.3");

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
        $cadeira1_id = $this->cadeira($curso1_id, "TEA84", "Teatro", "Teatro", "Ewwwww", "#ffb3ec");
        $cadeira2_id = $this->cadeira($curso2_id, "ADC23523", "Arquitetura de Computadores", "AC", "Espinafres na sopa", "#e6b3ff");
        $cadeira3_id = $this->cadeira($curso2_id, "RED0923", "Redes", "Redes", "Blach blah", "#b3b3ff");
        $cadeira4_id = $this->cadeira($curso2_id, "LE34", "Línguas Estrangeiras", "LingE", "Nope", "#99ebff");
        $cadeira5_id = $this->cadeira($curso2_id, "HO182", "História do Oriente", "HO", "Podem escrever mais aqui.", "#80ffdf");
        $cadeira6_id = $this->cadeira($curso1_id, "SI2387", "Sistemas Interativos", "SI", "Kekerino", "#80ff80");
        $cadeira7_id = $this->cadeira($curso1_id, "TI298", "Teoria de Imagem", "TI", "Não tem descriçao", "#d5ff80");
        $cadeira8_id = $this->cadeira($curso1_id, "EDM24653", "Elementos de Matemática", "EM", "Adoro Gelatina", "#ffff80");
        $cadeira9_id = $this->cadeira($curso1_id, "CIN234", "Cinematografia", "Cinema", "Crocodildo", "#ffd480");

        ///////////////////////////////
        //          AULAS
        ///////////////////////////////
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira1_id, "type"=>"PL", "start_time"=>"10:30", "end_time"=>"12:00",
            "day_week"=>4, "classroom"=>"1.3.35")); $aula1_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira1_id, "type"=>"T", "start_time"=>"10:00", "end_time"=>"12:00",
            "day_week"=>2, "classroom"=>"1.3.40")); $aula2_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira1_id, "type"=>"TP", "start_time"=>"15:30", "end_time"=>"17:00",
            "day_week"=>1, "classroom"=>"1.3.35")); $aula3_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira2_id, "type"=>"PL", "start_time"=>"16:30", "end_time"=>"18:00",
            "day_week"=>5, "classroom"=>"3.1.35")); $aula4_id = $this->db->insert_id();
        $this->db->insert("aula", Array("cadeira_id"=>$cadeira2_id, "type"=>"T", "start_time"=>"08:00", "end_time"=>"9:30",
            "day_week"=>2, "classroom"=>"6.3.10")); $aula5_id = $this->db->insert_id();

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
        //          FORUNS
        ///////////////////////////////
        $this->db->insert("forum", Array("cadeira_id"=> $cadeira1_id, "name"=>"Evolução da Ciência",
            "description"=>"Texto que descreve este projeto científico.",
            "teachers_only"=>1)); $forum1_id = $this->db->insert_id();

        ///////////////////////////////
        //          THREADS DOS FORUNS
        ///////////////////////////////
        $this->db->insert("thread", Array("user_id"=> $prof1_id, "forum_id"=> $forum1_id,
            "title"=>"Avaliação da cadeira",
            "content"=>"Testes e 3 projetos ao longo do semestre", "date" =>"2020-04-13 11:00:00")); 
            $thread1_id = $this->db->insert_id();

        ///////////////////////////////
        //          POSTS NAS THREADS
        ///////////////////////////////
        $this->db->insert("thread_post", Array("thread_id"=> $thread1_id, "user_id"=> $prof1_id,
            "content"=>"Avaliação da cadeira", "date" =>"2020-04-13 11:00:00")); 
            $post1_id = $this->db->insert_id();
        
        ///////////////////////////////
        //          PROJETOS
        ///////////////////////////////
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira1_id, "nome"=>"Evolução da Ciência",
            "description"=>"Texto que descreve este projeto científico.",
            "min_elementos"=>1, "max_elementos"=>2, "enunciado_url"=>"")); $projeto1_id = $this->db->insert_id();
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira1_id, "nome"=>"História das Artes",
            "description"=>"Ninguém quer saber quando escolhe artes, mas pronto",
            "min_elementos"=>3, "max_elementos"=>4, "enunciado_url"=>"")); $projeto2_id = $this->db->insert_id();
        $this->db->insert("projeto", Array("cadeira_id"=> $cadeira2_id, "nome"=>"Inteligência Artificial",
            "description"=>"Quando não percebes o código que escreveste...",
            "min_elementos"=>2, "max_elementos"=>6, "enunciado_url"=>""));
        ///////////////////////////////
        //          ETAPAS
        ///////////////////////////////
        $this->db->insert("etapa", Array("projeto_id"=> $projeto1_id, "deadline"=>"2020-05-01 11:11:00", "enunciado_url"=>"",
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
            Array("user_id"=> $aluno4_id,  "grupo_id"=>$grupo2_id),
            Array("user_id"=> $aluno2_id,  "grupo_id"=>$grupo1_id),
            Array("user_id"=> $aluno3_id,  "grupo_id"=>$grupo1_id),
            Array("user_id"=> $aluno2_id,  "grupo_id"=>$grupo2_id),
            Array("user_id"=> $aluno3_id,  "grupo_id"=>$grupo3_id),
            Array("user_id"=> $aluno1_id,  "grupo_id"=>$grupo4_id),
            Array("user_id"=> $aluno5_id,  "grupo_id"=>$grupo3_id),
            Array("user_id"=> $aluno3_id,  "grupo_id"=>$grupo4_id),
        ));
        ///////////////////////////////
        //          SUBMISSÃO_ETAPA
        ///////////////////////////////
        $this->db->insert("etapa_submit", Array("grupo_id"=>$grupo3_id, "etapa_id"=>$etapa1_id, "submit_url"=>"URL-FALSO-HEHE-XD"));
        ///////////////////////////////
        //          EVENTOS
        ///////////////////////////////
        $this->db->where_in('name', Array("Reunião de Grupo", "Horário de dúvidas", 
            "Decidir Framework")); $this->db->delete('evento');
        $this->db->insert("evento", Array("start_date"=>"2020-05-05 11:00:00", "end_date"=>"2020-05-05 12:30:00", "name"=>"Reunião de Grupo",
            "description"=>"Discutir o modelo da base de dados.", "location"=>"FCUL")); $evento1_id = $this->db->insert_id();
        $this->db->insert("evento", Array("start_date"=>"2020-05-04 12:10:00", "end_date"=>"2020-05-04 14:30:00", "name"=>"Horário de dúvidas",
            "description"=>"Horário de dúvidas com o(a) professor(a) José Cecílio", "location"=>"6.3.45")); $evento2_id = $this->db->insert_id(); 
        $this->db->insert("evento", Array("start_date"=>"2020-05-27 11:00:00", "end_date"=>"2020-05-27 12:30:00", "name"=>"Decidir Framework",
            "description"=>"Esta descrição descreve o evento.", "location"=>"Azenhas")); $evento3_id = $this->db->insert_id();
        $this->db->insert("evento", Array("start_date"=>"2020-05-07 12:10:00", "end_date"=>"2020-05-07 14:30:00", "name"=>"Horário de dúvidas",
            "description"=>"Horário de dúvidas com o(a) professor(a) José Cecílio", "location"=>"6.3.45")); $evento4_id = $this->db->insert_id(); 
        ///////////////////////////////
        //          REUNIÔES DE GRUPO
        ///////////////////////////////
        $this->db->insert_batch('evento_grupo', Array(
            Array("evento_id"=> $evento1_id,  "grupo_id"=>$grupo1_id),
            Array("evento_id"=> $evento3_id,  "grupo_id"=>$grupo1_id),
        ));
        ///////////////////////////////
        //          USER VAI A UM EVENTO
        ///////////////////////////////
        $this->db->insert_batch('evento_user', Array(
            Array("evento_id"=> $evento1_id,  "user_id"=>$aluno1_id),
            Array("evento_id"=> $evento2_id,  "user_id"=>$aluno1_id),
            Array("evento_id"=> $evento3_id,  "user_id"=>$aluno1_id),
            Array("evento_id"=> $evento4_id,  "user_id"=>$aluno1_id),
        ));
        ///////////////////////////////
        //          USER VAI A UM EVENTO
        ///////////////////////////////
        $this->notification($aluno1_id, "message", "Mensagem de João Ye", "Atão crlh?", "/", false, "2020-04-23 11:30:31");
        $this->notification($aluno1_id, "alert", "Tens uma trabalho para entregar", "Arquitetura de Computadores", "/", false, "2020-04-23 11:30:35");
        $this->notification($aluno1_id, "alert", "Falhaste uma entrega", "Teatro", "/", false, "2020-04-23 11:30:30");
        $this->notification($aluno1_id, "message", "Mensagem de Raul Koch", "Esta está seen, não deve aparecer", "/", true, "2020-04-23 11:30:33");
            

        

        $execution_time = microtime(true) - $time_start;

        echo "<h2>Tempo de processamento: ".$execution_time."s </h2>";
        echo "<p><b>Aluno principal</b><br>1@gmail.com</p>";
        echo "<p><b>Prof principal</b><br>13@gmail.com</p>";
        echo "<p><b>Cadeira principal</b><br>Teatro</p>";
        echo "<p><b>Projeto principal</b><br>Evolução da Ciência</p>";
        echo "<p><b>Forum principal</b><br>Evolução da Ciência</p>";
        echo "<p><b>Thread principal</b><br>Avaliação da Cadeira</p>";
    }



    private function student($name, $surname, $email, $password, $description) {
        $this->db->delete("user", ['email' => $email]);
        $this->db->insert("user", Array("name"=>$name, "surname"=>$surname, "email"=>$email, "role"=>"student", "password"=>md5($password), "description"=>$description));
        return $this->db->insert_id();
    }

    private function teacher($name, $surname, $email, $password, $description, $gabinete) {
        $this->db->delete("user", ['email' => $email]);
        $this->db->insert("user", Array("name"=>$name, "surname"=>$surname, "email"=>$email, "role"=>"teacher", "password"=>md5($password), "description"=>$description, "gabinete"=>$gabinete));
        return $this->db->insert_id();
    }

    private function notification($user_id, $type, $title, $content, $link, $seen, $date) {
        $this->db->delete("notification", ['title' => $title]);
        $this->db->insert("notification", Array("user_id"=>$user_id, "type"=>$type, "title"=>$title, "content"=>$content, "link"=>$link, "seen"=>$seen, "date"=>$date,));
        return $this->db->insert_id();
    }

    private function cadeira($curso_id, $code, $name, $sigla, $description, $color) {
        $this->db->delete("cadeira", ['code' => $code]);
        $this->db->insert("cadeira", Array("curso_id"=> $curso_id, "code"=>$code, "name"=>$name, "sigla"=>$sigla, "description"=>$description, "color"=>$color));
        return $this->db->insert_id();
    }
}