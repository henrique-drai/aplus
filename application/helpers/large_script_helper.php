<?php

function large_script($m) {
    $time_start = microtime(true);
    
    $aluno = array();
    $aluno["1"] = $m->student("Name", "Surname", "s1", "s1", "Descrição default.");
    $aluno["2"] = $m->student("Adriana", "De", "s2", "s2", "Descrição default.");
    $aluno["3"] = $m->student("Afonso", "JosÉ", "s3", "s3", "Descrição default.");
    $aluno["4"] = $m->student("Afonso", "Martins", "s4", "s4", "Descrição default.");
    $aluno["5"] = $m->student("Alessia", "Lopes", "s5", "s5", "Descrição default.");
    $aluno["6"] = $m->student("Alexandre", "Antonio", "s6", "s6", "Descrição default.");
    $aluno["7"] = $m->student("Alice", "Calretas", "s7", "s7", "Descrição default.");
    $aluno["8"] = $m->student("Alice", "Martins", "s8", "s8", "Descrição default.");
    $aluno["9"] = $m->student("Ana", "Beatriz", "s9", "s9", "Descrição default.");
    $aluno["10"] = $m->student("Ana", "Catarina", "s10", "s10", "Descrição default.");
    $aluno["11"] = $m->student("Ana", "Filipa", "s11", "s11", "Descrição default.");
    $aluno["12"] = $m->student("Ana", "Isabel", "s12", "s12", "Descrição default.");
    $aluno["13"] = $m->student("Ana", "Marisa", "s13", "s13", "Descrição default.");
    $aluno["14"] = $m->student("Ana", "Marta", "s14", "s14", "Descrição default.");
    $aluno["15"] = $m->student("Ana", "Rita", "s15", "s15", "Descrição default.");
    $aluno["16"] = $m->student("Ana", "Rita", "s16", "s16", "Descrição default.");
    $aluno["17"] = $m->student("Ana", "Sofia", "s17", "s17", "Descrição default.");
    $aluno["18"] = $m->student("Andreia", "Carina", "s18", "s18", "Descrição default.");
    $aluno["19"] = $m->student("Andreia", "CarriÇo", "s19", "s19", "Descrição default.");
    $aluno["20"] = $m->student("AndrÉ", "Filipe", "s20", "s20", "Descrição default.");
    $aluno["21"] = $m->student("AndrÉ", "Filipe", "s21", "s21", "Descrição default.");
    $aluno["22"] = $m->student("AndrÉ", "Filipe", "s22", "s22", "Descrição default.");
    $aluno["23"] = $m->student("AndrÉ", "Vieira", "s23", "s23", "Descrição default.");
    $aluno["24"] = $m->student("AntÓnio", "Afonso", "s24", "s24", "Descrição default.");
    $aluno["25"] = $m->student("AntÓnio", "Maria", "s25", "s25", "Descrição default.");
    $aluno["26"] = $m->student("AntÓnio", "Maria", "s26", "s26", "Descrição default.");
    $aluno["27"] = $m->student("AntÓnio", "Miguel", "s27", "s27", "Descrição default.");
    $aluno["28"] = $m->student("AntÓnio", "Pedro", "s28", "s28", "Descrição default.");
    $aluno["29"] = $m->student("Beatriz", "Alexandra", "s29", "s29", "Descrição default.");
    $aluno["30"] = $m->student("Beatriz", "Catarino", "s30", "s30", "Descrição default.");
    $aluno["31"] = $m->student("Beatriz", "Coutinho", "s31", "s31", "Descrição default.");
    $aluno["32"] = $m->student("Beatriz", "Daniela", "s32", "s32", "Descrição default.");
    $aluno["33"] = $m->student("Beatriz", "Dinelli", "s33", "s33", "Descrição default.");
    $aluno["34"] = $m->student("Beatriz", "Duarte", "s34", "s34", "Descrição default.");
    $aluno["35"] = $m->student("Beatriz", "Lopes", "s35", "s35", "Descrição default.");
    $aluno["36"] = $m->student("Beatriz", "Parreirinha", "s36", "s36", "Descrição default.");
    $aluno["37"] = $m->student("Beatriz", "Silva", "s37", "s37", "Descrição default.");
    $aluno["38"] = $m->student("Bernardo", "LourenÇo", "s38", "s38", "Descrição default.");
    $aluno["39"] = $m->student("Bruno", "Alexandre", "s39", "s39", "Descrição default.");
    $aluno["40"] = $m->student("Bruno", "Daniel", "s40", "s40", "Descrição default.");
    $aluno["41"] = $m->student("Bruno", "Miguel", "s41", "s41", "Descrição default.");
    $aluno["42"] = $m->student("Bruno", "Miguel", "s42", "s42", "Descrição default.");
    $aluno["43"] = $m->student("Bruno", "Teixeira", "s43", "s43", "Descrição default.");
    $aluno["44"] = $m->student("Carolina", "Baptista", "s44", "s44", "Descrição default.");
    $aluno["45"] = $m->student("Carolina", "Ferreira", "s45", "s45", "Descrição default.");
    $aluno["46"] = $m->student("Carolina", "Maria", "s46", "s46", "Descrição default.");
    $aluno["47"] = $m->student("Carolina", "Maria", "s47", "s47", "Descrição default.");
    $aluno["48"] = $m->student("Carolina", "Nunes", "s48", "s48", "Descrição default.");
    $aluno["49"] = $m->student("Carolina", "Sofia", "s49", "s49", "Descrição default.");
    $aluno["50"] = $m->student("Catarina", "Alexandra", "s50", "s50", "Descrição default.");
    $aluno["51"] = $m->student("Catarina", "GonÇalves", "s51", "s51", "Descrição default.");
    $aluno["52"] = $m->student("Catarina", "GonÇalves", "s52", "s52", "Descrição default.");
    $aluno["53"] = $m->student("Catarina", "Lopes", "s53", "s53", "Descrição default.");
    $aluno["54"] = $m->student("Catarina", "Maria", "s54", "s54", "Descrição default.");
    $aluno["55"] = $m->student("Catarina", "Salgado", "s55", "s55", "Descrição default.");
    $aluno["56"] = $m->student("Clara", "Morais", "s56", "s56", "Descrição default.");
    $aluno["57"] = $m->student("ConstanÇa", "Melo", "s57", "s57", "Descrição default.");
    $aluno["58"] = $m->student("Cristiana", "Sofia", "s58", "s58", "Descrição default.");
    $aluno["59"] = $m->student("CÉlia", "Samo", "s59", "s59", "Descrição default.");
    $aluno["60"] = $m->student("Daniela", "Hanganu", "s60", "s60", "Descrição default.");
    $aluno["61"] = $m->student("Diana", "Patricia", "s61", "s61", "Descrição default.");
    $aluno["62"] = $m->student("Diogo", "AntÓnio", "s62", "s62", "Descrição default.");
    $aluno["63"] = $m->student("Diogo", "Caneco", "s63", "s63", "Descrição default.");
    $aluno["64"] = $m->student("Diogo", "Catarino", "s64", "s64", "Descrição default.");
    $aluno["65"] = $m->student("Diogo", "Maria", "s65", "s65", "Descrição default.");
    $aluno["66"] = $m->student("Diogo", "Miguel", "s66", "s66", "Descrição default.");
    $aluno["67"] = $m->student("Duarte", "De", "s67", "s67", "Descrição default.");
    $aluno["68"] = $m->student("Duarte", "Ferreira", "s68", "s68", "Descrição default.");
    $aluno["69"] = $m->student("Duarte", "Maria", "s69", "s69", "Descrição default.");
    $aluno["70"] = $m->student("Duarte", "SimÃo", "s70", "s70", "Descrição default.");
    $aluno["71"] = $m->student("Eduardo", "Pinheiro", "s71", "s71", "Descrição default.");
    $aluno["72"] = $m->student("Filipa", "Alexandra", "s72", "s72", "Descrição default.");
    $aluno["73"] = $m->student("Filipe", "Antunes", "s73", "s73", "Descrição default.");
    $aluno["74"] = $m->student("Francisca", "Maria", "s74", "s74", "Descrição default.");
    $aluno["75"] = $m->student("Francisco", "Marques", "s75", "s75", "Descrição default.");
    $aluno["76"] = $m->student("Francisco", "Moura", "s76", "s76", "Descrição default.");
    $aluno["77"] = $m->student("Francisco", "Stevens", "s77", "s77", "Descrição default.");
    $aluno["78"] = $m->student("Fábio", "Jorge", "s78", "s78", "Descrição default.");
    $aluno["79"] = $m->student("Fátima", "Carvalho", "s79", "s79", "Descrição default.");
    $aluno["80"] = $m->student("GonÇalo", "Da", "s80", "s80", "Descrição default.");
    $aluno["81"] = $m->student("GonÇalo", "De", "s81", "s81", "Descrição default.");
    $aluno["82"] = $m->student("GonÇalo", "Manuel", "s82", "s82", "Descrição default.");
    $aluno["83"] = $m->student("Guilherme", "Herculano", "s83", "s83", "Descrição default.");
    $aluno["84"] = $m->student("Henrique", "Miguel", "s84", "s84", "Descrição default.");
    $aluno["85"] = $m->student("Inês", "Alexandra", "s85", "s85", "Descrição default.");
    $aluno["86"] = $m->student("Inês", "Carvalho", "s86", "s86", "Descrição default.");
    $aluno["87"] = $m->student("Inês", "Costa", "s87", "s87", "Descrição default.");
    $aluno["88"] = $m->student("Inês", "Luz", "s88", "s88", "Descrição default.");
    $aluno["89"] = $m->student("Inês", "Sofia", "s89", "s89", "Descrição default.");
    $aluno["90"] = $m->student("Joana", "Catarina", "s90", "s90", "Descrição default.");
    $aluno["91"] = $m->student("Joana", "De", "s91", "s91", "Descrição default.");
    $aluno["92"] = $m->student("Joana", "Maria", "s92", "s92", "Descrição default.");
    $aluno["93"] = $m->student("Joana", "Moreira", "s93", "s93", "Descrição default.");
    $aluno["94"] = $m->student("Joana", "Pereira", "s94", "s94", "Descrição default.");
    $aluno["95"] = $m->student("Joana", "Pinto", "s95", "s95", "Descrição default.");
    $aluno["96"] = $m->student("Joana", "Raquel", "s96", "s96", "Descrição default.");
    $aluno["97"] = $m->student("Joana", "Torres", "s97", "s97", "Descrição default.");
    $aluno["98"] = $m->student("Jonathan", "Fingolo", "s98", "s98", "Descrição default.");
    $aluno["99"] = $m->student("JosÉ", "Do", "s99", "s99", "Descrição default.");
    $aluno["100"] = $m->student("JosÉ", "Maria", "s100", "s100", "Descrição default.");
    $aluno["101"] = $m->student("JoÃo", "AntÓnio", "s101", "s101", "Descrição default.");
    $aluno["102"] = $m->student("JoÃo", "Carlos", "s102", "s102", "Descrição default.");
    $aluno["103"] = $m->student("JoÃo", "Filipe", "s103", "s103", "Descrição default.");
    $aluno["104"] = $m->student("JoÃo", "GonÇalo", "s104", "s104", "Descrição default.");
    $aluno["105"] = $m->student("JoÃo", "JosÉ", "s105", "s105", "Descrição default.");
    $aluno["106"] = $m->student("JoÃo", "Miguel", "s106", "s106", "Descrição default.");
    $aluno["107"] = $m->student("JoÃo", "Miguel", "s107", "s107", "Descrição default.");
    $aluno["108"] = $m->student("JoÃo", "Pedro", "s108", "s108", "Descrição default.");
    $aluno["109"] = $m->student("JoÃo", "Pedro", "s109", "s109", "Descrição default.");
    $aluno["110"] = $m->student("JoÃo", "Pedro", "s110", "s110", "Descrição default.");
    $aluno["111"] = $m->student("JoÃo", "Tiago", "s111", "s111", "Descrição default.");
    $aluno["112"] = $m->student("JoÃo", "Ye", "s112", "s112", "Descrição default.");
    $aluno["113"] = $m->student("JÉssica", "Meninas", "s113", "s113", "Descrição default.");
    $aluno["114"] = $m->student("Karolina", "Mazurek", "s114", "s114", "Descrição default.");
    $aluno["115"] = $m->student("Kennedy", "Samuel", "s115", "s115", "Descrição default.");
    $aluno["116"] = $m->student("Lara", "Isabel", "s116", "s116", "Descrição default.");
    $aluno["117"] = $m->student("Leonor", "Inês", "s117", "s117", "Descrição default.");
    $aluno["118"] = $m->student("Lucas", "Bronger", "s118", "s118", "Descrição default.");
    $aluno["119"] = $m->student("Luis", "Ricciardi", "s119", "s119", "Descrição default.");
    $aluno["120"] = $m->student("Luis", "Eduardo", "s120", "s120", "Descrição default.");
    $aluno["121"] = $m->student("Luis", "Miguel", "s121", "s121", "Descrição default.");
    $aluno["122"] = $m->student("Luis", "Tiago", "s122", "s122", "Descrição default.");
    $aluno["123"] = $m->student("Madalena", "Sousa", "s123", "s123", "Descrição default.");
    $aluno["124"] = $m->student("Manuel", "Neves", "s124", "s124", "Descrição default.");
    $aluno["125"] = $m->student("Manuel", "Ulrich", "s125", "s125", "Descrição default.");
    $aluno["126"] = $m->student("Margarida", "Comprido", "s126", "s126", "Descrição default.");
    $aluno["127"] = $m->student("Margarida", "Do", "s127", "s127", "Descrição default.");
    $aluno["128"] = $m->student("Margarida", "Duarte", "s128", "s128", "Descrição default.");
    $aluno["129"] = $m->student("Margarida", "Olaio", "s129", "s129", "Descrição default.");
    $aluno["130"] = $m->student("Margarida", "Ramos", "s130", "s130", "Descrição default.");
    $aluno["131"] = $m->student("Margarida", "Rodrigues", "s131", "s131", "Descrição default.");
    $aluno["132"] = $m->student("Maria", "Ana", "s132", "s132", "Descrição default.");
    $aluno["133"] = $m->student("Maria", "Carolina", "s133", "s133", "Descrição default.");
    $aluno["134"] = $m->student("Maria", "Catarina", "s134", "s134", "Descrição default.");
    $aluno["135"] = $m->student("Maria", "Francisca", "s135", "s135", "Descrição default.");
    $aluno["136"] = $m->student("Maria", "Inês", "s136", "s136", "Descrição default.");
    $aluno["137"] = $m->student("Maria", "Leonor", "s137", "s137", "Descrição default.");
    $aluno["138"] = $m->student("Maria", "Leonor", "s138", "s138", "Descrição default.");
    $aluno["139"] = $m->student("Maria", "Rodrigues", "s139", "s139", "Descrição default.");
    $aluno["140"] = $m->student("Maria", "Teresa", "s140", "s140", "Descrição default.");
    $aluno["141"] = $m->student("Mariana", "CÂmara", "s141", "s141", "Descrição default.");
    $aluno["142"] = $m->student("Mariana", "De", "s142", "s142", "Descrição default.");
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
    $aluno["161"] = $m->student("Miguel", "Alexandre", "s161", "s161", "Descrição default.");
    $aluno["162"] = $m->student("Miguel", "Laranjeira", "s162", "s162", "Descrição default.");
    $aluno["163"] = $m->student("Miguel", "Tomás", "s163", "s163", "Descrição default.");
    $aluno["164"] = $m->student("Márcia", "Filipa", "s164", "s164", "Descrição default.");
    $aluno["165"] = $m->student("Márcia", "Henriques", "s165", "s165", "Descrição default.");
    $aluno["166"] = $m->student("MÓnica", "Beatriz", "s166", "s166", "Descrição default.");
    $aluno["167"] = $m->student("Nadine", "Figueiredo", "s167", "s167", "Descrição default.");
    $aluno["168"] = $m->student("Nautaran", "Nancassa", "s168", "s168", "Descrição default.");
    $aluno["169"] = $m->student("Nuno", "Barata", "s169", "s169", "Descrição default.");
    $aluno["170"] = $m->student("Nuno", "Ricardo", "s170", "s170", "Descrição default.");
    $aluno["171"] = $m->student("Olivia", "Maria", "s171", "s171", "Descrição default.");
    $aluno["172"] = $m->student("Otavio", "Augusto", "s172", "s172", "Descrição default.");
    $aluno["173"] = $m->student("Patricia", "Filipa", "s173", "s173", "Descrição default.");
    $aluno["174"] = $m->student("Pedro", "Da", "s174", "s174", "Descrição default.");
    $aluno["175"] = $m->student("Pedro", "Miguel", "s175", "s175", "Descrição default.");
    $aluno["176"] = $m->student("Pedro", "Rendo", "s176", "s176", "Descrição default.");
    $aluno["177"] = $m->student("Phillip", "Kemp", "s177", "s177", "Descrição default.");
    $aluno["178"] = $m->student("Rafael", "Banza", "s178", "s178", "Descrição default.");
    $aluno["179"] = $m->student("Raquel", "Filipa", "s179", "s179", "Descrição default.");
    $aluno["180"] = $m->student("Raquel", "PerdigÃo", "s180", "s180", "Descrição default.");
    $aluno["181"] = $m->student("Raquel", "Rebelo", "s181", "s181", "Descrição default.");
    $aluno["182"] = $m->student("RaÚl", "Julian", "s182", "s182", "Descrição default.");
    $aluno["183"] = $m->student("Ricardo", "Martins", "s183", "s183", "Descrição default.");
    $aluno["184"] = $m->student("Rita", "Alexandra", "s184", "s184", "Descrição default.");
    $aluno["185"] = $m->student("Rita", "Isabel", "s185", "s185", "Descrição default.");
    $aluno["186"] = $m->student("Rita", "Policarpo", "s186", "s186", "Descrição default.");
    $aluno["187"] = $m->student("Rodrigo", "Afonso", "s187", "s187", "Descrição default.");
    $aluno["188"] = $m->student("Rodrigo", "AragÜés", "s188", "s188", "Descrição default.");
    $aluno["189"] = $m->student("Rodrigo", "QueirÓs", "s189", "s189", "Descrição default.");
    $aluno["190"] = $m->student("Sara", "Isabel", "s190", "s190", "Descrição default.");
    $aluno["191"] = $m->student("SebastiÃo", "De", "s191", "s191", "Descrição default.");
    $aluno["192"] = $m->student("Shania", "Tierra", "s192", "s192", "Descrição default.");
    $aluno["193"] = $m->student("Sofia", "Ribeiro", "s193", "s193", "Descrição default.");
    $aluno["194"] = $m->student("Stefany", "Mariany", "s194", "s194", "Descrição default.");
    $aluno["195"] = $m->student("Sérgio", "Miguel", "s195", "s195", "Descrição default.");
    $aluno["196"] = $m->student("SÓnia", "Da", "s196", "s196", "Descrição default.");
    $aluno["197"] = $m->student("Teresa", "Bernardino", "s197", "s197", "Descrição default.");
    $aluno["198"] = $m->student("Teresa", "Maria", "s198", "s198", "Descrição default.");
    $aluno["199"] = $m->student("Tiago", "Ferreira", "s199", "s199", "Descrição default.");
    $aluno["200"] = $m->student("Tiago", "Filipe", "s200", "s200", "Descrição default.");
    $aluno["201"] = $m->student("Tomas", "Maria", "s201", "s201", "Descrição default.");
    $aluno["202"] = $m->student("Tomás", "BraganÇa", "s202", "s202", "Descrição default.");
    $aluno["203"] = $m->student("Tomás", "Da", "s203", "s203", "Descrição default.");
    $aluno["204"] = $m->student("Tomás", "Dos", "s204", "s204", "Descrição default.");
    $aluno["205"] = $m->student("Tomás", "Jardim", "s205", "s205", "Descrição default.");
    $aluno["206"] = $m->student("Tomás", "Ventura", "s206", "s206", "Descrição default.");
    $aluno["207"] = $m->student("Vasco", "Filipe", "s207", "s207", "Descrição default.");
    $aluno["208"] = $m->student("Vasco", "Maria", "s208", "s208", "Descrição default.");
    $aluno["209"] = $m->student("Vasco", "Santos", "s209", "s209", "Descrição default.");
    $aluno["210"] = $m->student("Vasco", "Sousa", "s210", "s210", "Descrição default.");
    $aluno["211"] = $m->student("Vera", "Alexandra", "s211", "s211", "Descrição default.");
    $aluno["212"] = $m->student("Yiqing", "Zhu", "s212", "s212", "Descrição default.");
    $aluno["213"] = $m->student("Ângela", "Do", "s213", "s213", "Descrição default.");
    $aluno["214"] = $m->student("Érica", "Beatriz", "s214", "s214", "Descrição default.");

    $prof = array();
    $prof["1"] = $m->teacher("Manuel", "Francisco", "t1", "t1", "Descrição default.", "6.1.19");
    $prof["2"] = $m->teacher("José", "Andrade", "t2", "t2", "Descrição default.", "6.1.123");
    $prof["3"] = $m->teacher("João", "Sousa", "t3", "t3", "Descrição default.", "6.1.4");
    $prof["4"] = $m->teacher("Amélia", "Silva", "t4", "t4", "Descrição default.", "6.1.3");
    $prof["5"] = $m->teacher("Cristina", "Ye", "t5", "t5", "Descrição default.", "6.1.64");
    $prof["6"] = $m->teacher("Ana", "Pereira", "t6", "t6", "Descrição default.", "6.1.34");
    $prof["7"] = $m->teacher("Maria", "José", "t7", "t7", "Descrição default.", "6.1.29");
    $prof["8"] = $m->teacher("André", "João", "t8", "t8", "Descrição default.", "6.1.1");
    $prof["9"] = $m->teacher("Rodolfo", "Martins", "t9", "t9", "Descrição default.", "6.1.123");
    $prof["10"] = $m->teacher("Martim", "Mais", "t10", "t10", "Descrição default.", "6.1.143");
    $prof["11"] = $m->teacher("Marilia", "Santana", "t11", "t11", "Descrição default.", "6.1.13");
    $prof["12"] = $m->teacher("Cecilia", "Brás", "t12", "t12", "Descrição default.", "6.1.12");
    $prof["13"] = $m->teacher("Joana", "Gomes", "t13", "t13", "Descrição default.", "6.1.11");

    $faculdade["1"] = $m->faculdade("Faculdade de Ciências da Universidade de Lisboa", "FCUL", "Campo Grande");

    // $curso1_id = $m->curso($faculdade1_id, $ano1_id, "FS2022", "Fisica", "Descição positiva");

    // $cadeira1_id = $m->cadeira($curso1_id, "TEA84", "Teatro", "Teatro", 1, "Ewwwww", "#ffb3ec");

    // $aula1_id = $m->aula($cadeira1_id, "PL", "10:30", "12:00", 1, "1.3.24");

    // $m->batch("aluno_curso", Array(
    //   Array("user_id"=> $aluno1_id, "curso_id"=>$curso2_id, "data_entrada"=>""),
    // ));
  
    // $m->batch("aluno_cadeira", Array(
    //   Array("user_id"=> $aluno1_id, "cadeira_id"=>$cadeira1_id, "is_completed"=>False, "last_visited"=>date('Y-m-d H:i:s')),
    // ));    

    // $m->batch("professor_cadeira", Array(
    //   Array("user_id"=> $prof1_id, "cadeira_id"=>$cadeira1_id),
    // ));

    // $m->batch("aluno_aula", Array(
    //   Array("user_id"=> $aluno1_id, "aula_id"=>$aula5_id),
    // ));

    // $m->batch("professor_aula", Array(
    //   Array("user_id"=> $prof1_id, "aula_id"=>$aula5_id),
    // ));

    // $forum1_id = $m->forum($cadeira1_id, "Fórum de Noticias", "Fórum de noticias, os alunos não podem escrever.", 1);


    // $thread1_id = $m->thread($prof1_id, $forum1_id, "Avaliação da cadeira", "Testes e 3 projetos ao longo do semestre", "2020-04-13 11:00:00");

    // $m->thread_post($thread1_id, $prof1_id, "Avaliação da cadeira", "Testes e 3 projetos ao longo do semestre", "2020-04-13 11:00:00");
    

    // $projeto1_id = $m->projeto($cadeira1_id, "Evolução da Ciência", "Texto que descreve este projeto cientifico.", 1, 2, "");

    // $etapa1_id = $m->etapa($projeto1_id, "2020-05-06 23:00:00", "", "Pesquisa", "Façam pesquisa no StackOverflow.");

    // $grupo1_id = $m->grupo($projeto1_id, "1");

    // $m->batch("grupo_aluno", Array(
    //   Array("user_id"=> $aluno1_id,  "grupo_id"=>$grupo1_id),
    // ));

    // $m->etapa_submit($grupo3_id, $etapa1_id, "URL-FALSO-HEHE-XD");

    // $evento1_id = $m->evento("2020-05-05 11:00:00", "2020-05-05 12:30:00", "Reunião de Grupo", "Discutir o modelo da base de dados. 1", "FCUL");

    // $m->batch("evento_grupo", Array(
    //   Array("evento_id"=> $evento1_id,  "grupo_id"=>$grupo1_id),
    //   Array("evento_id"=> $evento3_id,  "grupo_id"=>$grupo1_id),
    // ));

    // $m->batch("evento_user", Array(
    //   Array("evento_id"=> $evento1_id,  "user_id"=>$aluno1_id),
    // ));

    // $m->notification($aluno1_id, "message", "Mensagem de João Ye", "Atão crlh?", "app/profile/2801", false, "2020-04-23 11:30:31");
        
    $execution_time = microtime(true) - $time_start;

    echo "<h2>Tempo de processamento: ".$execution_time."s </h2>";
    echo "<p><b>Aluno principal</b><br>1@gmail.com</p>";
    echo "<p><b>Prof principal</b><br>13@gmail.com</p>";
    echo "<p><b>Cadeira principal</b><br>Teatro</p>";
    echo "<p><b>Projeto principal</b><br>Evolução da Ciência</p>";
    echo "<p><b>Forum principal</b><br>Evolução da Ciência</p>";
    echo "<p><b>Thread principal</b><br>Avaliação da Cadeira</p>";
}