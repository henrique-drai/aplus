<?php

function small_script($m) {
    $time_start = microtime(true); 

    $aluno1_id  = $m->student("Henrique", "Francisco", "1@gmail.com", "", "This a great description");
    $aluno2_id  = $m->student("Joana", "Almeida", "2@gmail.com", "", "Gosto de entrar em salas do Zoom.");
    $aluno3_id  = $m->student("Rafael", "Sousa", "3@gmail.com", "", "Está calor hoje");
    $aluno4_id  = $m->student("Maria", "Silva", "4@gmail.com", "", "Tu eras aquela");
    $aluno5_id  = $m->student("David", "Peixoto", "5@gmail.com", "", "Que eu mais queria");
    $aluno6_id  = $m->student("Raquel", "Williams", "6@gmail.com", "", "P'ra me dar algum conforto e companhia");
    $aluno7_id  = $m->student("João", "Smith", "7@gmail.com", "", "Era só contigo que eu sonhava andar");
    $aluno8_id  = $m->student("Inês", "Pereira", "8@gmail.com", "", "P'ra todo lado e até quem sabe");
    $aluno9_id  = $m->student("Eduardo", "Ye", "9@gmail.com", "", "Talvez casar");
    $aluno10_id = $m->student("Cristina", "White", "10@gmail.com", "", "Ai o que eu passei");
    $aluno11_id = $m->student("Joel", "Figueiredo", "11@gmail.com", "", "Só por te amar");
    $aluno12_id = $m->student("Cecília", "Gomes", "12@gmail.com", "", "A saliva que eu gastei para te mudar");

    $prof1_id = $m->teacher("Jasmim", "Pereira", "13@gmail.com", "", "Mas esse teu mundo era mais forte do que eu", "3.1.19");
    $prof2_id = $m->teacher("Pedro", "Cegueira", "14@gmail.com", "", "E nem com a força da música ele se moveu", "3.2.15");
    $prof3_id = $m->teacher("Carolina", "Sousa", "15@gmail.com", "", "Mesmo sabendo que não gostavas", "A234");
    $prof4_id = $m->teacher("Catarina", "Ricardo", "16@gmail.com", "", "Empenhei o meu anel de rubi", "7.23.4");
    $prof5_id = $m->teacher("Joacine", "Silva", "17@gmail.com", "", "P'ra te levar ao concerto", "3.4.5");
    $prof6_id = $m->teacher("Cristina", "Félix", "18@gmail.com", "", "Que havia no rivolli", "Lisboa, Nº20, 2º Esq.");
    $prof7_id = $m->teacher("Geraldo", "Artur", "19@gmail.com", "", "E era só a ti que eu mais queria", "6.2123");
    $prof8_id = $m->teacher("Rodolfo", "Maia", "20@gmail.com", "", "Ao meu lado no concerto nesse dia", "1.2.3");

    $faculdade1_id = $m->faculdade("Faculdade de Ciências", "FCUL", "Campo Grande");
    $faculdade2_id = $m->faculdade("Faculdade de Direito", "FDUL", "Campus da UL");
    $faculdade3_id = $m->faculdade("Faculdade de Letras", "FLUL", "Reitoria da UL");
    $faculdade4_id = $m->faculdade("Faculdade de Arquitetura", "FAUL", "Ninguém sabe");
    $faculdade5_id = $m->faculdade("Instituto Superior Técnico", "IST", "Alameda, Lisboa");

    $ano1_id = $m->ano_letivo("2019", "2020");

    $curso1_id = $m->curso($faculdade1_id, $ano1_id, "FS2022", "Física", "Descição positiva");
    $curso2_id = $m->curso($faculdade2_id, $ano1_id, "LTI2022", "Tecnologias", "Descriçao com erros");
    $curso3_id = $m->curso($faculdade1_id, $ano1_id, "MAT2022", "Matemática", "10/10 IGN");

    $cadeira1_id = $m->cadeira($curso1_id, "TEA84", "Teatro", "Teatro", 1, "Ewwwww", "#ffb3ec");
    $cadeira2_id = $m->cadeira($curso2_id, "ADC23523", "Arquitetura de Computadores", "AC", 1, "Espinafres na sopa", "#e6b3ff");
    $cadeira3_id = $m->cadeira($curso2_id, "RED0923", "Redes", "Redes", 0, "Blach blah", "#b3b3ff");
    $cadeira4_id = $m->cadeira($curso2_id, "LE34", "Línguas Estrangeiras", "LingE", 1, "Nope", "#99ebff");
    $cadeira5_id = $m->cadeira($curso2_id, "HO182", "História do Oriente", "HO", 0, "Podem escrever mais aqui.", "#80ffdf");
    $cadeira6_id = $m->cadeira($curso1_id, "SI2387", "Sistemas Interativos", "SI", 1, "Kekerino", "#80ff80");
    $cadeira7_id = $m->cadeira($curso1_id, "TI298", "Teoria de Imagem", "TI", 1, "Não tem descriçao", "#d5ff80");
    $cadeira8_id = $m->cadeira($curso1_id, "EDM24653", "Elementos de Matemática", "EM", 0, "Adoro Gelatina", "#ffff80");
    $cadeira9_id = $m->cadeira($curso1_id, "CIN234", "Cinematografia", "Cinema", 1, "Crocodildo", "#ffd480");

    $aula1_id = $m->aula($cadeira1_id, "PL", "10:30", "12:00", 1, "1.3.24");
    $aula2_id = $m->aula($cadeira1_id, "T", "10:00", "12:00", 2, "6.3.24");
    $aula3_id = $m->aula($cadeira1_id, "TP", "15:30", "17:00", 3, "3.4.52");
    $aula4_id = $m->aula($cadeira2_id, "PL", "16:30", "18:00", 2, "3.2.12");
    $aula5_id = $m->aula($cadeira2_id, "T", "08:00", "9:30", 4, "8.1.12");

    $m->batch("aluno_curso", Array(
      Array("user_id"=> $aluno1_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
      Array("user_id"=> $aluno2_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
      Array("user_id"=> $aluno3_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
      Array("user_id"=> $aluno4_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
      Array("user_id"=> $aluno5_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
      Array("user_id"=> $aluno6_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
    ));
  
    $m->batch("aluno_cadeira", Array(
      Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno2_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno2_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno3_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>True,  "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno3_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno4_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno5_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno6_id, "cadeira_id"=>$cadeira2_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno6_id, "cadeira_id"=>$cadeira3_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno7_id, "cadeira_id"=>$cadeira4_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno8_id, "cadeira_id"=>$cadeira5_id, "is_completed"=>True,  "last_visited"=>date('Y-m-d H:i:s')),
    ));    

    $m->batch("professor_cadeira", Array(
      Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira1_id),
      Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira2_id),
      Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira3_id),
      Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira4_id),
      Array("user_id"=> $prof2_id, "cadeira_id"=>$cadeira1_id),
      Array("user_id"=> $prof2_id, "cadeira_id"=>$cadeira2_id),
    ));

    $m->batch("aluno_aula", Array(
      Array("user_id"=> $aluno1_id, "aula_id"=>$aula5_id),
      Array("user_id"=> $aluno1_id, "aula_id"=>$aula4_id),
      Array("user_id"=> $aluno1_id, "aula_id"=>$aula3_id),
      Array("user_id"=> $aluno1_id, "aula_id"=>$aula2_id),
      Array("user_id"=> $aluno1_id, "aula_id"=>$aula1_id),
      Array("user_id"=> $aluno2_id, "aula_id"=>$aula1_id),
      Array("user_id"=> $aluno2_id, "aula_id"=>$aula2_id)
    ));

    $m->batch("professor_aula", Array(
      Array("user_id"=> $prof1_id, "aula_id"=>$aula5_id),
      Array("user_id"=> $prof1_id, "aula_id"=>$aula4_id),
      Array("user_id"=> $prof1_id, "aula_id"=>$aula3_id),
      Array("user_id"=> $prof1_id, "aula_id"=>$aula2_id),
      Array("user_id"=> $prof1_id, "aula_id"=>$aula1_id)
    ));

    $forum1_id = $m->forum($cadeira1_id, "Fórum de Notícias", "Fórum de notícias, os alunos não podem escrever.", 1);
    $forum2_id = $m->forum($cadeira1_id, "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);


    $thread1_id = $m->thread($prof1_id, $forum1_id, "Avaliação da cadeira", "Testes e 3 projetos ao longo do semestre", "2020-04-13 11:00:00");

    $m->thread_post($thread1_id, $prof1_id, "Avaliação da cadeira", "Testes e 3 projetos ao longo do semestre", "2020-04-13 11:00:00");
    

    $projeto1_id = $m->projeto($cadeira1_id, "Evolução da Ciência", "Texto que descreve este projeto científico.", 1, 2, "");
    $projeto2_id = $m->projeto($cadeira1_id, "História das Artes", "Ninguém quer saber quando escolhe artes, mas pronto", 3, 4, "");
    $projeto3_id = $m->projeto($cadeira2_id, "Inteligência Artificial", "Quando não percebes o código que escreveste...", 2, 6, "");

    $etapa1_id = $m->etapa($projeto1_id, "2020-05-14 23:00:00", "", "Pesquisa", "Façam pesquisa no StackOverflow.");
    $etapa2_id = $m->etapa($projeto1_id, "2020-05-21 23:55:00", "", "Implementação", "Copiem o código do StackOverflow.");

    $grupo1_id = $m->grupo($projeto1_id, "1");
    $grupo2_id = $m->grupo($projeto1_id, "2");
    $grupo3_id = $m->grupo($projeto1_id, "Gang");
    $grupo4_id = $m->grupo($projeto2_id, "3");

    $m->batch("grupo_aluno", Array(
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

    $m->etapa_submit($grupo3_id, $etapa1_id, "URL-FALSO-HEHE-XD");

    $evento1_id = $m->evento("2020-05-14 11:00:00", "2020-05-14 12:30:00", "Reunião de Grupo", "Discutir o modelo da base de dados. 1", "FCUL");
    $evento2_id = $m->evento("2020-05-16 12:10:00", "2020-05-16 14:30:00", "Horário de dúvidas", "Horário de dúvidas com o(a) professor(a) José Cecílio 1", "6.3.45");
    $evento3_id = $m->evento("2020-05-27 11:00:00", "2020-05-27 12:30:00", "Decidir Framework", "Esta descrição descreve o evento. 2", "Azenhas");
    $evento4_id = $m->evento("2020-05-13 12:10:00", "2020-05-13 14:30:00", "Horário de dúvidas", "Horário de dúvidas com o(a) professor(a) José Cecílio 2", "6.3.45");

    $m->batch("evento_grupo", Array(
      Array("evento_id"=> $evento1_id,  "grupo_id"=>$grupo1_id),
      Array("evento_id"=> $evento3_id,  "grupo_id"=>$grupo1_id),
    ));

    $m->batch("evento_user", Array(
      Array("evento_id"=> $evento1_id,  "user_id"=>$aluno1_id),
      Array("evento_id"=> $evento2_id,  "user_id"=>$aluno1_id),
      Array("evento_id"=> $evento3_id,  "user_id"=>$aluno1_id),
      Array("evento_id"=> $evento4_id,  "user_id"=>$aluno1_id),
    ));

    $m->horario_duvidas($cadeira1_id, $prof1_id, "11:30:00", "13:00:00", "Segunda-feira");
    $m->horario_duvidas($cadeira1_id, $prof1_id, "12:00:00", "13:00:00", "Quinta-feira");

    $m->notification($aluno1_id, "message", "Mensagem de João Ye", "Atão crlh?", "app/profile/2801", false, "2020-04-23 11:30:31");
    $m->notification($aluno1_id, "alert", "Tens uma trabalho para entregar", "Arquitetura de Computadores", "app/profile/2", false, "2020-04-23 11:30:35");
    $m->notification($aluno1_id, "alert", "Falhaste uma entrega", "Teatro", "subjects/subject/TEA84/2019", false, "2020-04-23 11:30:30");
    $m->notification($aluno1_id, "message", "Mensagem de Raul Koch", "Esta está seen, não deve aparecer", "app/profile/62", true, "2020-04-23 11:30:33");
        
    $execution_time = microtime(true) - $time_start;

    echo "<h2>Tempo de processamento: ".$execution_time."s </h2>";
    echo "<p><b>Aluno principal</b><br>1@gmail.com</p>";
    echo "<p><b>Prof principal</b><br>13@gmail.com</p>";
    echo "<p><b>Cadeira principal</b><br>Teatro</p>";
    echo "<p><b>Projeto principal</b><br>Evolução da Ciência</p>";
    echo "<p><b>Forum principal</b><br>Evolução da Ciência</p>";
    echo "<p><b>Thread principal</b><br>Avaliação da Cadeira</p>";
}