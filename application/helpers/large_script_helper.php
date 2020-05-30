<?php

function large_script($m) {
    $time_start = microtime(true);
    
    $aluno = array();
    // $aluno["1"] = $m->student("Name", "Surname", "s1", "s1", "Descrição default.");
    // $aluno["2"] = $m->student("Adriana", "De", "s2", "s2", "Descrição default.");
    // $aluno["3"] = $m->student("Afonso", "JosÉ", "s3", "s3", "Descrição default.");
    $aluno["4"] = $m->student("Catarina", "Leite", "s4", "s4", "Esta é a nossa aluna principal, pelo que tem mais informação.");
    // $aluno["5"] = $m->student("Alessia", "Lopes", "s5", "s5", "Descrição default.");
    // $aluno["6"] = $m->student("Alexandre", "Antonio", "s6", "s6", "Descrição default.");
    // $aluno["7"] = $m->student("Alice", "Calretas", "s7", "s7", "Descrição default.");
    // $aluno["8"] = $m->student("Alice", "Martins", "s8", "s8", "Descrição default.");
    // $aluno["9"] = $m->student("Ana", "Beatriz", "s9", "s9", "Descrição default.");
    // $aluno["10"] = $m->student("Ana", "Catarina", "s10", "s10", "Descrição default.");
    // $aluno["11"] = $m->student("Ana", "Filipa", "s11", "s11", "Descrição default.");
    // $aluno["12"] = $m->student("Ana", "Isabel", "s12", "s12", "Descrição default.");
    // $aluno["13"] = $m->student("Ana", "Marisa", "s13", "s13", "Descrição default.");
    $aluno["14"] = $m->student("Ana", "Marta", "s14", "s14", "Descrição default.");
    // $aluno["15"] = $m->student("Ana", "Rita", "s15", "s15", "Descrição default.");
    // $aluno["16"] = $m->student("Ana", "Rita", "s16", "s16", "Descrição default.");
    // $aluno["17"] = $m->student("Ana", "Sofia", "s17", "s17", "Descrição default.");
    // $aluno["18"] = $m->student("Andreia", "Carina", "s18", "s18", "Descrição default.");
    // $aluno["19"] = $m->student("Andreia", "CarriÇo", "s19", "s19", "Descrição default.");
    // $aluno["20"] = $m->student("AndrÉ", "Filipe", "s20", "s20", "Descrição default.");
    // $aluno["21"] = $m->student("AndrÉ", "Filipe", "s21", "s21", "Descrição default.");
    // $aluno["22"] = $m->student("AndrÉ", "Filipe", "s22", "s22", "Descrição default.");
    // $aluno["23"] = $m->student("AndrÉ", "Vieira", "s23", "s23", "Descrição default.");
    // $aluno["24"] = $m->student("AntÓnio", "Afonso", "s24", "s24", "Descrição default.");
    // $aluno["25"] = $m->student("AntÓnio", "Maria", "s25", "s25", "Descrição default.");
    // $aluno["26"] = $m->student("AntÓnio", "Maria", "s26", "s26", "Descrição default.");
    // $aluno["27"] = $m->student("AntÓnio", "Miguel", "s27", "s27", "Descrição default.");
    // $aluno["28"] = $m->student("AntÓnio", "Pedro", "s28", "s28", "Descrição default.");
    // $aluno["29"] = $m->student("Beatriz", "Alexandra", "s29", "s29", "Descrição default.");
    // $aluno["30"] = $m->student("Beatriz", "Catarino", "s30", "s30", "Descrição default.");
    $aluno["31"] = $m->student("Beatriz", "Coutinho", "s31", "s31", "Descrição default.");
    // $aluno["32"] = $m->student("Beatriz", "Daniela", "s32", "s32", "Descrição default.");
    // $aluno["33"] = $m->student("Beatriz", "Dinelli", "s33", "s33", "Descrição default.");
    // $aluno["34"] = $m->student("Beatriz", "Duarte", "s34", "s34", "Descrição default.");
    // $aluno["35"] = $m->student("Beatriz", "Lopes", "s35", "s35", "Descrição default.");
    // $aluno["36"] = $m->student("Beatriz", "Parreirinha", "s36", "s36", "Descrição default.");
    // $aluno["37"] = $m->student("Beatriz", "Silva", "s37", "s37", "Descrição default.");
    // $aluno["38"] = $m->student("Bernardo", "LourenÇo", "s38", "s38", "Descrição default.");
    // $aluno["39"] = $m->student("Bruno", "Alexandre", "s39", "s39", "Descrição default.");
    // $aluno["40"] = $m->student("Bruno", "Daniel", "s40", "s40", "Descrição default.");
    // $aluno["41"] = $m->student("Bruno", "Miguel", "s41", "s41", "Descrição default.");
    $aluno["42"] = $m->student("Bruno", "Miguel", "s42", "s42", "Descrição default.");
    // $aluno["43"] = $m->student("Bruno", "Teixeira", "s43", "s43", "Descrição default.");
    // $aluno["44"] = $m->student("Carolina", "Baptista", "s44", "s44", "Descrição default.");
    // // $aluno["45"] = $m->student("Carolina", "Ferreira", "s45", "s45", "Descrição default.");
    // $aluno["46"] = $m->student("Carolina", "Maria", "s46", "s46", "Descrição default.");
    $aluno["47"] = $m->student("Carolina", "Maria", "s47", "s47", "Descrição default.");
    // $aluno["48"] = $m->student("Carolina", "Nunes", "s48", "s48", "Descrição default.");
    // $aluno["49"] = $m->student("Carolina", "Sofia", "s49", "s49", "Descrição default.");
    // $aluno["50"] = $m->student("Catarina", "Alexandra", "s50", "s50", "Descrição default.");
    // $aluno["51"] = $m->student("Catarina", "GonÇalves", "s51", "s51", "Descrição default.");
    // $aluno["52"] = $m->student("Catarina", "GonÇalves", "s52", "s52", "Descrição default.");
    // $aluno["53"] = $m->student("Catarina", "Lopes", "s53", "s53", "Descrição default.");
    // $aluno["54"] = $m->student("Catarina", "Maria", "s54", "s54", "Descrição default.");
    // $aluno["55"] = $m->student("Catarina", "Salgado", "s55", "s55", "Descrição default.");
    // $aluno["56"] = $m->student("Clara", "Morais", "s56", "s56", "Descrição default.");
    // $aluno["57"] = $m->student("ConstanÇa", "Melo", "s57", "s57", "Descrição default.");
    // $aluno["58"] = $m->student("Cristiana", "Sofia", "s58", "s58", "Descrição default.");
    // $aluno["59"] = $m->student("CÉlia", "Samo", "s59", "s59", "Descrição default.");
    // $aluno["60"] = $m->student("Daniela", "Hanganu", "s60", "s60", "Descrição default.");
    $aluno["61"] = $m->student("Diana", "Patricia", "s61", "s61", "Descrição default.");
    // $aluno["62"] = $m->student("Diogo", "AntÓnio", "s62", "s62", "Descrição default.");
    // $aluno["63"] = $m->student("Diogo", "Caneco", "s63", "s63", "Descrição default.");
    // $aluno["64"] = $m->student("Diogo", "Catarino", "s64", "s64", "Descrição default.");
    // $aluno["65"] = $m->student("Diogo", "Maria", "s65", "s65", "Descrição default.");
    // $aluno["66"] = $m->student("Diogo", "Miguel", "s66", "s66", "Descrição default.");
    // $aluno["67"] = $m->student("Duarte", "De", "s67", "s67", "Descrição default.");
    // $aluno["68"] = $m->student("Duarte", "Ferreira", "s68", "s68", "Descrição default.");
    // $aluno["69"] = $m->student("Duarte", "Maria", "s69", "s69", "Descrição default.");
    // $aluno["70"] = $m->student("Duarte", "SimÃo", "s70", "s70", "Descrição default.");
    // $aluno["71"] = $m->student("Eduardo", "Pinheiro", "s71", "s71", "Descrição default.");
    // $aluno["72"] = $m->student("Filipa", "Alexandra", "s72", "s72", "Descrição default.");
    // $aluno["73"] = $m->student("Filipe", "Antunes", "s73", "s73", "Descrição default.");
    // $aluno["74"] = $m->student("Francisca", "Maria", "s74", "s74", "Descrição default.");
    // $aluno["75"] = $m->student("Francisco", "Marques", "s75", "s75", "Descrição default.");
    // $aluno["76"] = $m->student("Francisco", "Moura", "s76", "s76", "Descrição default.");
    // $aluno["77"] = $m->student("Francisco", "Stevens", "s77", "s77", "Descrição default.");
    $aluno["78"] = $m->student("Fábio", "Jorge", "s78", "s78", "Descrição default.");
    // $aluno["79"] = $m->student("Fátima", "Carvalho", "s79", "s79", "Descrição default.");
    // $aluno["80"] = $m->student("GonÇalo", "Da", "s80", "s80", "Descrição default.");
    // $aluno["81"] = $m->student("GonÇalo", "De", "s81", "s81", "Descrição default.");
    // $aluno["82"] = $m->student("GonÇalo", "Manuel", "s82", "s82", "Descrição default.");
    // $aluno["83"] = $m->student("Guilherme", "Herculano", "s83", "s83", "Descrição default.");
    // $aluno["84"] = $m->student("Henrique", "Miguel", "s84", "s84", "Descrição default.");
    // $aluno["85"] = $m->student("Inês", "Alexandra", "s85", "s85", "Descrição default.");
    // $aluno["86"] = $m->student("Inês", "Carvalho", "s86", "s86", "Descrição default.");
    // $aluno["87"] = $m->student("Inês", "Costa", "s87", "s87", "Descrição default.");
    // $aluno["88"] = $m->student("Inês", "Luz", "s88", "s88", "Descrição default.");
    // $aluno["89"] = $m->student("Inês", "Sofia", "s89", "s89", "Descrição default.");
    $aluno["90"] = $m->student("Joana", "Catarina", "s90", "s90", "Descrição default.");
    // $aluno["91"] = $m->student("Joana", "De", "s91", "s91", "Descrição default.");
    // $aluno["92"] = $m->student("Joana", "Maria", "s92", "s92", "Descrição default.");
    // $aluno["93"] = $m->student("Joana", "Moreira", "s93", "s93", "Descrição default.");
    // $aluno["94"] = $m->student("Joana", "Pereira", "s94", "s94", "Descrição default.");
    // $aluno["95"] = $m->student("Joana", "Pinto", "s95", "s95", "Descrição default.");
    $aluno["96"] = $m->student("Joana", "Raquel", "s96", "s96", "Descrição default.");
    // $aluno["97"] = $m->student("Joana", "Torres", "s97", "s97", "Descrição default.");
    $aluno["98"] = $m->student("Jonathan", "Fingolo", "s98", "s98", "Descrição default.");
    // $aluno["99"] = $m->student("JosÉ", "Do", "s99", "s99", "Descrição default.");
    // $aluno["100"] = $m->student("JosÉ", "Maria", "s100", "s100", "Descrição default.");
    // $aluno["101"] = $m->student("JoÃo", "AntÓnio", "s101", "s101", "Descrição default.");
    // $aluno["102"] = $m->student("JoÃo", "Carlos", "s102", "s102", "Descrição default.");
    // $aluno["103"] = $m->student("JoÃo", "Filipe", "s103", "s103", "Descrição default.");
    // $aluno["104"] = $m->student("JoÃo", "GonÇalo", "s104", "s104", "Descrição default.");
    // $aluno["105"] = $m->student("JoÃo", "JosÉ", "s105", "s105", "Descrição default.");
    // $aluno["106"] = $m->student("JoÃo", "Miguel", "s106", "s106", "Descrição default.");
    // $aluno["107"] = $m->student("JoÃo", "Miguel", "s107", "s107", "Descrição default.");
    // $aluno["108"] = $m->student("JoÃo", "Pedro", "s108", "s108", "Descrição default.");
    // $aluno["109"] = $m->student("JoÃo", "Pedro", "s109", "s109", "Descrição default.");
    // $aluno["110"] = $m->student("JoÃo", "Pedro", "s110", "s110", "Descrição default.");
    // $aluno["111"] = $m->student("JoÃo", "Tiago", "s111", "s111", "Descrição default.");
    // $aluno["112"] = $m->student("JoÃo", "Martins", "s112", "s112", "Descrição default.");
    // $aluno["113"] = $m->student("Jéssica", "Alves", "s113", "s113", "Descrição default.");
    $aluno["114"] = $m->student("Karolina", "Mazurek", "s114", "s114", "Descrição default.");
    // $aluno["115"] = $m->student("Kennedy", "Samuel", "s115", "s115", "Descrição default.");
    // $aluno["116"] = $m->student("Lara", "Isabel", "s116", "s116", "Descrição default.");
    $aluno["117"] = $m->student("Leonor", "Inês", "s117", "s117", "Descrição default.");
    // $aluno["118"] = $m->student("Lucas", "Bronger", "s118", "s118", "Descrição default.");
    $aluno["119"] = $m->student("Luis", "Ricciardi", "s119", "s119", "Descrição default.");
    // $aluno["120"] = $m->student("Luis", "Eduardo", "s120", "s120", "Descrição default.");
    // $aluno["121"] = $m->student("Luis", "Miguel", "s121", "s121", "Descrição default.");
    // $aluno["122"] = $m->student("Luis", "Tiago", "s122", "s122", "Descrição default.");
    // $aluno["123"] = $m->student("Madalena", "Sousa", "s123", "s123", "Descrição default.");
    // $aluno["124"] = $m->student("Manuel", "Neves", "s124", "s124", "Descrição default.");
    // $aluno["125"] = $m->student("Manuel", "Ulrich", "s125", "s125", "Descrição default.");
    // $aluno["126"] = $m->student("Margarida", "Comprido", "s126", "s126", "Descrição default.");
    $aluno["127"] = $m->student("Margarida", "Do", "s127", "s127", "Descrição default.");
    // $aluno["128"] = $m->student("Margarida", "Duarte", "s128", "s128", "Descrição default.");
    // $aluno["129"] = $m->student("Margarida", "Olaio", "s129", "s129", "Descrição default.");
    // $aluno["130"] = $m->student("Margarida", "Ramos", "s130", "s130", "Descrição default.");
    // $aluno["131"] = $m->student("Margarida", "Rodrigues", "s131", "s131", "Descrição default.");
    // $aluno["132"] = $m->student("Maria", "Ana", "s132", "s132", "Descrição default.");
    $aluno["133"] = $m->student("Maria", "Carolina", "s133", "s133", "Descrição default.");
    $aluno["134"] = $m->student("Maria", "Catarina", "s134", "s134", "Descrição default.");
    $aluno["135"] = $m->student("Maria", "Francisca", "s135", "s135", "Descrição default.");
    $aluno["136"] = $m->student("Maria", "Inês", "s136", "s136", "Descrição default.");
    $aluno["137"] = $m->student("Maria", "Leonor", "s137", "s137", "Descrição default.");
    $aluno["138"] = $m->student("Maria", "Leonor", "s138", "s138", "Descrição default.");
    $aluno["139"] = $m->student("Maria", "Rodrigues", "s139", "s139", "Descrição default.");
    // $aluno["140"] = $m->student("Maria", "Teresa", "s140", "s140", "Descrição default.");
    // $aluno["141"] = $m->student("Mariana", "CÂmara", "s141", "s141", "Descrição default.");
    // $aluno["142"] = $m->student("Mariana", "De", "s142", "s142", "Descrição default.");
    $aluno["143"] = $m->student("Mariana", "Ferreira", "s143", "s143", "Descrição default.");
    $aluno["144"] = $m->student("Mariana", "Inês", "s144", "s144", "Descrição default.");
    $aluno["145"] = $m->student("Mariana", "Matias", "s145", "s145", "Descrição default.");
    $aluno["146"] = $m->student("Mariana", "Neves", "s146", "s146", "Descrição default.");
    $aluno["147"] = $m->student("Mariana", "Zurrapa", "s147", "s147", "Descrição default.");
    $aluno["148"] = $m->student("Marta", "Almeida", "s148", "s148", "Descrição default.");
    $aluno["149"] = $m->student("Marta", "Da", "s149", "s149", "Descrição default.");
    $aluno["150"] = $m->student("Marta", "Meira", "s150", "s150", "Descrição default.");
    $aluno["151"] = $m->student("Marta", "Ponciano", "s151", "s151", "Descrição default.");
    $aluno["152"] = $m->student("Marta", "Soares", "s152", "s152", "Descrição default.");
    $aluno["153"] = $m->student("Marta", "Sofia", "s153", "s153", "Descrição default.");
    $aluno["154"] = $m->student("Marta", "Sofia", "s154", "s154", "Descrição default.");
    $aluno["155"] = $m->student("Martim", "Da", "s155", "s155", "Descrição default.");
    $aluno["156"] = $m->student("Martim", "EstêvÃo", "s156", "s156", "Descrição default.");
    $aluno["157"] = $m->student("Mathias", "Alex", "s157", "s157", "Descrição default.");
    $aluno["158"] = $m->student("Matilde", "Maria", "s158", "s158", "Descrição default.");
    $aluno["159"] = $m->student("Miguel", "Afonso", "s159", "s159", "Descrição default.");
    $aluno["160"] = $m->student("Miguel", "Alexandre", "s160", "s160", "Descrição default.");
    // $aluno["161"] = $m->student("Miguel", "Alexandre", "s161", "s161", "Descrição default.");
    // $aluno["162"] = $m->student("Miguel", "Laranjeira", "s162", "s162", "Descrição default.");
    // $aluno["163"] = $m->student("Miguel", "Tomás", "s163", "s163", "Descrição default.");
    $aluno["164"] = $m->student("Márcia", "Filipa", "s164", "s164", "Descrição default.");
    // $aluno["165"] = $m->student("Márcia", "Henriques", "s165", "s165", "Descrição default.");
    // $aluno["166"] = $m->student("MÓnica", "Beatriz", "s166", "s166", "Descrição default.");
    // $aluno["167"] = $m->student("Nadine", "Figueiredo", "s167", "s167", "Descrição default.");
    // $aluno["168"] = $m->student("Nautaran", "Nancassa", "s168", "s168", "Descrição default.");
    // $aluno["169"] = $m->student("Nuno", "Barata", "s169", "s169", "Descrição default.");
    // $aluno["170"] = $m->student("Nuno", "Ricardo", "s170", "s170", "Descrição default.");
    // $aluno["171"] = $m->student("Olivia", "Maria", "s171", "s171", "Descrição default.");
    // $aluno["172"] = $m->student("Otavio", "Augusto", "s172", "s172", "Descrição default.");
    // $aluno["173"] = $m->student("Patricia", "Filipa", "s173", "s173", "Descrição default.");
    // $aluno["174"] = $m->student("Pedro", "Da", "s174", "s174", "Descrição default.");
    // $aluno["175"] = $m->student("Pedro", "Miguel", "s175", "s175", "Descrição default.");
    $aluno["176"] = $m->student("Pedro", "Rendo", "s176", "s176", "Descrição default.");
    // $aluno["177"] = $m->student("Phillip", "Kemp", "s177", "s177", "Descrição default.");
    // $aluno["178"] = $m->student("Rafael", "Banza", "s178", "s178", "Descrição default.");
    // $aluno["179"] = $m->student("Raquel", "Filipa", "s179", "s179", "Descrição default.");
    // $aluno["180"] = $m->student("Raquel", "PerdigÃo", "s180", "s180", "Descrição default.");
    // $aluno["181"] = $m->student("Raquel", "Rebelo", "s181", "s181", "Descrição default.");
    // $aluno["182"] = $m->student("RaÚl", "Julian", "s182", "s182", "Descrição default.");
    $aluno["183"] = $m->student("Ricardo", "Martins", "s183", "s183", "Descrição default.");
    // $aluno["184"] = $m->student("Rita", "Alexandra", "s184", "s184", "Descrição default.");
    // $aluno["185"] = $m->student("Rita", "Isabel", "s185", "s185", "Descrição default.");
    // $aluno["186"] = $m->student("Rita", "Policarpo", "s186", "s186", "Descrição default.");
    // $aluno["187"] = $m->student("Rodrigo", "Afonso", "s187", "s187", "Descrição default.");
    $aluno["188"] = $m->student("Rodrigo", "AragÜés", "s188", "s188", "Descrição default.");
    // $aluno["189"] = $m->student("Rodrigo", "QueirÓs", "s189", "s189", "Descrição default.");
    // $aluno["190"] = $m->student("Sara", "Isabel", "s190", "s190", "Descrição default.");
    // $aluno["191"] = $m->student("SebastiÃo", "De", "s191", "s191", "Descrição default.");
    // $aluno["192"] = $m->student("Shania", "Tierra", "s192", "s192", "Descrição default.");
    // $aluno["193"] = $m->student("Sofia", "Ribeiro", "s193", "s193", "Descrição default.");
    $aluno["194"] = $m->student("Stefany", "Mariany", "s194", "s194", "Descrição default.");
    // $aluno["195"] = $m->student("Sérgio", "Miguel", "s195", "s195", "Descrição default.");
    // $aluno["196"] = $m->student("SÓnia", "Da", "s196", "s196", "Descrição default.");
    // $aluno["197"] = $m->student("Teresa", "Bernardino", "s197", "s197", "Descrição default.");
    $aluno["198"] = $m->student("Teresa", "Maria", "s198", "s198", "Descrição default.");
    $aluno["199"] = $m->student("Tiago", "Ferreira", "s199", "s199", "Descrição default.");
    // $aluno["200"] = $m->student("Tiago", "Filipe", "s200", "s200", "Descrição default.");
    // $aluno["201"] = $m->student("Tomas", "Maria", "s201", "s201", "Descrição default.");
    // $aluno["202"] = $m->student("Tomás", "BraganÇa", "s202", "s202", "Descrição default.");
    // $aluno["203"] = $m->student("Tomás", "Da", "s203", "s203", "Descrição default.");
    // $aluno["204"] = $m->student("Tomás", "Dos", "s204", "s204", "Descrição default.");
    // $aluno["205"] = $m->student("Tomás", "Jardim", "s205", "s205", "Descrição default.");
    $aluno["206"] = $m->student("Tomás", "Ventura", "s206", "s206", "Descrição default.");
    // $aluno["207"] = $m->student("Vasco", "Filipe", "s207", "s207", "Descrição default.");
    // $aluno["208"] = $m->student("Vasco", "Maria", "s208", "s208", "Descrição default.");
    // $aluno["209"] = $m->student("Vasco", "Santos", "s209", "s209", "Descrição default.");
    // $aluno["210"] = $m->student("Vasco", "Sousa", "s210", "s210", "Descrição default.");
    // $aluno["211"] = $m->student("Vera", "Alexandra", "s211", "s211", "Descrição default.");
    // $aluno["212"] = $m->student("Yiqing", "Zhu", "s212", "s212", "Descrição default.");
    $aluno["213"] = $m->student("Ângela", "Do", "s213", "s213", "Descrição default.");
    $aluno["214"] = $m->student("Érica", "Beatriz", "s214", "s214", "Descrição default.");

    $prof = array();
    $prof["1"] = $m->teacher("Manuel", "Francisco", "t1", "t1", "Descrição default.", "6.1.19");
    $prof["2"] = $m->teacher("José", "Andrade", "t2", "t2", "Descrição default.", "6.1.123");
    $prof["3"] = $m->teacher("João", "Sousa", "t3", "t3", "Descrição default.", "6.1.4");
    $prof["4"] = $m->teacher("Amélia", "Silva", "t4", "t4", "Descrição default.", "6.1.3");
    $prof["5"] = $m->teacher("Cristina", "Soares", "t5", "t5", "Descrição default.", "6.1.64");
    $prof["6"] = $m->teacher("Ana", "Pereira", "t6", "t6", "Descrição default.", "6.1.34");
    $prof["7"] = $m->teacher("Maria", "José", "t7", "t7", "Descrição default.", "6.1.29");
    $prof["8"] = $m->teacher("André", "João", "t8", "t8", "Descrição default.", "6.1.1");
    $prof["9"] = $m->teacher("Rodolfo", "Martins", "t9", "t9", "Descrição default.", "6.1.123");
    $prof["10"] = $m->teacher("Martim", "Mais", "t10", "t10", "Descrição default.", "6.1.143");
    $prof["11"] = $m->teacher("Marilia", "Santana", "t11", "t11", "Descrição default.", "6.1.13");
    $prof["12"] = $m->teacher("Cecilia", "Brás", "t12", "t12", "Descrição default.", "6.1.12");
    $prof["13"] = $m->teacher("Joana", "Gomes", "t13", "t13", "Descrição default.", "6.1.11");
    $prof["14"] = $m->teacher("Miguel", "Gomes", "t14", "t14", "Descrição default.", "");

    $faculdade["1"] = $m->faculdade("Faculdade de Ciências da Universidade de Lisboa", "FCUL", "Campo Grande");
    $faculdade["2"] = $m->faculdade("Faculdade de Belas-Artes da Universidade de Lisboa", "FBAUL", "Largo da Academia Nacional de Belas Artes");
    $faculdade["3"] = $m->faculdade("Instituto Superior de Economia e Gestão da Universidade de Lisboa", "ISEG", "Rua do Quelhas 6");

    $ano["1"] = $m->ano_letivo("2019", "2020");

    $curso = array();
    #FCUL
    $curso["1"] = $m->curso($faculdade["1"], $ano["1"], "9011", "Biologia", "A Biologia visa a aprendizagem dos conceitos fundamentais inerentes aos sistemas vivos, afirmando-se como uma das ciências com maior desenvolvimento e impacto nas sociedades modernas. Desde a sequenciação de vários genomas, nomeadamente o da espécie humana e de várias espécies agrícolas de que depende a nossa sobrevivência como sociedade, aos problemas de sustentabilidade dos ecossistemas e da conservação da biodiversidade, as implicações sociais e culturais da Biologia atingem escalas sem precedência na história da humanidade. A FCUL tem larga tradição e grandes responsabilidades no ensino da Biologia já que em anos recentes se tem afirmado como a escola de referência nesta área científica, cativando mais alunos e com melhores médias académicas que qualquer outra a nível nacional. Na base deste sucesso de cativação de alunos tem estado um esquema de entrada única, sólida formação pluridisciplinar nos dois primeiros anos (tronco comum) e um leque de opções académicas de especialização que mais nenhuma escola oferece.");
    $curso["2"] = $m->curso($faculdade["1"], $ano["1"], "9015", "Bioquímica", "A Licenciatura em Bioquímica confere o título de bioquímico e tem como objetivos principais: - Formar profissionais com uma sólida formação científica em Ciências da Vida, tanto teórica como experimental, e com uma forte componente de iniciação à investigação; - Ministrar um núcleo de conhecimentos nas áreas científicas de Química, Física, Biologia, Matemática, Estatística e Informática com vista a proporcionar aos estudantes uma ampla formação básica para, no futuro, abordarem problemas de índole bioquímica diversa. Esta formação inicial é incluída maioritariamente nos dois primeiros semestres da Licenciatura; - Providenciar uma formação extensiva e transversal nas várias áreas da Bioquímica, central para o prosseguimento de carreiras nas áreas acima mencionadas. Esta formação, com forte componente prática, é fornecida no segundo e terceiro anos da Licenciatura. Competências: Planeamento, gestão e execução de projetos em diversas áreas das ciências da vida como a neuroquímica, oncobiologia, biologia de sistemas, bioinformática, biotecnologia, biologia molecular, metabolómica, genómica, proteómica ou biofísica molecular. Implementação de métodos bioquímicos analíticos em laboratórios clínicos ou de serviços.");
    $curso["3"] = $m->curso($faculdade["1"], $ano["1"], "L096", "Engenharia Geoespacial", "A área da Engenharia Geoespacial apresenta uma visão moderna e atualizada da área da Informação Geográfica e Cartográfica, hoje designada de Informação GeoEspacial ou Informação Espacial Georreferenciada. A Informação Geoespacial é toda a informação associada a uma localização, ela é fundamental no planeamento, na gestão e ordenamento do território, ao nível do ambiente, da segurança, das infraestruturas e da administração pública; é fundamental no planeamento e gestão de serviços localizados, como os sectores convencionais da água, da energia e das telecomunicações, ou os sectores emergente de serviços baseados na localização móvel, como todos os serviços bem conhecidos e disponibilizados pela Internet nas aplicações dos telemóveis ou na Web.");
    $curso["4"] = $m->curso($faculdade["1"], $ano["1"], "9119", "Engenharia Informática", "A Licenciatura em Engenharia Informática (LEI) corresponde aos enormes desafios de imaginação, criatividade e inovação tecnológica impostos pela sociedade e pelo mercado de emprego no espaço económico europeu. A LEI adquiriu um grau de qualidade que permite considerá-la como uma das melhores do país no seu domínio. Este contexto extremamente positivo resulta de um processo de melhoria contínua com o objetivo de aproximar, de forma sistemática, o melhor e mais recente saber científico e técnico às solicitações das empresas mais qualificadas do mercado. A LEI encontra-se articulada com o Mestrado em Engenharia Informática, constituindo um produto coerente de cinco anos de formação necessária ao desempenho da atividade profissional de engenheiro informático. Esta formação está acreditada pela Ordem dos Engenheiros, concedendo aos seus graduados acesso ao título de Engenheiro Informático, e pela A3ES, a agência de acreditação nacional do ensino superior.");
    $curso["5"] = $m->curso($faculdade["1"], $ano["1"], "9381", "Estatística Aplicada", "A Licenciatura em Estatística Aplicada, cujo eixo é a recolha/produção de dados, sua análise e interpretação, visa a formação de profissionais para empresas de sondagens e de estudos de mercado, para a administração central e local, gestão de informação em órgãos de comunicação social e partidos políticos, empresas de médio ou grande porte.");
    $curso["6"] = $m->curso($faculdade["1"], $ano["1"], "9458", "Estudos Gerais", "A Licenciatura em Estudos Gerais tem uma característica que a diferencia de todas as outras em Portugal: permite uma combinação única entre as artes, as humanidades e as ciências. Os estudantes vão licenciar-se naquilo que decidirem durante a licenciatura, podendo escolher com menos pressões e com mais conhecimento de causa, pois só têm de definir eventuais áreas de concentração durante o seu curso.");
    $curso["7"] = $m->curso($faculdade["1"], $ano["1"], "9141", "Física", "A Licenciatura em Física oferece uma formação sólida e abrangente em física fundamental e aplicada. O curso está estruturado em duas fases, uma primeira de formação geral em matemática e física, e uma segunda de formação complementar em física mais avançada. Nesta é possível optar por diferentes percursos: Física, que fornece formação nas áreas principais da física contemporânea; Astronomia e Astrofísica, que integra uma formação orientada para esta área; e Minor em outra área científica, que permite diferentes perfis pluridisciplinares, combinando uma formação em Física com formação noutra área científica.");
    $curso["8"] = $m->curso($faculdade["1"], $ano["1"], "9146", "Geologia", "A Licenciatura em Geologia tem como objetivo principal o desenvolvimento das competências necessárias ao desempenho qualificado e versátil da profissão de geólogo em diferentes domínios de atividade, da investigação científica às diversas aplicações industriais e ambientais. Esta formação de largo espectro (que se fundamenta em conhecimento científico sólido e eclético, abrindo múltiplos caminhos para a empregabilidade), inscreve-se nos programas de Ensino Superior de nível 6 (QNQ e EQF) e habilita diretamente ao exercício da profissão.");
    $curso["9"] = $m->curso($faculdade["1"], $ano["1"], "9209", "Matemática", "A Licenciatura em Matemática visa a aquisição de conhecimentos básicos nos vários ramos da matemática (incluindo Análise, Álgebra, Geometria e Análise Numérica) e suas interações e aplicações em áreas afins. Estes conhecimentos devem possibilitar o acesso a qualquer formação complementar (2.º Ciclo) na área da matemática, quer esta seja dirigida para a investigação, para o ensino ou para o mundo empresarial e dos serviços.");
    $curso["10"] = $m->curso($faculdade["1"], $ano["1"], "9385", "Matemática Aplicada", "A Licenciatura em Matemática Aplicada tem como objetivo oferecer formação nas áreas da Matemática com maior aplicação e nível de empregabilidade no nosso país, sem descurar a apreensão de conhecimentos sólidos na sua vertente básica e fundamental. Assim, o principal objetivo é que os licenciados por este ciclo de estudos sejam capazes de utilizar a Matemática na resolução de problemas concretos, tanto em ambiente empresarial como no desenvolvimento de tecnologia de ponta e no apoio à investigação, principalmente de natureza interdisciplinar. Pretende-se ainda que os alunos sejam capazes de utilizar e desenvolver ferramentas Informáticas para a resolução de problemas de Matemática Aplicada e que adquiram alguns conhecimentos em outras áreas científicas que são campos preferenciais de aplicação da Matemática, tais como Física, Economia, Gestão ou outras.");
    $curso["11"] = $m->curso($faculdade["1"], $ano["1"], "9212", "Meteorologia, Oceanografia e Geofísica", "Este primeiro ciclo de formação superior nas áreas das Ciências da Terra, da Atmosfera e dos Oceanos, com sólida formação básica em Física, Matemática e Informática, visa abrir as perspetivas do aluno relativamente à importância de uma abordagem científica destas áreas, e fornecer uma formação atualizada nas áreas específicas da Meteorologia, Oceanografia e Geofísica Interna, de modo a preparar profissionais com prática de utilização das tecnologias mais modernas e com capacidade de enfrentarem a interdisciplinaridade dos problemas reais. Também se visa proporcionar a preparação e o incentivo necessários para o prosseguimento dos estudos a um nível mais avançado (2.º e 3.º Ciclos em Ciências Geofísicas), no país ou em instituições estrangeiras, nas áreas da Meteorologia, da Oceanografia, da Geofísica Interna e das Ciências do Ambiente.");
    $curso["12"] = $m->curso($faculdade["1"], $ano["1"], "9223", "Química", "O objetivo principal da Licenciatura em Química reside no desenvolvimento das competências necessárias ao desempenho qualificado e versátil da profissão de Químico em diferentes domínios de atividade, desde a investigação científica às diversas aplicações industriais e ambientais.");
    $curso["13"] = $m->curso($faculdade["1"], $ano["1"], "9226", "Química Tecnológica", "A Licenciatura em Química Tecnológica pretende formar quadros com bases científicas e capacidade tecnológica para desempenharem atividade profissional na indústria química e associadas, contribuindo para o desaparecimento do knowledge gap existente entre a formação tradicional em Química das Faculdade de Ciências e em Engenharia Química das Escolas de Engenharia. Possibilitar formação complementar noutra área científica oferecida pela FCUL (Minors).");
    $curso["14"] = $m->curso($faculdade["1"], $ano["1"], "L079", "Tecnologias de Informação", "A Licenciatura em Tecnologias de Informação (LTI) pretende responder aos novos e diversificados desafios que resultam da constante expansão da área científica da Informática. Neste contexto, são necessários profissionais qualificados que além de competências nucleares da Engenharia Informática, tenham conhecimentos relativos a outros domínios com exigências específicas no que diz respeito à gestão e integração de tecnologias de informação.");
    $curso["15"] = $m->curso($faculdade["1"], $ano["1"], "9845", "Engenharia Biomédica e Biofísica", "O Mestrado Integrado em Engenharia Biomédica e Biofísica privilegia, por um lado, as aplicações da Física ao estudo do organismo humano, ao nível da modelação biofísica dos processos fisiológicos e fisiopatológicos e, por outro, o estudo das tecnologias de diagnóstico e terapia que revolucionaram a Medicina nas últimas décadas. Pretende-se que, para além da obtenção de experiência em investigação, os estudantes tenham também, ao longo de todo o curso, contacto com a realidade clínica e empresarial, oferecendo-se por isso a possibilidade de realizar estágios em instituições hospitalares ou empresas com as quais existam acordos de cooperação, em Portugal ou no estrangeiro.");
    $curso["16"] = $m->curso($faculdade["1"], $ano["1"], "9811", "Engenharia da Energia e do Ambiente", "O desafio da transição para um sistema sustentável de energia exige competências transdisciplinares que os tradicionais cursos de engenharia não podem oferecer. O Mestrado Integrado em Engenharia da Energia e do Ambiente pretende colmatar essas necessidades, formando profissionais de engenharia de conceção com capacidade de intervenção nas áreas das energias renováveis e eficiência energética mas sempre com sensibilidade para os impactos ambientais associados às tecnologias energéticas.");
    $curso["17"] = $m->curso($faculdade["1"], $ano["1"], "9368", "Engenharia Física", "O Mestrado Integrado em Engenharia Física visa a formação de profissionais com sólida formação científica e técnica em diferentes áreas do domínio da engenharia e tecnologias físicas. A perspetiva de formação é a de inserir o estudante e futuro profissional nas problemáticas associadas aos fenómenos físicos que estão na base da inovação tecnológica, dotando-os para isso de conhecimentos sólidos em física fundamental e de uma compreensão das abordagens de engenharia, ao mesmo tempo que os coloca em contacto com áreas de aplicação em que a Física é fundamental.");

    #FBAUL
    $curso["18"] = $m->curso($faculdade["2"], $ano["1"], "5251", "Arte Multimédia", "Licenciatura em Arte Multimédia constitui a resposta à necessidade contemporânea de uma formação universitária capaz de integrar, de forma multidisciplinar, diferentes práticas de criação, experimentação e teorização artísticas e estéticas, preparando os estudantes para os novos desafios da criação, da produção visual e da interatividade, na sua dupla vertente conceptual e operativa.");
    $curso["19"] = $m->curso($faculdade["2"], $ano["1"], "5252", "Ciências da Arte e do Património", "Esta licenciatura/1º ciclo de estudos em Ciências da Arte e do Património visa proporcionar formação geral em três domínios, a saber, a Crítica de Arte, a Museologia e a Curadoria de Exposições e a Conservação e Restauro de obras de arte, através de uma formação de base artística, com os necessários complementos de formação científica e técnica e de formação humanística.");



    $cadeira = array();
    #FCUL
    $cadeira["1"] = $m->cadeira($curso["1"], "66506", "Biologia Animal I", "BAni-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#e6b3ff");
    $cadeira["3"] = $m->cadeira($curso["1"], "66522", "História das Ideias em Biologia", "HIB", 1, "Descrição default.", "#b3b3ff");
    $cadeira["4"] = $m->cadeira($curso["1"], "66524", "Introdução ao Tratamento de Dados", "ITD", 1, "Descrição default.", "#99ebff");
    $cadeira["5"] = $m->cadeira($curso["1"], "13504", "Matemática para Biólogos", "MBiolo", 1, "Descrição default.", "#80ffdf");
    $cadeira["6"] = $m->cadeira($curso["1"], "16489", "Química (Biologia)", "Q-Biologia", 1, "Descrição default.", "#80ff80");
    $cadeira["7"] = $m->cadeira($curso["1"], "66506", "Biologia Animal II", "BAni-II", 2, "Descrição default.", "#d5ff80");
    $cadeira["8"] = $m->cadeira($curso["1"], "62809", "Biologia Vegetal", "BVege", 2, "Descrição default.", "#ffff80");
    $cadeira["9"] = $m->cadeira($curso["1"], "44337", "Bioquímica", "Bioqu", 2, "Descrição default.", "#ffd480");
    $cadeira["10"] = $m->cadeira($curso["1"], "46897", "Física para Biólogos", "FBiol", 2, "Descrição default.", "#ffb44c");
    $cadeira["11"] = $m->cadeira($curso["1"], "46896", "Genética", "Gene", 2, "Descrição default.", "#ffa8eb");
    $cadeira["12"] = $m->cadeira($curso["1"], "22738", "Biestatística", "Bioes", 1, "Descrição default.", "#ffb3ec");
    $cadeira["13"] = $m->cadeira($curso["1"], "66510", "Biogeografia", "Bioge", 1, "Descrição default.", "#ffb3ec");
    $cadeira["14"] = $m->cadeira($curso["1"], "67589", "Fisiologia Animal", "FAni", 1, "Descrição default.", "#ffb3ec");
    $cadeira["15"] = $m->cadeira($curso["1"], "49763", "Fundamentos de Biologia Molecular", "FBM", 1, "Descrição default.", "#ffb3ec");
    $cadeira["16"] = $m->cadeira($curso["1"], "64987", "Geologia Geral", "GGera", 1, "Descrição default.", "#ffb3ec");
    $cadeira["17"] = $m->cadeira($curso["1"], "63489", "Processamento de Dados", "PD", 1, "Descrição default.", "#ffb3ec");
    $cadeira["18"] = $m->cadeira($curso["1"], "62831", "Bioética", "Bioeti", 2, "Descrição default.", "#ffb3ec");
    $cadeira["19"] = $m->cadeira($curso["1"], "66504", "Biologia Ambiental e Conservação", "BACons", 2, "Descrição default.", "#ffb3ec");
    $cadeira["20"] = $m->cadeira($curso["1"], "63471", "Biologia Microbiana", "BMicro", 2, "Descrição default.", "#ffb3ec");
    $cadeira["21"] = $m->cadeira($curso["1"], "62818", "Ecologia", "Ecolo", 2, "Descrição default.", "#ffb3ec");
    $cadeira["22"] = $m->cadeira($curso["1"], "66520", "Evolução", "Evo", 2, "Descrição default.", "#ffb3ec");
    $cadeira["23"] = $m->cadeira($curso["1"], "67369", "Fisiologia Vegetal", "FVege", 2, "Descrição default.", "#ffb3ec");
    
    $cadeira["24"] = $m->cadeira($curso["2"], "13542", "Álgebra Linear", "AL", 1, "Descrição default.", "#ffb3ec");
    $cadeira["25"] = $m->cadeira($curso["2"], "62801", "Biologia Celular (Bioquímica)", "BC-Bioquimica", 1, "Descrição default.", "#ffb3ec");
    $cadeira["26"] = $m->cadeira($curso["2"], "34852", "Cálculo Infinitesimal I", "CI-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["27"] = $m->cadeira($curso["2"], "17896", "Fundamentos de Química", "FQuim", 1, "Descrição default.", "#ffb3ec");
    $cadeira["28"] = $m->cadeira($curso["2"], "32874", "Informática na Ótica do Utilizador", "IOU", 1, "Descrição default.", "#ffb3ec");
    $cadeira["29"] = $m->cadeira($curso["2"], "44305", "Bioquímica I", "Bioq-I", 2, "Descrição default.", "#ffb3ec");
    $cadeira["30"] = $m->cadeira($curso["2"], "36523", "Cálculo Infinitesimal II", "CI-II", 2, "Descrição default.", "#ffb3ec");
    $cadeira["31"] = $m->cadeira($curso["2"], "27564", "Física Geral", "FG", 2, "Descrição default.", "#ffb3ec");
    $cadeira["32"] = $m->cadeira($curso["2"], "16789", "Perspetivas em Investigação e Desenvolvimento", "PID", 2, "Descrição default.", "#ffb3ec");
    $cadeira["33"] = $m->cadeira($curso["2"], "45852", "Química Orgânica", "QO", 2, "Descrição default.", "#ffb3ec");
    $cadeira["34"] = $m->cadeira($curso["2"], "22754", "Análise de Dados em Química e Bioquímica", "ADQB", 1, "Descrição default.", "#ffb3ec");
    $cadeira["35"] = $m->cadeira($curso["2"], "44308", "Bioquímica Analítica", "BAna", 1, "Descrição default.", "#e6b3ff");
    $cadeira["36"] = $m->cadeira($curso["2"], "44309", "Bioquímica Experimental I", "BE-I", 1, "Descrição default.", "#b3b3ff");
    $cadeira["37"] = $m->cadeira($curso["2"], "44307", "Bioquímica II", "Bioq-II", 1, "Descrição default.", "#99ebff");
    $cadeira["38"] = $m->cadeira($curso["2"], "55784", "Química-Física I", "QF-I", 1, "Descrição default.", "#80ffdf");
    $cadeira["39"] = $m->cadeira($curso["2"], "44308", "Biquímica Computacional", "BCump", 2, "Descrição default.", "#d5ff80");
    $cadeira["40"] = $m->cadeira($curso["2"], "44313", "Bioquímica Experimental II", "BE-II", 2, "Descrição default.", "#ffff80");
    $cadeira["41"] = $m->cadeira($curso["2"], "46778", "Bioquímica Inorgânica", "BIno", 2, "Descrição default.", "#ffd480");
    $cadeira["42"] = $m->cadeira($curso["2"], "34672", "Microbiologia", "Microb", 2, "Descrição default.", "#ffb44c");
    $cadeira["43"] = $m->cadeira($curso["2"], "44311", "Processos de Oxidação-Redução em Bioquímica", "PORB", 2, "Descrição default.", "#ffa8eb");
    
    // $cadeira["44"] = $m->cadeira($curso["3"], "31167", "Álgebra Linear e Geometria Analítica A", "ALGA-A", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["45"] = $m->cadeira($curso["3"], "64824", "Cálculo I", "Calc-I", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["46"] = $m->cadeira($curso["3"], "45518", "Ciências da Informação Geoespacial", "CIGeo", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["47"] = $m->cadeira($curso["3"], "44712", "Introdução à Investigação Operacional", "IIO", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["48"] = $m->cadeira($curso["3"], "62249", "Programação I", "Prog-I", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["49"] = $m->cadeira($curso["3"], "64892", "Cálculo II", "Calc-II", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["50"] = $m->cadeira($curso["3"], "34615", "Introdução às Probabilidades e Estatística", "IPE", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["51"] = $m->cadeira($curso["3"], "64786", "Introdução às Tecnologias Web", "ITW", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["52"] = $m->cadeira($curso["3"], "61447", "Mecânica e Ondas", "MOnd", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["53"] = $m->cadeira($curso["3"], "64987", "Programação II", "Prog-II", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["54"] = $m->cadeira($curso["3"], "24578", "Ajustamento de Observações", "AObs", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["55"] = $m->cadeira($curso["3"], "63487", "Bases de Dados", "BD", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["56"] = $m->cadeira($curso["3"], "71744", "Desenho Técnico Assistido por Computador", "DTAC", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["57"] = $m->cadeira($curso["3"], "84678", "Instrumentação e Metrologia", "IMetro", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["58"] = $m->cadeira($curso["3"], "64781", "Sistemas de Informação Geográfica", "SIGeo", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["59"] = $m->cadeira($curso["3"], "73458", "Cartografia", "Cart", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["60"] = $m->cadeira($curso["3"], "74211", "Ordenamento do Território e Urbanismo", "OTUrb", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["61"] = $m->cadeira($curso["3"], "71746", "Posicionamento Geospacial I", "PGeo-I", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["62"] = $m->cadeira($curso["3"], "71748", "Sistemas de Referência Espaciais", "SREsp", 2, "Descrição default.", "#ffb3ec");
    $cadeira["63"] = $m->cadeira($curso["3"], "86458", "Cadastro Predial", "CPre", 1, "Descrição default.", "#ffb3ec");
    $cadeira["64"] = $m->cadeira($curso["3"], "71744", "Deteção Remota e Processamento de Imagem", "DRPImag", 1, "Descrição default.", "#e6b3ff");
    $cadeira["65"] = $m->cadeira($curso["3"], "71741", "Geodesia Física", "GFis", 1, "Descrição default.", "#b3b3ff");
    $cadeira["66"] = $m->cadeira($curso["3"], "71746", "Posicionamento Geoespacial II", "PGeo-II", 1, "Descrição default.", "#99ebff");
    $cadeira["67"] = $m->cadeira($curso["3"], "76454", "Economia e Gestão", "EGes", 2, "Descrição default.", "#d5ff80");
    $cadeira["68"] = $m->cadeira($curso["3"], "71738", "Hidrografia", "Hidro", 2, "Descrição default.", "#80ffdf");
    $cadeira["69"] = $m->cadeira($curso["3"], "71753", "Métodos Óticos de Modelação 3D", "MOM3D", 2, "Descrição default.", "#ffff80");
    $cadeira["70"] = $m->cadeira($curso["3"], "71764", "Projeto de Engenharia Geoespacial", "PEGeo", 2, "Descrição default.", "#ffd480");
    
    // $cadeira["71"] = $m->cadeira($curso["4"], "26748", "Arquitetura de Sistemas Computacionais", "ASC", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["72"] = $m->cadeira($curso["4"], "13538", "Cálculo", "Calc", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["73"] = $m->cadeira($curso["4"], "26722", "Introdução à Programação", "IP", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["74"] = $m->cadeira($curso["4"], "13539", "Lógica de Primeira Ordem", "LPO", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["75"] = $m->cadeira($curso["4"], "26759", "Produção de Documentos Técnicos", "PDT", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["76"] = $m->cadeira($curso["4"], "26723", "Algoritmos e Estruturas de Dados", "AED", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["77"] = $m->cadeira($curso["4"], "13540", "Elementos de Álgebra Linear", "EAL", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["78"] = $m->cadeira($curso["4"], "34706", "Física A", "Fis-A", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["79"] = $m->cadeira($curso["4"], "34615", "Introdução às Probabilidades e Estatística", "IPE", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["80"] = $m->cadeira($curso["4"], "26724", "Laboratórios de Programação", "LP", 2, "Descrição default.", "#ffb3ec");
    $cadeira["81"] = $m->cadeira($curso["4"], "34707", "Física Experimental", "FExp", 1, "Descrição default.", "#ffb3ec");
    $cadeira["82"] = $m->cadeira($curso["4"], "44712", "Introdução à Investigação Operacional", "IIO", 1, "Descrição default.", "#e6b3ff");
    $cadeira["83"] = $m->cadeira($curso["4"], "26725", "Princípios de Programação", "PP", 1, "Descrição default.", "#b3b3ff");
    $cadeira["84"] = $m->cadeira($curso["4"], "26704", "Redes de Computadores", "RComp", 1, "Descrição default.", "#99ebff");
    $cadeira["85"] = $m->cadeira($curso["4"], "26726", "Sistemas de Informação e Bases de Dados", "SIBD", 1, "Descrição default.", "#80ffdf");
    $cadeira["86"] = $m->cadeira($curso["4"], "63485", "Desenvolvimento Centrado em Objetos", "DCO", 2, "Descrição default.", "#80ff80");
    $cadeira["87"] = $m->cadeira($curso["4"], "26749", "Interfaces Pessoa-Máquina", "IP-M", 2, "Descrição default.", "#d5ff80");
    $cadeira["88"] = $m->cadeira($curso["4"], "13528", "Matemática Discreta", "MDisc", 2, "Descrição default.", "#ffff80");
    $cadeira["89"] = $m->cadeira($curso["4"], "17645", "Pensamento Crítico", "PCrit", 2, "Descrição default.", "#ffd480");
    $cadeira["90"] = $m->cadeira($curso["4"], "26703", "Sistemas Operativos", "SO", 2, "Descrição default.", "#ffa8eb");
    // $cadeira["91"] = $m->cadeira($curso["4"], "26736", "Análise e Design de Sistemas de Informação", "ADSI", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["92"] = $m->cadeira($curso["4"], "26733", "Computação Gráfica", "CGraf", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["93"] = $m->cadeira($curso["4"], "26732", "Introdução à Inteligência Artificial", "IIA", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["94"] = $m->cadeira($curso["4"], "26730", "Sistemas Distribuídos", "SDist", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["95"] = $m->cadeira($curso["4"], "26737", "Teoria da Computação", "TC", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["96"] = $m->cadeira($curso["4"], "26750", "Construção de Sistemas de Software", "CSS", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["97"] = $m->cadeira($curso["4"], "26734", "Engenharia do Conhecimento", "EC", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["98"] = $m->cadeira($curso["4"], "26731", "Projeto de Sistemas de Informação", "PSI", 2, "Descrição default.", "#ffb3ec");
    // $cadeira["99"] = $m->cadeira($curso["4"], "26749", "Segurança e Confiabilidade", "SConf", 2, "Descrição default.", "#ffb3ec");
    
    #FBAUL
    $cadeira["100"] = $m->cadeira($curso["18"], "50123", "Artes Digitais", "ArDi", 1, "Descrição default.", "#ffb3ec");
    $cadeira["101"] = $m->cadeira($curso["18"], "50124", "Computação Multimedia", "CM", 1, "Descrição default.", "#e6b3ff");
    $cadeira["102"] = $m->cadeira($curso["18"], "50125", "Experiencia da Interação", "ExpInt", 1, "Descrição default.", "#b3b3ff");
    $cadeira["103"] = $m->cadeira($curso["18"], "50126", "Fotografia Experimental", "FExp", 1, "Descrição default.", "#99ebff");
    $cadeira["104"] = $m->cadeira($curso["18"], "50127", "Praticas do Som", "PS", 1, "Descrição default.", "#80ffdf");
    $cadeira["105"] = $m->cadeira($curso["18"], "50128", "Projeto Design", "PD", 1, "Descrição default.", "#80ff80");
    $cadeira["106"] = $m->cadeira($curso["18"], "50129", "Teoria da Imagem I", "TI-I", 1, "Descrição default.", "#d5ff80");
    $cadeira["107"] = $m->cadeira($curso["18"], "50130", "Animação Digital", "AD", 1, "Descrição default.", "#ffff80");
    $cadeira["108"] = $m->cadeira($curso["18"], "50131", "Animação e Movimento", "AM", 1, "Descrição default.", "#ffd480");
    $cadeira["109"] = $m->cadeira($curso["18"], "50132", "Cultura Visual", "CV", 1, "Descrição default.", "#ffa8eb");
    $cadeira["110"] = $m->cadeira($curso["19"], "50123", "Historia da Arte I", "HA-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["111"] = $m->cadeira($curso["19"], "50124", "Historia e Teoria da Museologia", "HTM", 1, "Descrição default.", "#e6b3ff");
    $cadeira["112"] = $m->cadeira($curso["19"], "50125", "Teorias da Arte", "TA", 1, "Descrição default.", "#b3b3ff");
    $cadeira["113"] = $m->cadeira($curso["19"], "50126", "Desenho I", "Des-I", 1, "Descrição default.", "#99ebff");
    $cadeira["114"] = $m->cadeira($curso["19"], "50127", "Geometria I", "Geo-I", 1, "Descrição default.", "#80ffdf");
    $cadeira["115"] = $m->cadeira($curso["19"], "50128", "Estética I", "Est-I", 1, "Descrição default.", "#80ff80");
    $cadeira["116"] = $m->cadeira($curso["19"], "50129", "Museologia e Curadoria", "MC", 1, "Descrição default.", "#d5ff80");
    $cadeira["117"] = $m->cadeira($curso["19"], "50130", "Design Museográfico", "DM", 1, "Descrição default.", "#ffff80");
    $cadeira["118"] = $m->cadeira($curso["19"], "50131", "Historia e Teoria do Restauro", "HTR", 1, "Descrição default.", "#ffd480");
    $cadeira["119"] = $m->cadeira($curso["19"], "50132", "Teoria da Escultura Portuguesa", "TEP", 1, "Descrição default.", "#ffa8eb");

    $cadeira["120"] = $m->cadeira($curso["18"], "50123", "Estudos dos Media", "EM", 2, "Descrição default.", "#ffb3ec");
    $cadeira["121"] = $m->cadeira($curso["18"], "50124", "Fotografia", "Fot", 2, "Descrição default.", "#e6b3ff");
    $cadeira["122"] = $m->cadeira($curso["18"], "50125", "Imagem em Movimento", "IM", 2, "Descrição default.", "#b3b3ff");
    $cadeira["123"] = $m->cadeira($curso["18"], "50126", "Metodologia Projetual Multimedia", "MPM", 2, "Descrição default.", "#99ebff");
    $cadeira["124"] = $m->cadeira($curso["18"], "50127", "Teoria da Imagem II", "TI-II", 2, "Descrição default.", "#80ffdf");
    $cadeira["125"] = $m->cadeira($curso["18"], "50128", "Desenho de Património", "DP", 2, "Descrição default.", "#80ff80");
    $cadeira["126"] = $m->cadeira($curso["18"], "50129", "Animação e Narrativa", "AN", 2, "Descrição default.", "#d5ff80");
    $cadeira["127"] = $m->cadeira($curso["18"], "50130", "Audiovisuais", "AV", 2, "Descrição default.", "#ffff80");
    $cadeira["128"] = $m->cadeira($curso["18"], "50131", "Sistemas Interativos", "SI", 2, "Descrição default.", "#ffd480");
    $cadeira["129"] = $m->cadeira($curso["18"], "50132", "Performance", "P", 2, "Descrição default.", "#ffa8eb");
    $cadeira["130"] = $m->cadeira($curso["18"], "50123", "Historia da Arte II", "HA-II", 2, "Descrição default.", "#ffb3ec");
    $cadeira["131"] = $m->cadeira($curso["18"], "50124", "Artes e Humanidades", "AH", 2, "Descrição default.", "#e6b3ff");
    $cadeira["132"] = $m->cadeira($curso["18"], "50125", "Museologia e Conservação", "MC", 2, "Descrição default.", "#b3b3ff");
    $cadeira["133"] = $m->cadeira($curso["18"], "50126", "Desenho de Patrimonio", "DP", 2, "Descrição default.", "#99ebff");
    $cadeira["134"] = $m->cadeira($curso["18"], "50127", "Materiais, Técnicas e Diagnóstico", "MTD", 2, "Descrição default.", "#80ffdf");
    $cadeira["135"] = $m->cadeira($curso["18"], "50128", "Historia da Arte Portuguesa", "HAT", 2, "Descrição default.", "#80ff80");
    $cadeira["136"] = $m->cadeira($curso["18"], "50129", "Desenho I", "Des-II", 2, "Descrição default.", "#d5ff80");
    $cadeira["137"] = $m->cadeira($curso["18"], "50130", "Geometria I", "Geo-II", 2, "Descrição default.", "#ffff80");
    $cadeira["138"] = $m->cadeira($curso["18"], "50131", "Estética I", "Est-II", 2, "Descrição default.", "#ffd480");
    $cadeira["139"] = $m->cadeira($curso["18"], "50132", "Patrimonio e Arqueologia", "PA", 2, "Descrição default.", "#ffa8eb");



    $aula = array();
    $aula["1"] = $m->aula($cadeira["1"], "PL", "10:30", "12:00", 1, "1.3.24");
    $aula["2"] = $m->aula($cadeira["1"], "T", "10:00", "12:00", 2, "6.3.24");
    $aula["3"] = $m->aula($cadeira["1"], "TP", "15:30", "17:00", 3, "3.4.52");
    $aula["4"] = $m->aula($cadeira["2"], "PL", "16:30", "18:00", 2, "3.2.12");
    $aula["5"] = $m->aula($cadeira["2"], "T", "08:00", "9:30", 4, "8.1.12");
    $aula["6"] = $m->aula($cadeira["3"], "PL", "12:00", "13:00", 1, "1.3.27");
    $aula["7"] = $m->aula($cadeira["3"], "T", "09:00", "12:00", 2, "6.4.24");
    $aula["8"] = $m->aula($cadeira["4"], "TP", "17:30", "19:00", 3, "2.4.53");
    $aula["9"] = $m->aula($cadeira["4"], "PL", "17:30", "19:00", 2, "3.4.12");
    $aula["10"] = $m->aula($cadeira["4"], "T", "09:00", "11:30", 4, "8.1.14");
    $aula["11"] = $m->aula($cadeira["5"], "PL", "13:30", "16:00", 1, "1.3.24");
    $aula["12"] = $m->aula($cadeira["5"], "T", "08:00", "09:00", 2, "6.3.44");
    $aula["13"] = $m->aula($cadeira["5"], "TP", "14:30", "16:00", 3, "3.2.52");
    $aula["14"] = $m->aula($cadeira["6"], "PL", "14:30", "18:00", 2, "1.2.28");
    $aula["15"] = $m->aula($cadeira["6"], "T", "08:00", "9:30", 4, "3.1.07");
    $aula["16"] = $m->aula($cadeira["7"], "PL", "09:30", "12:00", 1, "1.4.24");
    $aula["17"] = $m->aula($cadeira["8"], "T", "15:00", "17:00", 2, "4.5.24");
    $aula["18"] = $m->aula($cadeira["9"], "TP", "15:30", "19:00", 3, "3.1.34");
    $aula["19"] = $m->aula($cadeira["10"], "PL", "15:30", "17:00", 2, "3.2.27");
    $aula["20"] = $m->aula($cadeira["11"], "T", "09:00", "11:30", 4, "4.1.21");

    $aula["21"] = $m->aula($cadeira["34"], "PL", "10:30", "12:00", 1, "1.3.24");
    $aula["22"] = $m->aula($cadeira["36"], "T", "10:00", "12:00", 2, "6.3.24");
    $aula["23"] = $m->aula($cadeira["35"], "TP", "15:30", "17:00", 3, "3.4.52");
    $aula["24"] = $m->aula($cadeira["34"], "PL", "16:30", "18:00", 2, "3.2.12");
    $aula["25"] = $m->aula($cadeira["35"], "T", "08:00", "9:30", 4, "8.1.12");
    $aula["26"] = $m->aula($cadeira["37"], "PL", "12:00", "13:00", 1, "1.3.27");
    $aula["27"] = $m->aula($cadeira["35"], "T", "09:00", "12:00", 2, "6.4.24");
    $aula["28"] = $m->aula($cadeira["38"], "TP", "17:30", "19:00", 3, "2.4.53");
    $aula["29"] = $m->aula($cadeira["37"], "PL", "17:30", "19:00", 2, "3.4.12");
    $aula["30"] = $m->aula($cadeira["39"], "T", "09:00", "11:30", 4, "8.1.14");
    $aula["31"] = $m->aula($cadeira["40"], "PL", "13:30", "16:00", 1, "1.3.24");
    $aula["32"] = $m->aula($cadeira["38"], "T", "08:00", "09:00", 2, "6.3.44");
    $aula["33"] = $m->aula($cadeira["34"], "TP", "14:30", "16:00", 3, "3.2.52");
    $aula["34"] = $m->aula($cadeira["39"], "PL", "14:30", "18:00", 2, "1.2.28");
    $aula["35"] = $m->aula($cadeira["36"], "T", "08:00", "9:30", 4, "3.1.07");
    $aula["36"] = $m->aula($cadeira["42"], "PL", "09:30", "12:00", 1, "1.4.24");
    $aula["37"] = $m->aula($cadeira["43"], "T", "15:00", "17:00", 2, "4.5.24");
    $aula["38"] = $m->aula($cadeira["43"], "TP", "15:30", "19:00", 3, "3.1.34");
    $aula["39"] = $m->aula($cadeira["41"], "PL", "15:30", "17:00", 2, "3.2.27");
    $aula["40"] = $m->aula($cadeira["43"], "T", "09:00", "11:30", 4, "4.1.21");

    $aula["41"] = $m->aula($cadeira["63"], "PL", "10:30", "12:00", 1, "1.3.24");
    $aula["42"] = $m->aula($cadeira["66"], "T", "10:00", "12:00", 2, "6.3.24");
    $aula["43"] = $m->aula($cadeira["65"], "TP", "15:30", "17:00", 3, "3.4.52");
    $aula["44"] = $m->aula($cadeira["64"], "PL", "16:30", "18:00", 2, "3.2.12");
    $aula["45"] = $m->aula($cadeira["66"], "T", "08:00", "9:30", 4, "8.1.12");
    $aula["46"] = $m->aula($cadeira["64"], "PL", "12:00", "13:00", 1, "1.3.27");
    $aula["47"] = $m->aula($cadeira["67"], "T", "09:00", "12:00", 2, "6.4.24");
    $aula["48"] = $m->aula($cadeira["68"], "TP", "17:30", "19:00", 3, "2.4.53");
    $aula["49"] = $m->aula($cadeira["65"], "PL", "17:30", "19:00", 2, "3.4.12");
    $aula["50"] = $m->aula($cadeira["69"], "T", "09:00", "11:30", 4, "8.1.14");
    $aula["51"] = $m->aula($cadeira["69"], "PL", "13:30", "16:00", 1, "1.3.24");
    $aula["52"] = $m->aula($cadeira["63"], "T", "08:00", "09:00", 2, "6.3.44");
    $aula["53"] = $m->aula($cadeira["68"], "TP", "14:30", "16:00", 3, "3.2.52");
    $aula["54"] = $m->aula($cadeira["65"], "PL", "14:30", "18:00", 2, "1.2.28");
    $aula["55"] = $m->aula($cadeira["66"], "T", "08:00", "9:30", 4, "3.1.07");
    $aula["56"] = $m->aula($cadeira["70"], "PL", "09:30", "12:00", 1, "1.4.24");
    $aula["57"] = $m->aula($cadeira["70"], "T", "15:00", "17:00", 2, "4.5.24");
    $aula["58"] = $m->aula($cadeira["70"], "TP", "15:30", "19:00", 3, "3.1.34");
    $aula["59"] = $m->aula($cadeira["69"], "PL", "15:30", "17:00", 2, "3.2.27");
    $aula["60"] = $m->aula($cadeira["67"], "T", "09:00", "11:30", 4, "4.1.21");

    $aula["61"] = $m->aula($cadeira["81"], "PL", "12:00", "13:30", 1, "1.3.24");
    $aula["62"] = $m->aula($cadeira["84"], "T", "10:00", "12:00", 2, "6.3.24");
    $aula["63"] = $m->aula($cadeira["83"], "TP", "15:30", "17:00", 3, "3.4.52");
    $aula["64"] = $m->aula($cadeira["85"], "PL", "16:30", "18:00", 2, "3.2.12");
    $aula["65"] = $m->aula($cadeira["82"], "T", "08:00", "9:30", 4, "8.1.12");
    $aula["66"] = $m->aula($cadeira["84"], "PL", "12:00", "13:00", 1, "1.3.27");
    $aula["67"] = $m->aula($cadeira["86"], "T", "09:00", "12:00", 2, "6.4.24");
    $aula["68"] = $m->aula($cadeira["87"], "TP", "17:30", "19:00", 3, "2.4.53");
    $aula["69"] = $m->aula($cadeira["86"], "PL", "18:00", "19:30", 2, "3.4.12");
    $aula["70"] = $m->aula($cadeira["87"], "T", "09:00", "11:30", 4, "8.1.14");
    $aula["71"] = $m->aula($cadeira["81"], "PL", "13:30", "16:00", 1, "1.3.24");
    $aula["72"] = $m->aula($cadeira["89"], "T", "08:00", "09:00", 2, "6.3.44");
    $aula["73"] = $m->aula($cadeira["88"], "TP", "14:30", "16:00", 3, "3.2.52");
    $aula["74"] = $m->aula($cadeira["89"], "PL", "14:30", "18:00", 2, "1.2.28");
    $aula["75"] = $m->aula($cadeira["89"], "T", "08:00", "9:30", 4, "3.1.07");
    $aula["76"] = $m->aula($cadeira["90"], "PL", "09:30", "12:00", 1, "1.4.24");
    $aula["77"] = $m->aula($cadeira["83"], "T", "15:00", "17:00", 2, "4.5.24");
    $aula["78"] = $m->aula($cadeira["85"], "TP", "15:30", "19:00", 3, "3.1.34");
    $aula["79"] = $m->aula($cadeira["90"], "PL", "15:30", "17:00", 2, "3.2.27");
    $aula["80"] = $m->aula($cadeira["90"], "T", "09:00", "11:30", 4, "4.1.21");

    $aula["81"] = $m->aula($cadeira["100"], "TP", "8:00", "10:00", 1, "120");
    $aula["82"] = $m->aula($cadeira["100"], "T", "10:00", "12:00", 1, "132");
    $aula["83"] = $m->aula($cadeira["101"], "TP", "15:00", "17:00", 1, "121");
    $aula["84"] = $m->aula($cadeira["101"], "T", "16:00", "18:00", 1, "125");
    $aula["85"] = $m->aula($cadeira["102"], "T", "08:00", "11:00", 1, "112");
    $aula["86"] = $m->aula($cadeira["102"], "TP", "12:00", "14:00", 1, "111");
    $aula["87"] = $m->aula($cadeira["103"], "T", "09:00", "12:00", 1, "012");
    $aula["88"] = $m->aula($cadeira["103"], "TP", "17:00", "19:00", 2, "321");
    $aula["89"] = $m->aula($cadeira["104"], "T", "17:30", "19:30", 2, "412");
    $aula["90"] = $m->aula($cadeira["105"], "T", "09:00", "12:00", 2, "415");
    $aula["91"] = $m->aula($cadeira["106"], "T", "13:30", "16:30", 2, "418");
    $aula["92"] = $m->aula($cadeira["106"], "T", "08:30", "10:30", 2, "118");
    $aula["93"] = $m->aula($cadeira["107"], "TP", "14:30", "16:30", 2, "218");
    $aula["94"] = $m->aula($cadeira["107"], "T", "14:30", "17:30", 3, "219");
    $aula["95"] = $m->aula($cadeira["108"], "T", "08:00", "9:30", 3, "319");
    $aula["96"] = $m->aula($cadeira["109"], "T", "09:30", "12:00", 3, "413");
    $aula["97"] = $m->aula($cadeira["110"], "T", "15:00", "17:00", 3, "415");
    $aula["98"] = $m->aula($cadeira["110"], "TP", "15:30", "19:00", 3, "334");
    $aula["99"] = $m->aula($cadeira["111"], "T", "15:30", "17:00", 3, "327");
    $aula["100"] = $m->aula($cadeira["112"], "T", "09:00", "11:30", 3, "421");
    $aula["101"] = $m->aula($cadeira["113"], "TP", "12:00", "13:30", 4, "124");
    $aula["102"] = $m->aula($cadeira["113"], "T", "10:00", "12:00", 4, "324");
    $aula["103"] = $m->aula($cadeira["114"], "TP", "15:30", "17:00", 4, "302");
    $aula["104"] = $m->aula($cadeira["115"], "T", "16:30", "18:00", 4, "312");
    $aula["105"] = $m->aula($cadeira["116"], "T", "08:00", "9:30", 4, "222");
    $aula["106"] = $m->aula($cadeira["117"], "TP", "12:00", "13:00", 4, "127");
    $aula["107"] = $m->aula($cadeira["118"], "T", "09:00", "12:00", 5, "124");
    $aula["108"] = $m->aula($cadeira["118"], "TP", "17:30", "19:00", 5, "203");
    $aula["109"] = $m->aula($cadeira["119"], "T", "18:00", "19:30", 5, "322");

    $aula["110"] = $m->aula($cadeira["120"], "T", "09:00", "11:30", 1, "214");
    $aula["111"] = $m->aula($cadeira["121"], "T", "13:30", "16:00", 1, "124");
    $aula["112"] = $m->aula($cadeira["122"], "T", "08:00", "09:00", 1, "234");
    $aula["113"] = $m->aula($cadeira["122"], "TP", "14:30", "16:00", 1, "322");
    $aula["114"] = $m->aula($cadeira["123"], "TP", "14:30", "18:00", 1, "428");
    $aula["115"] = $m->aula($cadeira["123"], "T", "08:00", "9:30", 1, "417");
    $aula["116"] = $m->aula($cadeira["124"], "T", "09:30", "12:00", 1, "424");
    $aula["117"] = $m->aula($cadeira["125"], "T", "15:00", "17:00", 1, "424");
    $aula["118"] = $m->aula($cadeira["125"], "TP", "15:30", "19:00", 2, "334");
    $aula["119"] = $m->aula($cadeira["126"], "T", "15:30", "17:00", 2, "323");
    $aula["120"] = $m->aula($cadeira["127"], "T", "09:00", "11:30", 2, "411");
    $aula["101"] = $m->aula($cadeira["128"], "TP", "12:00", "13:30", 2, "125");
    $aula["102"] = $m->aula($cadeira["128"], "T", "10:00", "12:00", 2, "325");
    $aula["103"] = $m->aula($cadeira["129"], "TP", "15:30", "17:00", 2, "305");
    $aula["104"] = $m->aula($cadeira["129"], "T", "16:30", "18:00", 3, "314");
    $aula["105"] = $m->aula($cadeira["130"], "T", "08:00", "9:30", 3, "225");
    $aula["106"] = $m->aula($cadeira["131"], "TP", "12:00", "13:00", 3, "128");
    $aula["107"] = $m->aula($cadeira["131"], "T", "09:00", "12:00", 3, "111");
    $aula["108"] = $m->aula($cadeira["132"], "TP", "17:30", "19:00", 3, "209");
    $aula["109"] = $m->aula($cadeira["132"], "T", "18:00", "19:30", 3, "132");
    $aula["110"] = $m->aula($cadeira["133"], "T", "09:00", "11:30", 3, "227");
    $aula["111"] = $m->aula($cadeira["133"], "T", "13:30", "16:00", 3, "129");
    $aula["112"] = $m->aula($cadeira["133"], "T", "08:00", "09:00", 4, "239");
    $aula["113"] = $m->aula($cadeira["133"], "TP", "14:30", "16:00", 4, "329");
    $aula["114"] = $m->aula($cadeira["134"], "TP", "14:30", "18:00", 4, "412");
    $aula["115"] = $m->aula($cadeira["134"], "T", "08:00", "9:30", 4, "431");
    $aula["116"] = $m->aula($cadeira["135"], "T", "09:30", "12:00", 4, "429");
    $aula["117"] = $m->aula($cadeira["136"], "T", "15:00", "17:00", 4, "420");
    $aula["118"] = $m->aula($cadeira["137"], "TP", "15:30", "19:00", 5, "330");
    $aula["119"] = $m->aula($cadeira["137"], "T", "15:30", "17:00", 5, "325");
    $aula["120"] = $m->aula($cadeira["138"], "T", "09:00", "11:30", 5, "410");
    $aula["120"] = $m->aula($cadeira["139"], "T", "14:00", "16:00", 5, "410");

    $m->batch("aluno_curso", Array(
      Array("user_id"=> $aluno["199"], "curso_id"=>$curso["1"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["198"], "curso_id"=>$curso["1"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["213"], "curso_id"=>$curso["1"], "data_entrada"=>"2018"),
      Array("user_id"=> $aluno["214"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["194"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["183"], "curso_id"=>$curso["2"], "data_entrada"=>"2020"),
      Array("user_id"=> $aluno["160"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["127"], "curso_id"=>$curso["3"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["119"], "curso_id"=>$curso["3"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["114"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["96"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["47"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["14"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["4"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),

      Array("user_id"=> $aluno["31"], "curso_id"=>$curso["1"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["42"], "curso_id"=>$curso["1"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["61"], "curso_id"=>$curso["1"], "data_entrada"=>"2018"),
      Array("user_id"=> $aluno["78"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["90"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["98"], "curso_id"=>$curso["2"], "data_entrada"=>"2020"),
      Array("user_id"=> $aluno["117"], "curso_id"=>$curso["2"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["133"], "curso_id"=>$curso["3"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["143"], "curso_id"=>$curso["3"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["164"], "curso_id"=>$curso["3"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["176"], "curso_id"=>$curso["3"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["188"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),
      Array("user_id"=> $aluno["206"], "curso_id"=>$curso["4"], "data_entrada"=>"2019"),
    ));
  
    $m->batch("aluno_cadeira", Array(
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["199"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["198"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["213"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["31"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["42"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["1"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["2"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["3"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["4"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["5"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["6"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["7"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["8"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["9"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["10"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["61"], "cadeira_id"=>$cadeira["11"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["214"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["194"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["183"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["160"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["78"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["90"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["98"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["117"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["63"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["64"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["65"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["66"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["67"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["68"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["69"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["127"], "cadeira_id"=>$cadeira["70"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["119"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["133"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["143"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["164"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["34"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["35"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["36"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["37"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["38"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["39"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["40"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["41"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["42"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      // Array("user_id"=> $aluno["176"], "cadeira_id"=>$cadeira["43"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["114"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["96"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["47"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["14"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["4"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["188"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["81"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["82"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["83"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["84"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["85"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["86"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["87"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["88"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["89"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
      Array("user_id"=> $aluno["206"], "cadeira_id"=>$cadeira["90"], "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),

    ));    

    $m->batch("professor_cadeira", Array(
      Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["1"]),
      Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["2"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["3"]),
      Array("user_id"=> $prof["11"], "cadeira_id"=>$cadeira["3"]),
      Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["4"]),
      Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["5"]),
      Array("user_id"=> $prof["5"], "cadeira_id"=>$cadeira["6"]),
      Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["6"]),
      Array("user_id"=> $prof["4"], "cadeira_id"=>$cadeira["7"]),
      Array("user_id"=> $prof["6"], "cadeira_id"=>$cadeira["8"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["9"]),
      Array("user_id"=> $prof["11"], "cadeira_id"=>$cadeira["9"]),
      Array("user_id"=> $prof["9"], "cadeira_id"=>$cadeira["10"]),
      Array("user_id"=> $prof["6"], "cadeira_id"=>$cadeira["11"]),

      Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["34"]),
      Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["35"]),
      Array("user_id"=> $prof["13"], "cadeira_id"=>$cadeira["35"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["36"]),
      Array("user_id"=> $prof["5"], "cadeira_id"=>$cadeira["37"]),
      Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["37"]),
      Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["38"]),
      Array("user_id"=> $prof["6"], "cadeira_id"=>$cadeira["39"]),
      Array("user_id"=> $prof["5"], "cadeira_id"=>$cadeira["40"]),
      Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["40"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["41"]),
      Array("user_id"=> $prof["9"], "cadeira_id"=>$cadeira["42"]),
      Array("user_id"=> $prof["12"], "cadeira_id"=>$cadeira["42"]),
      Array("user_id"=> $prof["8"], "cadeira_id"=>$cadeira["43"]),

      Array("user_id"=> $prof["7"], "cadeira_id"=>$cadeira["63"]),
      Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["64"]),
      Array("user_id"=> $prof["5"], "cadeira_id"=>$cadeira["65"]),
      Array("user_id"=> $prof["13"], "cadeira_id"=>$cadeira["65"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["66"]),
      Array("user_id"=> $prof["12"], "cadeira_id"=>$cadeira["66"]),
      Array("user_id"=> $prof["8"], "cadeira_id"=>$cadeira["67"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["68"]),
      Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["68"]),
      Array("user_id"=> $prof["3"], "cadeira_id"=>$cadeira["69"]),
      Array("user_id"=> $prof["12"], "cadeira_id"=>$cadeira["69"]),
      Array("user_id"=> $prof["8"], "cadeira_id"=>$cadeira["70"]),

      Array("user_id"=> $prof["7"], "cadeira_id"=>$cadeira["81"]),
      Array("user_id"=> $prof["4"], "cadeira_id"=>$cadeira["82"]),
      Array("user_id"=> $prof["7"], "cadeira_id"=>$cadeira["83"]),
      Array("user_id"=> $prof["12"], "cadeira_id"=>$cadeira["83"]),
      Array("user_id"=> $prof["4"], "cadeira_id"=>$cadeira["84"]),
      Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["84"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["85"]),
      Array("user_id"=> $prof["2"], "cadeira_id"=>$cadeira["86"]),
      Array("user_id"=> $prof["13"], "cadeira_id"=>$cadeira["86"]),
      Array("user_id"=> $prof["7"], "cadeira_id"=>$cadeira["87"]),
      Array("user_id"=> $prof["8"], "cadeira_id"=>$cadeira["88"]),
      Array("user_id"=> $prof["8"], "cadeira_id"=>$cadeira["89"]),
      Array("user_id"=> $prof["13"], "cadeira_id"=>$cadeira["89"]),
      Array("user_id"=> $prof["10"], "cadeira_id"=>$cadeira["90"]),
      Array("user_id"=> $prof["11"], "cadeira_id"=>$cadeira["90"]),
      Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["28"]),
      Array("user_id"=> $prof["1"], "cadeira_id"=>$cadeira["24"]),


    ));

    $m->batch("aluno_aula", Array(
      // Array("user_id"=> $aluno["199"], "aula_id"=>$aula["1"]),
      // Array("user_id"=> $aluno["199"], "aula_id"=>$aula["2"]),
      // Array("user_id"=> $aluno["198"], "aula_id"=>$aula["3"]),
      // Array("user_id"=> $aluno["198"], "aula_id"=>$aula["4"]),
      // Array("user_id"=> $aluno["213"], "aula_id"=>$aula["5"]),
      // Array("user_id"=> $aluno["198"], "aula_id"=>$aula["5"]),
      // Array("user_id"=> $aluno["213"], "aula_id"=>$aula["6"]),
      // Array("user_id"=> $aluno["213"], "aula_id"=>$aula["7"]),
      // Array("user_id"=> $aluno["213"], "aula_id"=>$aula["8"]),
      // Array("user_id"=> $aluno["31"], "aula_id"=>$aula["8"]),
      // Array("user_id"=> $aluno["31"], "aula_id"=>$aula["5"]),
      // Array("user_id"=> $aluno["31"], "aula_id"=>$aula["9"]),
      // Array("user_id"=> $aluno["42"], "aula_id"=>$aula["10"]),
      // Array("user_id"=> $aluno["42"], "aula_id"=>$aula["11"]),
      // Array("user_id"=> $aluno["213"], "aula_id"=>$aula["11"]),
      // Array("user_id"=> $aluno["42"], "aula_id"=>$aula["12"]),
      // Array("user_id"=> $aluno["61"], "aula_id"=>$aula["13"]),
      // Array("user_id"=> $aluno["61"], "aula_id"=>$aula["14"]),
      // Array("user_id"=> $aluno["61"], "aula_id"=>$aula["15"]),
      // Array("user_id"=> $aluno["213"], "aula_id"=>$aula["16"]),
      // Array("user_id"=> $aluno["61"], "aula_id"=>$aula["16"]),
      // Array("user_id"=> $aluno["199"], "aula_id"=>$aula["17"]),
      // Array("user_id"=> $aluno["199"], "aula_id"=>$aula["18"]),
      // Array("user_id"=> $aluno["199"], "aula_id"=>$aula["19"]),
      // Array("user_id"=> $aluno["198"], "aula_id"=>$aula["20"]),

      // Array("user_id"=> $aluno["214"], "aula_id"=>$aula["21"]),
      // Array("user_id"=> $aluno["214"], "aula_id"=>$aula["22"]),
      // Array("user_id"=> $aluno["194"], "aula_id"=>$aula["23"]),
      // Array("user_id"=> $aluno["194"], "aula_id"=>$aula["24"]),
      // Array("user_id"=> $aluno["183"], "aula_id"=>$aula["25"]),
      // Array("user_id"=> $aluno["183"], "aula_id"=>$aula["25"]),
      // Array("user_id"=> $aluno["160"], "aula_id"=>$aula["26"]),
      // Array("user_id"=> $aluno["160"], "aula_id"=>$aula["27"]),
      // Array("user_id"=> $aluno["78"], "aula_id"=>$aula["28"]),
      // Array("user_id"=> $aluno["78"], "aula_id"=>$aula["28"]),
      // Array("user_id"=> $aluno["90"], "aula_id"=>$aula["25"]),
      // Array("user_id"=> $aluno["90"], "aula_id"=>$aula["29"]),
      // Array("user_id"=> $aluno["98"], "aula_id"=>$aula["30"]),
      // Array("user_id"=> $aluno["98"], "aula_id"=>$aula["31"]),
      // Array("user_id"=> $aluno["117"], "aula_id"=>$aula["31"]),
      // Array("user_id"=> $aluno["117"], "aula_id"=>$aula["32"]),
      // Array("user_id"=> $aluno["214"], "aula_id"=>$aula["33"]),
      // Array("user_id"=> $aluno["194"], "aula_id"=>$aula["34"]),
      // Array("user_id"=> $aluno["183"], "aula_id"=>$aula["35"]),
      // Array("user_id"=> $aluno["160"], "aula_id"=>$aula["36"]),
      // Array("user_id"=> $aluno["78"], "aula_id"=>$aula["36"]),
      // Array("user_id"=> $aluno["90"], "aula_id"=>$aula["37"]),
      // Array("user_id"=> $aluno["98"], "aula_id"=>$aula["38"]),
      // Array("user_id"=> $aluno["117"], "aula_id"=>$aula["39"]),
      // Array("user_id"=> $aluno["117"], "aula_id"=>$aula["40"]),

      // Array("user_id"=> $aluno["127"], "aula_id"=>$aula["41"]),
      // Array("user_id"=> $aluno["127"], "aula_id"=>$aula["42"]),
      // Array("user_id"=> $aluno["119"], "aula_id"=>$aula["43"]),
      // Array("user_id"=> $aluno["119"], "aula_id"=>$aula["44"]),
      // Array("user_id"=> $aluno["133"], "aula_id"=>$aula["45"]),
      // Array("user_id"=> $aluno["133"], "aula_id"=>$aula["45"]),
      // Array("user_id"=> $aluno["143"], "aula_id"=>$aula["46"]),
      // Array("user_id"=> $aluno["143"], "aula_id"=>$aula["47"]),
      // Array("user_id"=> $aluno["164"], "aula_id"=>$aula["48"]),
      // Array("user_id"=> $aluno["164"], "aula_id"=>$aula["48"]),
      // Array("user_id"=> $aluno["176"], "aula_id"=>$aula["45"]),
      // Array("user_id"=> $aluno["176"], "aula_id"=>$aula["49"]),
      // Array("user_id"=> $aluno["127"], "aula_id"=>$aula["50"]),
      // Array("user_id"=> $aluno["119"], "aula_id"=>$aula["51"]),
      // Array("user_id"=> $aluno["133"], "aula_id"=>$aula["51"]),
      // Array("user_id"=> $aluno["143"], "aula_id"=>$aula["52"]),
      // Array("user_id"=> $aluno["164"], "aula_id"=>$aula["53"]),
      // Array("user_id"=> $aluno["176"], "aula_id"=>$aula["54"]),
      // Array("user_id"=> $aluno["127"], "aula_id"=>$aula["55"]),
      // Array("user_id"=> $aluno["127"], "aula_id"=>$aula["56"]),
      // Array("user_id"=> $aluno["119"], "aula_id"=>$aula["56"]),
      // Array("user_id"=> $aluno["117"], "aula_id"=>$aula["57"]),
      // Array("user_id"=> $aluno["133"], "aula_id"=>$aula["58"]),
      // Array("user_id"=> $aluno["143"], "aula_id"=>$aula["59"]),
      // Array("user_id"=> $aluno["176"], "aula_id"=>$aula["60"]),

      Array("user_id"=> $aluno["114"], "aula_id"=>$aula["61"]),
      Array("user_id"=> $aluno["114"], "aula_id"=>$aula["62"]),
      Array("user_id"=> $aluno["96"], "aula_id"=>$aula["63"]),
      Array("user_id"=> $aluno["96"], "aula_id"=>$aula["64"]),
      Array("user_id"=> $aluno["47"], "aula_id"=>$aula["65"]),
      Array("user_id"=> $aluno["47"], "aula_id"=>$aula["65"]),
      Array("user_id"=> $aluno["14"], "aula_id"=>$aula["66"]),
      Array("user_id"=> $aluno["14"], "aula_id"=>$aula["67"]),
      Array("user_id"=> $aluno["4"], "aula_id"=>$aula["68"]),
      Array("user_id"=> $aluno["4"], "aula_id"=>$aula["68"]),
      Array("user_id"=> $aluno["188"], "aula_id"=>$aula["65"]),
      Array("user_id"=> $aluno["188"], "aula_id"=>$aula["69"]),
      Array("user_id"=> $aluno["114"], "aula_id"=>$aula["70"]),
      Array("user_id"=> $aluno["96"], "aula_id"=>$aula["71"]),
      Array("user_id"=> $aluno["47"], "aula_id"=>$aula["71"]),
      Array("user_id"=> $aluno["14"], "aula_id"=>$aula["72"]),
      Array("user_id"=> $aluno["4"], "aula_id"=>$aula["73"]),
      Array("user_id"=> $aluno["188"], "aula_id"=>$aula["74"]),
      Array("user_id"=> $aluno["206"], "aula_id"=>$aula["75"]),
      Array("user_id"=> $aluno["114"], "aula_id"=>$aula["76"]),
      Array("user_id"=> $aluno["96"], "aula_id"=>$aula["76"]),
      Array("user_id"=> $aluno["47"], "aula_id"=>$aula["77"]),
      Array("user_id"=> $aluno["14"], "aula_id"=>$aula["78"]),
      Array("user_id"=> $aluno["4"], "aula_id"=>$aula["79"]),
      Array("user_id"=> $aluno["4"], "aula_id"=>$aula["80"]),

    ));

    $m->batch("professor_aula", Array(
      // Array("user_id"=> $prof["1"], "aula_id"=>$aula["1"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["2"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["3"]),
      // Array("user_id"=> $prof["11"], "aula_id"=>$aula["4"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["5"]),
      // Array("user_id"=> $prof["10"], "aula_id"=>$aula["6"]),
      // Array("user_id"=> $prof["4"], "aula_id"=>$aula["7"]),
      // Array("user_id"=> $prof["6"], "aula_id"=>$aula["8"]),
      // Array("user_id"=> $prof["9"], "aula_id"=>$aula["9"]),
      // Array("user_id"=> $prof["1"], "aula_id"=>$aula["10"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["11"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["12"]),
      // Array("user_id"=> $prof["11"], "aula_id"=>$aula["13"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["14"]),
      // Array("user_id"=> $prof["10"], "aula_id"=>$aula["15"]),
      // Array("user_id"=> $prof["4"], "aula_id"=>$aula["16"]),
      // Array("user_id"=> $prof["6"], "aula_id"=>$aula["17"]),
      // Array("user_id"=> $prof["9"], "aula_id"=>$aula["18"]),
      // Array("user_id"=> $prof["1"], "aula_id"=>$aula["19"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["20"]),

      // Array("user_id"=> $prof["1"], "aula_id"=>$aula["21"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["22"]),
      // Array("user_id"=> $prof["13"], "aula_id"=>$aula["23"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["24"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["25"]),
      // Array("user_id"=> $prof["10"], "aula_id"=>$aula["26"]),
      // Array("user_id"=> $prof["6"], "aula_id"=>$aula["27"]),
      // Array("user_id"=> $prof["9"], "aula_id"=>$aula["28"]),
      // Array("user_id"=> $prof["12"], "aula_id"=>$aula["29"]),
      // Array("user_id"=> $prof["8"], "aula_id"=>$aula["30"]),
      // Array("user_id"=> $prof["1"], "aula_id"=>$aula["31"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["32"]),
      // Array("user_id"=> $prof["13"], "aula_id"=>$aula["33"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["34"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["35"]),
      // Array("user_id"=> $prof["10"], "aula_id"=>$aula["36"]),
      // Array("user_id"=> $prof["6"], "aula_id"=>$aula["37"]),
      // Array("user_id"=> $prof["9"], "aula_id"=>$aula["38"]),
      // Array("user_id"=> $prof["12"], "aula_id"=>$aula["39"]),
      // Array("user_id"=> $prof["8"], "aula_id"=>$aula["40"]),

      // Array("user_id"=> $prof["7"], "aula_id"=>$aula["41"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["42"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["43"]),
      // Array("user_id"=> $prof["13"], "aula_id"=>$aula["44"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["45"]),
      // Array("user_id"=> $prof["12"], "aula_id"=>$aula["46"]),
      // Array("user_id"=> $prof["8"], "aula_id"=>$aula["47"]),
      // Array("user_id"=> $prof["10"], "aula_id"=>$aula["48"]),
      // Array("user_id"=> $prof["7"], "aula_id"=>$aula["49"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["50"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["51"]),
      // Array("user_id"=> $prof["13"], "aula_id"=>$aula["52"]),
      // Array("user_id"=> $prof["2"], "aula_id"=>$aula["53"]),
      // Array("user_id"=> $prof["12"], "aula_id"=>$aula["54"]),
      // Array("user_id"=> $prof["8"], "aula_id"=>$aula["55"]),
      // Array("user_id"=> $prof["10"], "aula_id"=>$aula["56"]),
      // Array("user_id"=> $prof["7"], "aula_id"=>$aula["57"]),
      // Array("user_id"=> $prof["3"], "aula_id"=>$aula["58"]),
      // Array("user_id"=> $prof["5"], "aula_id"=>$aula["59"]),
      // Array("user_id"=> $prof["13"], "aula_id"=>$aula["60"]),

      Array("user_id"=> $prof["7"], "aula_id"=>$aula["61"]),
      Array("user_id"=> $prof["4"], "aula_id"=>$aula["62"]),
      Array("user_id"=> $prof["12"], "aula_id"=>$aula["63"]),
      Array("user_id"=> $prof["10"], "aula_id"=>$aula["64"]),
      Array("user_id"=> $prof["2"], "aula_id"=>$aula["65"]),
      Array("user_id"=> $prof["13"], "aula_id"=>$aula["66"]),
      Array("user_id"=> $prof["8"], "aula_id"=>$aula["67"]),
      Array("user_id"=> $prof["11"], "aula_id"=>$aula["68"]),
      Array("user_id"=> $prof["7"], "aula_id"=>$aula["69"]),
      Array("user_id"=> $prof["4"], "aula_id"=>$aula["70"]),
      Array("user_id"=> $prof["12"], "aula_id"=>$aula["71"]),
      Array("user_id"=> $prof["10"], "aula_id"=>$aula["72"]),
      Array("user_id"=> $prof["2"], "aula_id"=>$aula["73"]),
      Array("user_id"=> $prof["13"], "aula_id"=>$aula["74"]),
      Array("user_id"=> $prof["8"], "aula_id"=>$aula["75"]),
      Array("user_id"=> $prof["11"], "aula_id"=>$aula["76"]),
      Array("user_id"=> $prof["7"], "aula_id"=>$aula["77"]),
      Array("user_id"=> $prof["4"], "aula_id"=>$aula["78"]),
      Array("user_id"=> $prof["12"], "aula_id"=>$aula["79"]),
      Array("user_id"=> $prof["10"], "aula_id"=>$aula["80"]),
    
    ));

    $forum = array();
    $forum["1"] = $m->forum($cadeira["1"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    $forum["2"] = $m->forum($cadeira["2"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);
    $forum["3"] = $m->forum($cadeira["34"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    $forum["4"] = $m->forum($cadeira["35"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);
    $forum["5"] = $m->forum($cadeira["63"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    $forum["6"] = $m->forum($cadeira["64"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);
    $forum["7"] = $m->forum($cadeira["83"], "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);
    $forum["8"] = $m->forum($cadeira["83"], "Fórum de Dúvidas", "Fórum para comunicação entre alunos e professores.", 0);


    $thread = array();
    $thread["1"] = $m->thread($prof["1"], $forum["1"], "Avaliação da cadeira", "Testes e 3 projetos ao longo do semestre", "2020-05-13 11:00:00");
    $thread["2"] = $m->thread($prof["1"], $forum["3"], "Avaliação da cadeira", "Testes ao longo do semestre", "2020-04-13 11:00:00");
    $thread["3"] = $m->thread($prof["7"], $forum["5"], "Avaliação da cadeira", "3 projetos ao longo do semestre", "2020-05-13 11:00:00");
    $thread["4"] = $m->thread($prof["7"], $forum["7"], "Avaliação da cadeira", "Exame final e 5 projetos ao longo do semestre", "2020-04-13 11:00:00");
    $thread["5"] = $m->thread($prof["7"], $forum["8"], "Dúvidas", "Dúvidas expostas pelos alunos", "2020-04-13 11:00:00");


    $thread_post = array();
    $thread_post["1"] = $m->thread_post($thread["1"], $prof["1"], "Testes e 3 projetos ao longo do semestre", "2020-05-13 11:00:00");
    $thread_post["2"] = $m->thread_post($thread["2"], $prof["1"], "Testes ao longo do semestre", "2020-05-13 11:00:00");
    $thread_post["3"] = $m->thread_post($thread["3"], $prof["7"], "3 projetos ao longo do semestre", "2020-04-13 11:00:00");
    $thread_post["4"] = $m->thread_post($thread["4"], $prof["7"], "Exame final e 5 projetos ao longo do semestre", "2020-05-13 11:00:00");

    
    $projeto = array();
    $projeto["1"] = $m->projeto($cadeira["1"], "Evolução da Ciência", "Relatório sobre a seleção natural.", 1, 2, "");
    $projeto["2"] = $m->projeto($cadeira["63"], "Cadastro Predial do Município", "Fazer um relatório onde exploram o cadastro predial do vosso município.", 1, 2, "");
    $projeto["3"] = $m->projeto($cadeira["83"], "Spotipy em Haskell", "Implementem o Spotipy em Haskell.", 1, 2, "");
    $projeto["4"] = $m->projeto($cadeira["88"], "A matemática na natureza", "Os objetivos deste projeto são óbvios, no need to describe them.", 1, 3, "");
    $projeto["5"] = $m->projeto($cadeira["88"], "Projeto Final", "Os objetivos deste projeto não são tão óbvios.", 1, 3, "");

    $etapa = array();
    $etapa["1"] = $m->etapa($projeto["3"], "2020-06-06 23:00:00", "", "Pesquisa", "Façam pesquisa sobre o Spotipy.");
    $etapa["2"] = $m->etapa($projeto["3"], "2020-05-06 23:00:00", "", "Planeamento", "Façam pesquisa sobre como programar em Haskell.");
    $etapa["3"] = $m->etapa($projeto["3"], "2020-07-21 23:55:00", "", "Implementação", "Implementar o Spotipy em Haskell.");
    $etapa["4"] = $m->etapa($projeto["1"], "2020-06-06 23:00:00", "", "Pesquisa", "Pesquisar sobre Charles Darwin.");
    $etapa["5"] = $m->etapa($projeto["1"], "2020-06-21 23:55:00", "", "Implementação", "Fazer relatório.");
    $etapa["6"] = $m->etapa($projeto["2"], "2020-06-06 23:00:00", "", "Pesquisa", "Procurar cadástro de Almada.");
    $etapa["7"] = $m->etapa($projeto["2"], "2020-06-21 23:55:00", "", "Implementação", "Fazer relatório.");
    $etapa["8"] = $m->etapa($projeto["4"], "2020-05-21 23:55:00", "", "Fazer continhas", "Esta etapa já acabou.");
    $etapa["9"] = $m->etapa($projeto["5"], "2020-06-21 23:55:00", "", "Fazer continhas outra vez", "Esta etapa ainda não acabou.");

    $grupo = array();
    $grupo["1"] = $m->grupo($projeto["3"], "gangdogpl");
    $grupo["2"] = $m->grupo($projeto["3"], "itachi");
    $grupo["3"] = $m->grupo($projeto["3"], "nota_21");
    $grupo["4"] = $m->grupo($projeto["4"], "1");
    $grupo["5"] = $m->grupo($projeto["4"], "2");

    $m->batch("grupo_aluno", Array(
      Array("user_id"=> $aluno["96"],  "grupo_id"=>$grupo["1"]),
      Array("user_id"=> $aluno["114"],  "grupo_id"=>$grupo["1"]),
      Array("user_id"=> $aluno["47"],  "grupo_id"=>$grupo["2"]),
      Array("user_id"=> $aluno["14"],  "grupo_id"=>$grupo["2"]),
      Array("user_id"=> $aluno["4"],  "grupo_id"=>$grupo["1"]),
      Array("user_id"=> $aluno["188"],  "grupo_id"=>$grupo["3"]),
      Array("user_id"=> $aluno["206"],  "grupo_id"=>$grupo["3"]),
      Array("user_id"=> $aluno["4"],  "grupo_id"=>$grupo["4"]),
    ));

    $m->etapa_submit($grupo["1"], $etapa["1"], "URL-FALSO-HEHE-XD.pdf");

    $horario = array();
    $horario["1"] = $m->horario_duvidas($cadeira["83"], $prof["7"], "11:30:00", "13:00:00", "Segunda-feira");
    $horario["2"] = $m->horario_duvidas($cadeira["83"], $prof["7"], "12:00:00", "13:00:00", "Quinta-feira");

    $evento = array();
    $evento["1"] = $m->evento("2020-06-18 11:00:00", "2020-06-18 12:30:00", "Reunião de Grupo", "Discutir distribuição do trabalho.", "FCUL");
    $evento["2"] = $m->evento("2020-06-25 11:30:00", "2020-06-25 13:00:00", "Horário de dúvidas", "Horário de dúvidas com o(a) professor(a) Maria José 1", "6.1.29", $horario["1"]);
    $evento["3"] = $m->evento("2020-06-17 11:00:00", "2020-06-17 12:30:00", "Decidir Framework", "Esta descrição descreve o evento. 2", "Azenhas");
    $evento["4"] = $m->evento("2020-06-18 12:00:00", "2020-06-18 13:00:00", "Horário de dúvidas", "Horário de dúvidas com o(a) professor(a) Maria José 2", "6.1.29", $horario["2"]);

    $m->batch("evento_grupo", Array(
      Array("evento_id"=> $evento["1"],  "grupo_id"=>$grupo["1"]),
      Array("evento_id"=> $evento["3"],  "grupo_id"=>$grupo["1"]),
    ));

    $m->batch("evento_user", Array(
      Array("evento_id"=> $evento["1"],  "user_id"=>$aluno["4"]),
      Array("evento_id"=> $evento["3"],  "user_id"=>$aluno["4"]),
    ));

    $m->notification($aluno["4"], "message", "Mensagem de João Ye", "Então?", "app/profile/2801", false, "2020-05-19 11:30:31");
    $m->notification($aluno["4"], "alert", "Tens uma trabalho para entregar", "Arquitetura de Computadores", "app/profile/2", false, "2020-05-30 11:30:35");
    $m->notification($aluno["4"], "alert", "Falhaste uma entrega", "Teatro", "subjects/subject/TEA84/2019", false, "2020-05-29 11:30:30");
    $m->notification($aluno["4"], "message", "Mensagem de Raul Koch", "Esta está seen, não deve aparecer", "app/profile/62", true, "2020-05-29 11:30:33");
        
    $execution_time = microtime(true) - $time_start;

    echo "<h2>Tempo de processamento: ".$execution_time."s </h2>";
    echo "<p><b>Aluno principal</b><br>s4</p>";
    echo "<p><b>Prof principal</b><br>t7</p>";
    echo "<p><b>Cadeira principal</b><br>Princípios de Programação</p>";
    echo "<p><b>Projeto principal</b><br>Spotupy em Haskell</p>";
    echo "<p><b>Forum principal</b><br>Forum de Notícias</p>";
    echo "<p><b>Thread principal</b><br>Avaliação da Cadeira</p>";
    echo "<p><b>Grupo principal</b><br>gangdogpl</p>";
}