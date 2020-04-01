<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/home.css">
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/home.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <h1>Painel de Controlo</h1>

    <section class="prof-stats">
        <div class="prof-stats-window" id="cadeiras-hook">
            <div class="prof-stats-title">Cadeiras</div>
            <br>
            <div class="prof-stats-content">
                Nº de Cadeiras: <span id="hook-num-cadeiras"></span>
            </div>
            <div class="prof-subjects"></div>
        </div>

        <div class="prof-stats-window" id="alunos-hook">
            <div class="prof-stats-title">Alunos</div>
            <br>
            <div class="prof-stats-content">
                Nº de Alunos: <span id="hook-num-alunos"></span>
            </div>
            <div class='prof-stats-btn'>
                <a href="<?php echo $base_url; ?>app/students/studentsList"><div>Gerir</div></a>
            </div>
        </div>

        <div class="prof-stats-window" id="horario-hook">
            <div class="prof-stats-title">Horário</div>
            TODO 
        </div>
    </section>
    </main>
