<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/teacher/home.css">
<script>setPageName("home")</script>
<script src="<?=$base_url?>js/teacher/home.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/calendario.css">
<script src="<?=$base_url?>js/calendario.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
<?php $this->view('templates/popup'); ?>
    <main>
    <h1>Painel de Controlo</h1>

    <h3 style="text-align: center">Calendário</h3>
    <div id="calendario-hook"></div>
    <br><br>

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
    </section>
    </main>
