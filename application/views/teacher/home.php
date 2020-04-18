<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/home.css">
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/teacher/home.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/calendario.css">
<script src="<?php echo $base_url; ?>js/calendario.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h1>Painel de Controlo</h1>

    <h3>Calendário</h3>
    <div id="calendario-hook"></div>

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
        </div>

        <div class="prof-stats-window" id="horario-hook">
            <div class="prof-stats-title">Horário</div>
            TODO 
        </div>
    </section>
    </main>
