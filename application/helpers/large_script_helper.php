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

    $ano["1"] = $m->ano_letivo("2019", "2020");

    $curso = array();
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


    $cadeira = array();
    $cadeira["1"] = $m->cadeira($curso["1"], "66506", "Biologia Animal I", "BAni-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    $cadeira["3"] = $m->cadeira($curso["1"], "66522", "História das Ideias em Biologia", "HIB", 1, "Descrição default.", "#ffb3ec");
    $cadeira["4"] = $m->cadeira($curso["1"], "66524", "Introdução ao Tratamento de Dados", "ITD", 1, "Descrição default.", "#ffb3ec");
    $cadeira["5"] = $m->cadeira($curso["1"], "13504", "Matemática para Biólogos", "MBiolo", 1, "Descrição default.", "#ffb3ec");
    $cadeira["6"] = $m->cadeira($curso["1"], "16489", "Química (Biologia)", "Q-Biologia", 1, "Descrição default.", "#ffb3ec");
    $cadeira["7"] = $m->cadeira($curso["1"], "66506", "Biologia Animal II", "BAni-II", 2, "Descrição default.", "#ffb3ec");
    $cadeira["8"] = $m->cadeira($curso["1"], "62809", "Biologia Vegetal", "BVege", 2, "Descrição default.", "#ffb3ec");
    $cadeira["9"] = $m->cadeira($curso["1"], "44337", "Bioquímica", "Bioqu", 2, "Descrição default.", "#ffb3ec");
    $cadeira["10"] = $m->cadeira($curso["1"], "46897", "Física para Biólogos", "FBiol", 2, "Descrição default.", "#ffb3ec");
    $cadeira["11"] = $m->cadeira($curso["1"], "46896", "Genética", "Gene", 2, "Descrição default.", "#ffb3ec");
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
    $cadeira["35"] = $m->cadeira($curso["2"], "44308", "Bioquímica Analítica", "BAna", 1, "Descrição default.", "#ffb3ec");
    $cadeira["36"] = $m->cadeira($curso["2"], "44309", "Bioquímica Experimental I", "BE-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["37"] = $m->cadeira($curso["2"], "44307", "Bioquímica II", "Bioq-II", 1, "Descrição default.", "#ffb3ec");
    $cadeira["38"] = $m->cadeira($curso["2"], "55784", "Química-Física I", "QF-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["39"] = $m->cadeira($curso["2"], "44308", "Biquímica Computacional", "BCump", 2, "Descrição default.", "#ffb3ec");
    $cadeira["40"] = $m->cadeira($curso["2"], "44313", "Bioquímica Experimental II", "BE-II", 2, "Descrição default.", "#ffb3ec");
    $cadeira["41"] = $m->cadeira($curso["2"], "46778", "Bioquímica Inorgânica", "BIno", 2, "Descrição default.", "#ffb3ec");
    $cadeira["42"] = $m->cadeira($curso["2"], "34672", "Microbiologia", "Microb", 2, "Descrição default.", "#ffb3ec");
    $cadeira["43"] = $m->cadeira($curso["2"], "44311", "Processos de Oxidação-Redução em Bioquímica", "PORB", 2, "Descrição default.", "#ffb3ec");
    
    $cadeira["44"] = $m->cadeira($curso["3"], "31167", "Álgebra Linear e Geometria Analítica A", "ALGA-A", 1, "Descrição default.", "#ffb3ec");
    $cadeira["45"] = $m->cadeira($curso["3"], "64824", "Cálculo I", "Calc-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["46"] = $m->cadeira($curso["3"], "45518", "Ciências da Informação Geoespacial", "CIGeo", 1, "Descrição default.", "#ffb3ec");
    $cadeira["47"] = $m->cadeira($curso["3"], "44712", "Introdução à Investigação Operacional", "IIO", 1, "Descrição default.", "#ffb3ec");
    $cadeira["48"] = $m->cadeira($curso["3"], "62249", "Programação I", "Prog-I", 1, "Descrição default.", "#ffb3ec");
    $cadeira["49"] = $m->cadeira($curso["3"], "64892", "Cálculo II", "Calc-II", 2, "Descrição default.", "#ffb3ec");
    $cadeira["50"] = $m->cadeira($curso["3"], "34615", "Introdução às Probabilidades e Estatística", "IPE", 2, "Descrição default.", "#ffb3ec");
    $cadeira["51"] = $m->cadeira($curso["3"], "64786", "Introdução às Tecnologias Web", "ITW", 2, "Descrição default.", "#ffb3ec");
    $cadeira["52"] = $m->cadeira($curso["3"], "61447", "Mecânica e Ondas", "MOnd", 2, "Descrição default.", "#ffb3ec");
    $cadeira["53"] = $m->cadeira($curso["3"], "64987", "Programação II", "Prog-II", 1, "Descrição default.", "#ffb3ec");
    $cadeira["54"] = $m->cadeira($curso["3"], "24578", "Ajustamento de Observações", "AObs", 1, "Descrição default.", "#ffb3ec");
    $cadeira["55"] = $m->cadeira($curso["3"], "63487", "Bases de Dados", "BD", 1, "Descrição default.", "#ffb3ec");
    $cadeira["56"] = $m->cadeira($curso["3"], "71744", "Desenho Técnico Assistido por Computador", "DTAC", 1, "Descrição default.", "#ffb3ec");
    $cadeira["57"] = $m->cadeira($curso["3"], "84678", "Instrumentação e Metrologia", "IMetro", 1, "Descrição default.", "#ffb3ec");
    $cadeira["58"] = $m->cadeira($curso["3"], "64781", "Sistemas de Informação Geográfica", "SIGeo", 1, "Descrição default.", "#ffb3ec");
    $cadeira["59"] = $m->cadeira($curso["3"], "73458", "Cartografia", "Cart", 2, "Descrição default.", "#ffb3ec");
    $cadeira["60"] = $m->cadeira($curso["3"], "74211", "Ordenamento do Território e Urbanismo", "OTUrb", 2, "Descrição default.", "#ffb3ec");
    $cadeira["61"] = $m->cadeira($curso["3"], "71746", "Posicionamento Geospacial I", "PGeo-I", 2, "Descrição default.", "#ffb3ec");
    $cadeira["62"] = $m->cadeira($curso["3"], "71748", "Sistemas de Referência Espaciais", "SREsp", 2, "Descrição default.", "#ffb3ec");
    $cadeira["63"] = $m->cadeira($curso["3"], "86458", "Cadastro Predial", "CPre", 1, "Descrição default.", "#ffb3ec");
    $cadeira["64"] = $m->cadeira($curso["3"], "71744", "Deteção Remota e Processamento de Imagem", "DRPImag", 1, "Descrição default.", "#ffb3ec");
    $cadeira["65"] = $m->cadeira($curso["3"], "71741", "Geodesia Física", "GFis", 1, "Descrição default.", "#ffb3ec");
    $cadeira["66"] = $m->cadeira($curso["3"], "71746", "Posicionamento Geoespacial II", "PGeo-II", 1, "Descrição default.", "#ffb3ec");
    $cadeira["67"] = $m->cadeira($curso["3"], "76454", "Economia e Gestão", "EGes", 2, "Descrição default.", "#ffb3ec");
    $cadeira["68"] = $m->cadeira($curso["3"], "71738", "Hidrografia", "Hidro", 2, "Descrição default.", "#ffb3ec");
    $cadeira["69"] = $m->cadeira($curso["3"], "71753", "Métodos Óticos de Modelação 3D", "MOM3D", 2, "Descrição default.", "#ffb3ec");
    $cadeira["70"] = $m->cadeira($curso["3"], "71764", "Projeto de Engenharia Geoespacial", "PEGeo", 2, "Descrição default.", "#ffb3ec");
    
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["3"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");
    // $cadeira["2"] = $m->cadeira($curso["1"], "67589", "Biologia Celular", "BCelu", 1, "Descrição default.", "#ffb3ec");

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