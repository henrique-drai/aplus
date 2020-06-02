<?php

function smart_script($m) {
    $time_start = time(true);
    
    $years = array(2018, 2019);

    $faculdades_data = array(["Faculdade de Ciências da Universidade de Lisboa", "FCUL", "Campo Grande"], ["Faculdade de Belas-Artes da Universidade de Lisboa", "FBAUL", "Largo da Academia Nacional de Belas Artes"], ["Instituto Superior de Economia e Gestão da Universidade de Lisboa", "ISEG", "Rua do Quelhas 6"]);
    // substituir por função de insert que devolve o primeiro e o último id de um batch;
    //    a ideia é inserir o primeiro item sozinho para ter o primeiro id e depois adicionar o count() para o último ID
    $ids_faculdades = $m->faculdade($faculdades_data);
    
    $students_data = array(["Adriana", "Duarte"], ["Afonso", "José"], ["Catarina", "Leite"], ["Alessia", "Lopes"], ["Alexandre", "Antonio"], ["Alice", "Calretas"], ["Alice", "Martins"], ["Ana", "Beatriz"], ["Ana", "Catarina"], ["Ana", "Filipa"], ["Ana", "Isabel"], ["Ana", "Marisa"], ["Ana", "Marta"], ["Ana", "Rita"], ["Ana", "Rita"], ["Ana", "Sofia"], ["Andreia", "Carina"], ["Andreia", "CarriÇo"], ["André", "Filipe"], ["André", "Filipe"], ["André", "Filipe"], ["André", "Vieira"], ["António", "Afonso"], ["António", "Maria"], ["António", "Maria"], ["António", "Miguel"], ["António", "Pedro"], ["Beatriz", "Alexandra"], ["Beatriz", "Catarino"], ["Beatriz", "Coutinho"], ["Beatriz", "Daniela"], ["Beatriz", "Dinelli"], ["Beatriz", "Duarte"], ["Beatriz", "Lopes"], ["Beatriz", "Parreirinha"], ["Beatriz", "Silva"], ["Bernardo", "LourenÇo"], ["Bruno", "Alexandre"], ["Bruno", "Daniel"], ["Bruno", "Miguel"], ["Bruno", "Miguel"], ["Bruno", "Teixeira"], ["Carolina", "Baptista"], ["Carolina", "Ferreira"], ["Carolina", "Maria"], ["Carolina", "Maria"], ["Carolina", "Nunes"], ["Carolina", "Sofia"], ["Catarina", "Alexandra"], ["Catarina", "GonÇalves"], ["Catarina", "GonÇalves"], ["Catarina", "Lopes"], ["Catarina", "Maria"], ["Catarina", "Salgado"], ["Clara", "Morais"], ["ConstanÇa", "Melo"], ["Cristiana", "Sofia"], ["CÉlia", "Samo"], ["Daniela", "Hanganu"], ["Diana", "Patricia"], ["Diogo", "AntÓnio"], ["Diogo", "Caneco"], ["Diogo", "Catarino"], ["Diogo", "Maria"], ["Diogo", "Miguel"], ["Duarte", "De"], ["Duarte", "Ferreira"], ["Duarte", "Maria"], ["Duarte", "SimÃo"], ["Eduardo", "Pinheiro"], ["Filipa", "Alexandra"], ["Filipe", "Antunes"], ["Francisca", "Maria"], ["Francisco", "Marques"], ["Francisco", "Moura"], ["Francisco", "Stevens"], ["Fábio", "Jorge"], ["Fátima", "Carvalho"], ["GonÇalo", "Da"], ["GonÇalo", "De"], ["GonÇalo", "Manuel"], ["Guilherme", "Herculano"], ["Henrique", "Miguel"], ["Inês", "Alexandra"], ["Inês", "Carvalho"], ["Inês", "Costa"], ["Inês", "Luz"], ["Inês", "Sofia"], ["Joana", "Catarina"], ["Joana", "De"], ["Joana", "Maria"], ["Joana", "Moreira"], ["Joana", "Pereira"], ["Joana", "Pinto"], ["Joana", "Raquel"], ["Joana", "Torres"], ["Jonathan", "Fingolo"], ["JosÉ", "Do"], ["JosÉ", "Maria"], ["JoÃo", "AntÓnio"], ["JoÃo", "Carlos"], ["JoÃo", "Filipe"], ["JoÃo", "GonÇalo"], ["JoÃo", "JosÉ"], ["JoÃo", "Miguel"], ["JoÃo", "Miguel"], ["JoÃo", "Pedro"], ["JoÃo", "Pedro"], ["JoÃo", "Pedro"], ["JoÃo", "Tiago"], ["JoÃo", "Martins"], ["Jéssica", "Alves"], ["Karolina", "Mazurek"], ["Kennedy", "Samuel"], ["Lara", "Isabel"], ["Leonor", "Inês"], ["Lucas", "Bronger"], ["Luis", "Ricciardi"], ["Luis", "Eduardo"], ["Luis", "Miguel"], ["Luis", "Tiago"], ["Madalena", "Sousa"], ["Manuel", "Neves"], ["Manuel", "Ulrich"], ["Margarida", "Comprido"], ["Margarida", "Do"], ["Margarida", "Duarte"], ["Margarida", "Olaio"], ["Margarida", "Ramos"], ["Margarida", "Rodrigues"], ["Maria", "Ana"], ["Maria", "Carolina"], ["Maria", "Catarina"], ["Maria", "Francisca"], ["Maria", "Inês"], ["Maria", "Leonor"], ["Maria", "Leonor"], ["Maria", "Rodrigues"], ["Maria", "Teresa"], ["Mariana", "CÂmara"], ["Mariana", "De"], ["Mariana", "Ferreira"], ["Mariana", "Inês"], ["Mariana", "Matias"], ["Mariana", "Neves"], ["Mariana", "Zurrapa"], ["Marta", "Almeida"], ["Marta", "Da"], ["Marta", "Meira"], ["Marta", "Ponciano"], ["Marta", "Soares"], ["Marta", "Sofia"], ["Marta", "Sofia"], ["Martim", "Da"], ["Martim", "EstêvÃo"], ["Mathias", "Alex"], ["Matilde", "Maria"], ["Miguel", "Afonso"], ["Miguel", "Alexandre"], ["Miguel", "Alexandre"], ["Miguel", "Laranjeira"], ["Miguel", "Tomás"], ["Márcia", "Filipa"], ["Márcia", "Henriques"], ["MÓnica", "Beatriz"], ["Nadine", "Figueiredo"], ["Nautaran", "Nancassa"], ["Nuno", "Barata"], ["Nuno", "Ricardo"], ["Olivia", "Maria"], ["Otavio", "Augusto"], ["Patricia", "Filipa"], ["Pedro", "Da"], ["Pedro", "Miguel"], ["Pedro", "Rendo"], ["Phillip", "Kemp"], ["Rafael", "Banza"], ["Raquel", "Filipa"], ["Raquel", "PerdigÃo"], ["Raquel", "Rebelo"], ["RaÚl", "Julian"], ["Ricardo", "Martins"], ["Rita", "Alexandra"], ["Rita", "Isabel"], ["Rita", "Policarpo"], ["Rodrigo", "Afonso"], ["Rodrigo", "AragÜés"], ["Rodrigo", "QueirÓs"], ["Sara", "Isabel"], ["SebastiÃo", "De"], ["Shania", "Tierra"], ["Sofia", "Ribeiro"], ["Stefany", "Mariany"], ["Sérgio", "Miguel"], ["SÓnia", "Da"], ["Teresa", "Bernardino"], ["Teresa", "Maria"], ["Tiago", "Ferreira"], ["Tiago", "Filipe"], ["Tomas", "Maria"], ["Tomás", "BraganÇa"], ["Tomás", "Da"], ["Tomás", "Dos"], ["Tomás", "Jardim"], ["Tomás", "Ventura"], ["Vasco", "Filipe"], ["Vasco", "Maria"], ["Vasco", "Santos"], ["Vasco", "Sousa"], ["Vera", "Alexandra"], ["Yiqing", "Zhu"], ["Ângela", "Do"], ["Érica", "Beatriz"],);
    $ids_students = $m->faculdade($students_data);

    $teachers_data = array(["Manuel", "Francisco"], ["José", "Andrade"], ["João", "Sousa"], ["Amélia", "Silva"], ["Cristina", "Soares"], ["Ana", "Pereira"], ["Maria", "José"], ["André", "João"], ["Rodolfo", "Martins"], ["Martim", "Mais"], ["Marilia", "Santana"], ["Cecilia", "Brás"], ["Joana", "Gomes"], ["Miguel", "Gomes"],);
    $ids_teachers = $m->faculdade($teachers_data);

    $cursos_data = array([ "9011", "Biologia", "A Biologia visa a aprendizagem dos conceitos fundamentais inerentes aos sistemas vivos"], [ "9015", "Bioquímica", "A Licenciatura em Bioquímica confere o título de bioquímico e tem como objetivos principais: - Formar profissionais com uma sólida formação científica em Ciências da Vida"], [ "L096", "Engenharia Geoespacial", "A área da Engenharia Geoespacial apresenta uma visão moderna e atualizada da área da Informação Geográfica e Cartográfica"], [ "9119", "Engenharia Informática", "A Licenciatura em Engenharia Informática (LEI) corresponde aos enormes desafios de imaginação"], [ "9381", "Estatística Aplicada", "A Licenciatura em Estatística Aplicada"], [ "9458", "Estudos Gerais", "A Licenciatura em Estudos Gerais tem uma característica que a diferencia de todas as outras em Portugal: permite uma combinação única entre as artes"], [ "9141", "Física", "A Licenciatura em Física oferece uma formação sólida e abrangente em física fundamental e aplicada. O curso está estruturado em duas fases"], [ "9146", "Geologia", "A Licenciatura em Geologia tem como objetivo principal o desenvolvimento das competências necessárias ao desempenho qualificado e versátil da profissão de geólogo em diferentes domínios de atividade"], [ "9209", "Matemática", "A Licenciatura em Matemática visa a aquisição de conhecimentos básicos nos vários ramos da matemática (incluindo Análise"], [ "9385", "Matemática Aplicada", "A Licenciatura em Matemática Aplicada tem como objetivo oferecer formação nas áreas da Matemática com maior aplicação e nível de empregabilidade no nosso país"], [ "9212", "Meteorologia, Oceanografia e Geofísica"], [ "9223", "Química", "O objetivo principal da Licenciatura em Química reside no desenvolvimento das competências necessárias ao desempenho qualificado e versátil da profissão de Químico em diferentes domínios de atividade"], [ "9226", "Química Tecnológica", "A Licenciatura em Química Tecnológica pretende formar quadros com bases científicas e capacidade tecnológica para desempenharem atividade profissional na indústria química e associadas"], [ "L079", "Tecnologias de Informação", "A Licenciatura em Tecnologias de Informação (LTI) pretende responder aos novos e diversificados desafios que resultam da constante expansão da área científica da Informática. Neste contexto"], [ "9845", "Engenharia Biomédica e Biofísica", "O Mestrado Integrado em Engenharia Biomédica e Biofísica privilegia"], [ "9811", "Engenharia da Energia e do Ambiente", "O desafio da transição para um sistema sustentável de energia exige competências transdisciplinares que os tradicionais cursos de engenharia não podem oferecer. O Mestrado Integrado em Engenharia da Energia e do Ambiente pretende colmatar essas necessidades"], [ "9368", "Engenharia Física", "O Mestrado Integrado em Engenharia Física visa a formação de profissionais com sólida formação científica e técnica em diferentes áreas do domínio da engenharia e tecnologias físicas. A perspetiva de formação é a de inserir o estudante e futuro profissional nas problemáticas associadas aos fenómenos físicos que estão na base da inovação tecnológica"], [ "5251", "Arte Multimédia", "Licenciatura em Arte Multimédia constitui a resposta à necessidade contemporânea de uma formação universitária capaz de integrar"], [ "5252", "Ciências da Arte e do Património", "Esta licenciatura/1º ciclo de estudos em Ciências da Arte e do Património visa proporcionar formação geral em três domínios"],);
    $ids_cursos = range(0, count($cursos_data) - 1);

    $cadeiras_data = array([ "66506", "Biologia Animal I", "BAni-I", 1], [ "67589", "Biologia Celular", "BCelu", 1], [ "66522", "História das Ideias em Biologia", "HIB", 1], [ "66524", "Introdução ao Tratamento de Dados", "ITD", 1], [ "13504", "Matemática para Biólogos", "MBiolo", 1], [ "16489", "Química (Biologia)", "Q-Biologia", 1], [ "66506", "Biologia Animal II", "BAni-II", 2], [ "62809", "Biologia Vegetal", "BVege", 2], [ "44337", "Bioquímica", "Bioqu", 2], [ "46897", "Física para Biólogos", "FBiol", 2], [ "46896", "Genética", "Gene", 2], [ "22738", "Biestatística", "Bioes", 1], [ "66510", "Biogeografia", "Bioge", 1], [ "67589", "Fisiologia Animal", "FAni", 1], [ "49763", "Fundamentos de Biologia Molecular", "FBM", 1], [ "64987", "Geologia Geral", "GGera", 1], [ "63489", "Processamento de Dados", "PD", 1], [ "62831", "Bioética", "Bioeti", 2], [ "66504", "Biologia Ambiental e Conservação", "BACons", 2], [ "63471", "Biologia Microbiana", "BMicro", 2], [ "62818", "Ecologia", "Ecolo", 2], [ "66520", "Evolução", "Evo", 2], [ "67369", "Fisiologia Vegetal", "FVege", 2], [ "13542", "Álgebra Linear", "AL", 1], [ "62801", "Biologia Celular (Bioquímica)", "BC-Bioquimica", 1], [ "34852", "Cálculo Infinitesimal I", "CI-I", 1], [ "17896", "Fundamentos de Química", "FQuim", 1], [ "32874", "Informática na Ótica do Utilizador", "IOU", 1], [ "44305", "Bioquímica I", "Bioq-I", 2], [ "36523", "Cálculo Infinitesimal II", "CI-II", 2], [ "27564", "Física Geral", "FG", 2], [ "16789", "Perspetivas em Investigação e Desenvolvimento", "PID", 2], [ "45852", "Química Orgânica", "QO", 2], [ "22754", "Análise de Dados em Química e Bioquímica", "ADQB", 1], [ "44308", "Bioquímica Analítica", "BAna", 1], [ "44309", "Bioquímica Experimental I", "BE-I", 1], [ "44307", "Bioquímica II", "Bioq-II", 1], [ "55784", "Química-Física I", "QF-I", 1], [ "44308", "Biquímica Computacional", "BCump", 2], [ "44313", "Bioquímica Experimental II", "BE-II", 2], [ "46778", "Bioquímica Inorgânica", "BIno", 2], [ "34672", "Microbiologia", "Microb", 2], [ "44311", "Processos de Oxidação-Redução em Bioquímica", "PORB", 2], [ "31167", "Álgebra Linear e Geometria Analítica A", "ALGA-A", 1], [ "64824", "Cálculo I", "Calc-I", 1], [ "45518", "Ciências da Informação Geoespacial", "CIGeo", 1], [ "44712", "Introdução à Investigação Operacional", "IIO", 1], [ "62249", "Programação I", "Prog-I", 1], [ "64892", "Cálculo II", "Calc-II", 2], [ "34615", "Introdução às Probabilidades e Estatística", "IPE", 2], [ "64786", "Introdução às Tecnologias Web", "ITW", 2], [ "61447", "Mecânica e Ondas", "MOnd", 2], [ "64987", "Programação II", "Prog-II", 1], [ "24578", "Ajustamento de Observações", "AObs", 1], [ "63487", "Bases de Dados", "BD", 1], [ "71744", "Desenho Técnico Assistido por Computador", "DTAC", 1], [ "84678", "Instrumentação e Metrologia", "IMetro", 1], [ "64781", "Sistemas de Informação Geográfica", "SIGeo", 1], [ "73458", "Cartografia", "Cart", 2], [ "74211", "Ordenamento do Território e Urbanismo", "OTUrb", 2], [ "71746", "Posicionamento Geospacial I", "PGeo-I", 2], [ "71748", "Sistemas de Referência Espaciais", "SREsp", 2], [ "86458", "Cadastro Predial", "CPre", 1], [ "71744", "Deteção Remota e Processamento de Imagem", "DRPImag", 1], [ "71741", "Geodesia Física", "GFis", 1], [ "71746", "Posicionamento Geoespacial II", "PGeo-II", 1], [ "76454", "Economia e Gestão", "EGes", 2], [ "71738", "Hidrografia", "Hidro", 2], [ "71753", "Métodos Óticos de Modelação 3D", "MOM3D", 2], [ "71764", "Projeto de Engenharia Geoespacial", "PEGeo", 2], [ "26748", "Arquitetura de Sistemas Computacionais", "ASC", 1], [ "13538", "Cálculo", "Calc", 1], [ "26722", "Introdução à Programação", "IP", 1], [ "13539", "Lógica de Primeira Ordem", "LPO", 1], [ "26759", "Produção de Documentos Técnicos", "PDT", 1], [ "26723", "Algoritmos e Estruturas de Dados", "AED", 2], [ "13540", "Elementos de Álgebra Linear", "EAL", 2], [ "34706", "Física A", "Fis-A", 2], [ "34615", "Introdução às Probabilidades e Estatística", "IPE", 2], [ "26724", "Laboratórios de Programação", "LP", 2], [ "34707", "Física Experimental", "FExp", 1], [ "44712", "Introdução à Investigação Operacional", "IIO", 1], [ "26725", "Princípios de Programação", "PP", 1], [ "26704", "Redes de Computadores", "RComp", 1], [ "26726", "Sistemas de Informação e Bases de Dados", "SIBD", 1], [ "63485", "Desenvolvimento Centrado em Objetos", "DCO", 2], [ "26749", "Interfaces Pessoa-Máquina", "IP-M", 2], [ "13528", "Matemática Discreta", "MDisc", 2], [ "17645", "Pensamento Crítico", "PCrit", 2], [ "26703", "Sistemas Operativos", "SO", 2], [ "26736", "Análise e Design de Sistemas de Informação", "ADSI", 1], [ "26733", "Computação Gráfica", "CGraf", 1], [ "26732", "Introdução à Inteligência Artificial", "IIA", 1], [ "26730", "Sistemas Distribuídos", "SDist", 1], [ "26737", "Teoria da Computação", "TC", 1], [ "26750", "Construção de Sistemas de Software", "CSS", 2], [ "26734", "Engenharia do Conhecimento", "EC", 2], [ "26731", "Projeto de Sistemas de Informação", "PSI", 2], [ "26749", "Segurança e Confiabilidade", "SConf", 2], [ "50123", "Artes Digitais", "ArDi", 1], [ "50124", "Computação Multimedia", "CM", 1], [ "50125", "Experiencia da Interação", "ExpInt", 1], [ "50126", "Fotografia Experimental", "FExp", 1], [ "50127", "Praticas do Som", "PS", 1], [ "50128", "Projeto Design", "PD", 1], [ "50129", "Teoria da Imagem I", "TI-I", 1], [ "50130", "Animação Digital", "AD", 1], [ "50131", "Animação e Movimento", "AM", 1], [ "50132", "Cultura Visual", "CV", 1], [ "50123", "Estudos dos Media", "EM", 2], [ "50124", "Fotografia", "Fot", 2], [ "50125", "Imagem em Movimento", "IM", 2], [ "50126", "Metodologia Projetual Multimedia", "MPM", 2], [ "50127", "Teoria da Imagem II", "TI-II", 2], [ "50128", "Desenho de Património", "DP", 2], [ "50129", "Animação e Narrativa", "AN", 2], [ "50130", "Audiovisuais", "AV", 2], [ "50131", "Sistemas Interativos", "SI", 2], [ "50132", "Performance", "P", 2], [ "50123", "Historia da Arte I", "HA-I", 1], [ "50124", "Historia e Teoria da Museologia", "HTM", 1], [ "50125", "Teorias da Arte", "TA", 1], [ "50126", "Desenho I", "Des-I", 1], [ "50127", "Geometria I", "Geo-I", 1], [ "50128", "Estética I", "Est-I", 1], [ "50129", "Museologia e Curadoria", "MC", 1], [ "50130", "Design Museográfico", "DM", 1], [ "50131", "Historia e Teoria do Restauro", "HTR", 1], [ "50132", "Teoria da Escultura Portuguesa", "TEP", 1], [ "50123", "Historia da Arte II", "HA-II", 2], [ "50124", "Artes e Humanidades", "AH", 2], [ "50125", "Museologia e Conservação", "MC", 2], [ "50126", "Desenho de Patrimonio", "DP", 2], [ "50127", "Materiais, Técnicas e Diagnóstico", "MTD"], [ "50128", "Historia da Arte Portuguesa", "HAT", 2], [ "50129", "Desenho I", "Des-II", 2], [ "50130", "Geometria I", "Geo-II", 2], [ "50131", "Estética I", "Est-II", 2], [ "50132", "Patrimonio e Arqueologia", "PA", 2],);
    $ids_cadeiras = range(0, count($cadeiras_data) - 1);




    $data = array();

    $ctr_faculdades = 0;
    $ctr_cursos = 0;

    $n_faculdades = count($ids_faculdades);
    $n_cursos = count($ids_cursos);
    $n_cadeiras = count($ids_cadeiras);

    $n_cursos_per_faculdade = intdiv($n_cursos, $n_faculdades); // pode-se aumentar, se for preciso, curr=6

    $n_cadeiras_per_cursos = intdiv($n_cadeiras, $n_cursos); // pode-se aumentar, se for preciso, curr=7

    $faculdades = array();

    foreach ($ids_faculdades as $id_faculdade) {       

      $cursos_da_faculdade = array_slice($ids_cursos, $ctr_faculdades * $n_cursos_per_faculdade, $n_cursos_per_faculdade); 
      
      $cursos_da_faculdade_e_cadeiras = array();

      foreach ($cursos_da_faculdade as $curso){

        $cadeiras_do_curso = array_slice($ids_cadeiras, $ctr_cursos * $n_cadeiras_per_cursos, $n_cadeiras_per_cursos); 

        array_push($cursos_da_faculdade_e_cadeiras, array(
          "cadeiras" => $cadeiras_do_curso,
        ));

        $ctr_cursos+=1;
      }
      
      $ctr_faculdades+=1;
      array_push($faculdades, array($id_faculdade => array(
        "cursos" => $cursos_da_faculdade_e_cadeiras,
        "alunos" => array(),
      )));
    }

    array_push($data, array(
      "faculdades" => $faculdades,
    ));

    echo json_encode($data, JSON_PRETTY_PRINT);
    //print("<pre>".print_r($data,true)."</pre>");
    




    // $temp_array = explode( 'cadeira(', $temp );

    // foreach ($temp_array as $key => $value) {
    //   $kek = explode( ',', $value );
    //   if (isset($kek[2])) {
    //     $code = $kek[1];
    //     $nome = $kek[2];
    //     $desc = $kek[3];
    //     $ewew = $kek[4];
    //     echo "[".$code.", ".$nome.", ".$desc.", ".$ewew."], ";
    //   }
      
    // }


    // $aula = array();
    // $aula["1"] = $m->aula($cadeira["1"], "PL", "10:30", "12:00", 1, "1.3.24");
    // $aula["2"] = $m->aula($cadeira["1"], "T", "10:00", "12:00", 2, "6.3.24");
    // $aula["3"] = $m->aula($cadeira["1"], "TP", "15:30", "17:00", 3, "3.4.52");
    // $aula["4"] = $m->aula($cadeira["2"], "PL", "16:30", "18:00", 2, "3.2.12");
    // $aula["5"] = $m->aula($cadeira["2"], "T", "08:00", "9:30", 4, "8.1.12");
    // $aula["6"] = $m->aula($cadeira["3"], "PL", "12:00", "13:00", 1, "1.3.27");
    // $aula["7"] = $m->aula($cadeira["3"], "T", "09:00", "12:00", 2, "6.4.24");
    // $aula["8"] = $m->aula($cadeira["4"], "TP", "17:30", "19:00", 3, "2.4.53");
    // $aula["9"] = $m->aula($cadeira["4"], "PL", "17:30", "19:00", 2, "3.4.12");
    // $aula["10"] = $m->aula($cadeira["4"], "T", "09:00", "11:30", 4, "8.1.14");
    // $aula["11"] = $m->aula($cadeira["5"], "PL", "13:30", "16:00", 1, "1.3.24");
    // $aula["12"] = $m->aula($cadeira["5"], "T", "08:00", "09:00", 2, "6.3.44");
    // $aula["13"] = $m->aula($cadeira["5"], "TP", "14:30", "16:00", 3, "3.2.52");
    // $aula["14"] = $m->aula($cadeira["6"], "PL", "14:30", "18:00", 2, "1.2.28");
    // $aula["15"] = $m->aula($cadeira["6"], "T", "08:00", "9:30", 4, "3.1.07");
    // $aula["16"] = $m->aula($cadeira["7"], "PL", "09:30", "12:00", 1, "1.4.24");
    // $aula["17"] = $m->aula($cadeira["8"], "T", "15:00", "17:00", 2, "4.5.24");
    // $aula["18"] = $m->aula($cadeira["9"], "TP", "15:30", "19:00", 3, "3.1.34");
    // $aula["19"] = $m->aula($cadeira["10"], "PL", "15:30", "17:00", 2, "3.2.27");
    // $aula["20"] = $m->aula($cadeira["11"], "T", "09:00", "11:30", 4, "4.1.21");


    // $m->batch("aluno_curso", Array(
    //   Array("user_id"=> $aluno["199"], "curso_id"=>$curso["1"], "data_entrada"=>"2019"),
    //   Array("user_id"=> $aluno["198"], "curso_id"=>$curso["1"], "data_entrada"=>"2019"),
    //   Array("user_id"=> $aluno["213"], "curso_id"=>$curso["1"], "data_entrada"=>"2018"),
    //   Array("user_id"=> $aluno["214"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
    //   Array("user_id"=> $aluno["194"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
    //   Array("user_id"=> $aluno["183"], "curso_id"=>$curso["2"], "data_entrada"=>"2020"),
    // ));
  
    // $m->batch("aluno_cadeira", Array(
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    //   Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    // ));    

    // $m->batch("professor_cadeira", Array(
    //   Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["1"]),
    //   Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["2"]),
    //   Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["3"]),
    //   Array("user_id"=> $prof["11"], "cadeira_id"=>$cadeira["3"]),
    //   Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["4"]),
    //   Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["5"]),
    //   Array("user_id"=> $prof["5"], "cadeira_id"=>$cadeira["6"]),
    //   Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["6"]),
    //   Array("user_id"=> $prof["4"], "cadeira_id"=>$cadeira["7"]),
    //   Array("user_id"=> $prof["6"], "cadeira_id"=>$cadeira["8"]),
    // ));

    // $m->batch("aluno_aula", Array(
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["97"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["98"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["99"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["100"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["101"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["102"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["103"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["125"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["126"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["127"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["128"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["129"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["130"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["131"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["132"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["133"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["134"]),
    //   Array("user_id"=> $aluno["81"], "aula_id"=>$aula["135"]),
    //   //ATE AO 86

    // ));

    // $m->batch("professor_aula", Array(
    //   Array("user_id"=> $prof["7"], "aula_id"=>$aula["61"]),
    //   Array("user_id"=> $prof["4"], "aula_id"=>$aula["62"]),
    //   Array("user_id"=> $prof["12"], "aula_id"=>$aula["63"]),
    //   Array("user_id"=> $prof["10"], "aula_id"=>$aula["64"]),
    //   Array("user_id"=> $prof["2"], "aula_id"=>$aula["65"]),
    //   Array("user_id"=> $prof["13"], "aula_id"=>$aula["66"]),
    //   Array("user_id"=> $prof["8"], "aula_id"=>$aula["67"]),
    //   Array("user_id"=> $prof["11"], "aula_id"=>$aula["68"]),
    //   Array("user_id"=> $prof["7"], "aula_id"=>$aula["69"]),
    //   Array("user_id"=> $prof["4"], "aula_id"=>$aula["70"]),
    //   Array("user_id"=> $prof["12"], "aula_id"=>$aula["71"]),
    //   Array("user_id"=> $prof["10"], "aula_id"=>$aula["72"]),
    //   Array("user_id"=> $prof["2"], "aula_id"=>$aula["73"]),
    //   Array("user_id"=> $prof["13"], "aula_id"=>$aula["74"]),
    //   Array("user_id"=> $prof["8"], "aula_id"=>$aula["75"]),
    //   Array("user_id"=> $prof["11"], "aula_id"=>$aula["76"]),
    //   Array("user_id"=> $prof["7"], "aula_id"=>$aula["77"]),
    //   Array("user_id"=> $prof["4"], "aula_id"=>$aula["78"]),
    //   Array("user_id"=> $prof["12"], "aula_id"=>$aula["79"]),
    //   Array("user_id"=> $prof["10"], "aula_id"=>$aula["80"]),
    
    // ));

    // $forum = array();
    // $forum["1"] = $m->forum($cadeira["1"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    // $forum["2"] = $m->forum($cadeira["2"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);
    // $forum["3"] = $m->forum($cadeira["34"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    // $forum["4"] = $m->forum($cadeira["35"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);
    // $forum["5"] = $m->forum($cadeira["63"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    // $forum["6"] = $m->forum($cadeira["64"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);
    // $forum["7"] = $m->forum($cadeira["83"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    // $forum["8"] = $m->forum($cadeira["83"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);


    // $thread = array();
    // $thread["1"] = $m->thread($prof["1"], $forum["1"], "Avaliação da cadeira", "Testes e 3 projetos ao longo do semestre", "2020-05-13 11:00:00");
    // $thread["2"] = $m->thread($prof["1"], $forum["3"], "Avaliação da cadeira", "Testes ao longo do semestre", "2020-04-13 11:00:00");
    // $thread["3"] = $m->thread($prof["7"], $forum["5"], "Avaliação da cadeira", "3 projetos ao longo do semestre", "2020-05-13 11:00:00");
    // $thread["4"] = $m->thread($prof["7"], $forum["7"], "Avaliação da cadeira", "Exame final e 5 projetos ao longo do semestre", "2020-04-13 11:00:00");
    // $thread["5"] = $m->thread($prof["7"], $forum["8"], "Dúvidas", "Dúvidas expostas pelos alunos", "2020-04-13 11:00:00");


    // $thread_post = array();
    // $thread_post["1"] = $m->thread_post($thread["1"], $prof["1"], "Testes e 3 projetos ao longo do semestre", "2020-05-13 11:00:00");
    // $thread_post["2"] = $m->thread_post($thread["2"], $prof["1"], "Testes ao longo do semestre", "2020-05-13 11:00:00");
    // $thread_post["3"] = $m->thread_post($thread["3"], $prof["7"], "3 projetos ao longo do semestre", "2020-04-13 11:00:00");
    // $thread_post["4"] = $m->thread_post($thread["4"], $prof["7"], "Exame final e 5 projetos ao longo do semestre", "2020-05-13 11:00:00");

    
    // $projeto = array();
    // $projeto["1"] = $m->projeto($cadeira["1"], "Evolução da Ciência", "Relatório sobre a seleção natural.", 1, 2, "");
    // $projeto["2"] = $m->projeto($cadeira["63"], "Cadastro Predial do Município", "Fazer um relatório onde exploram o cadastro predial do vosso município.", 1, 2, "");
    // $projeto["3"] = $m->projeto($cadeira["83"], "Spotipy em Haskell", "Implementem o Spotipy em Haskell.", 1, 2, "");
    // $projeto["4"] = $m->projeto($cadeira["88"], "A matemática na natureza", "Os objetivos deste projeto são óbvios, no need to describe them.", 1, 3, "");
    // $projeto["5"] = $m->projeto($cadeira["88"], "Projeto Final", "Os objetivos deste projeto não são tão óbvios.", 1, 3, "");

    // $etapa = array();
    // $etapa["1"] = $m->etapa($projeto["3"], "2020-06-06 23:00:00", "", "Pesquisa", "Façam pesquisa sobre o Spotipy.");
    // $etapa["2"] = $m->etapa($projeto["3"], "2020-05-06 23:00:00", "", "Planeamento", "Façam pesquisa sobre como programar em Haskell.");
    // $etapa["3"] = $m->etapa($projeto["3"], "2020-07-21 23:55:00", "", "Implementação", "Implementar o Spotipy em Haskell.");
    // $etapa["4"] = $m->etapa($projeto["1"], "2020-06-06 23:00:00", "", "Pesquisa", "Pesquisar sobre Charles Darwin.");
    // $etapa["5"] = $m->etapa($projeto["1"], "2020-06-21 23:55:00", "", "Implementação", "Fazer relatório.");
    // $etapa["6"] = $m->etapa($projeto["2"], "2020-06-06 23:00:00", "", "Pesquisa", "Procurar cadástro de Almada.");
    // $etapa["7"] = $m->etapa($projeto["2"], "2020-06-21 23:55:00", "", "Implementação", "Fazer relatório.");
    // $etapa["8"] = $m->etapa($projeto["4"], "2020-05-21 23:55:00", "", "Fazer continhas", "Esta etapa já acabou.");
    // $etapa["9"] = $m->etapa($projeto["5"], "2020-06-21 23:55:00", "", "Fazer continhas outra vez", "Esta etapa ainda não acabou.");

    // $grupo = array();
    // $grupo["1"] = $m->grupo($projeto["3"], "gangdogpl");
    // $grupo["2"] = $m->grupo($projeto["3"], "Rumo ao 20");
    // $grupo["3"] = $m->grupo($projeto["3"], "nota_21");
    // $grupo["4"] = $m->grupo($projeto["4"], "Grupo1");
    // $grupo["5"] = $m->grupo($projeto["4"], "Grupo2");

    // $m->batch("grupo_aluno", Array(
    //   Array("user_id"=> $aluno["114"],  "grupo_id"=>$grupo["1"]),
    //   Array("user_id"=> $aluno["4"],  "grupo_id"=>$grupo["1"]),
    //   Array("user_id"=> $aluno["47"],  "grupo_id"=>$grupo["2"]),
    //   Array("user_id"=> $aluno["96"],  "grupo_id"=>$grupo["2"]),
    //   Array("user_id"=> $aluno["188"],  "grupo_id"=>$grupo["3"]),
    //   Array("user_id"=> $aluno["206"],  "grupo_id"=>$grupo["3"]),
    //   Array("user_id"=> $aluno["4"],  "grupo_id"=>$grupo["4"]),
    //   Array("user_id"=> $aluno["14"],  "grupo_id"=>$grupo["4"]),
    // ));

    // $m->etapa_submit($grupo["1"], $etapa["1"], "URL-FALSO-HEHE-XD.pdf");

    // $horario = array();
    // $horario["1"] = $m->horario_duvidas($cadeira["83"], $prof["7"], "11:30:00", "13:00:00", "Segunda-feira");
    // $horario["2"] = $m->horario_duvidas($cadeira["83"], $prof["7"], "12:00:00", "13:00:00", "Quinta-feira");

    // $evento = array();
    // $evento["1"] = $m->evento("2020-06-18 11:00:00", "2020-06-18 12:30:00", "Reunião de Grupo", "Discutir distribuição do trabalho.", "FCUL");
    // $evento["2"] = $m->evento("2020-06-25 11:30:00", "2020-06-25 13:00:00", "Horário de dúvidas", "Horário de dúvidas com o(a) professor(a) Maria José 1", "6.1.29", $horario["1"]);
    // $evento["3"] = $m->evento("2020-06-17 11:00:00", "2020-06-17 12:30:00", "Decidir Framework", "Esta descrição descreve o evento. 2", "Azenhas");
    // $evento["4"] = $m->evento("2020-06-18 12:00:00", "2020-06-18 13:00:00", "Horário de dúvidas", "Horário de dúvidas com o(a) professor(a) Maria José 2", "6.1.29", $horario["2"]);

    // $m->batch("evento_grupo", Array(
    //   Array("evento_id"=> $evento["1"],  "grupo_id"=>$grupo["1"]),
    //   Array("evento_id"=> $evento["3"],  "grupo_id"=>$grupo["1"]),
    // ));

    // $m->batch("evento_user", Array(
    //   Array("evento_id"=> $evento["1"],  "user_id"=>$aluno["4"]),
    //   Array("evento_id"=> $evento["3"],  "user_id"=>$aluno["4"]),
    // ));

    // $m->notification($aluno["4"], "message", "Mensagem de João Soares", "Então?", "app/profile/2801", false, "2020-05-19 11:30:31");
    // $m->notification($aluno["4"], "alert", "Tens uma trabalho para entregar", "Arquitetura de Computadores", "app/profile/2", false, "2020-05-30 11:30:35");
    // $m->notification($aluno["4"], "alert", "Falhaste uma entrega", "Teatro", "subjects/subject/TEA84/2019", false, "2020-05-29 11:30:30");
    // $m->notification($aluno["4"], "message", "Mensagem de Raul Koch", "Esta está seen, não deve aparecer", "app/profile/62", true, "2020-05-29 11:30:33");
        
    $execution_time = time(true) - $time_start;

    // echo "<h2>Tempo de processamento: ".$execution_time."s </h2>";
    // echo "<p><b>Alunos</b><br>s1, s2...</p>";
    // echo "<p><b>Professores</b><br>t1, t2...</p>";
    // echo "<p><b>Passwords</b><br>smart</p>";
}