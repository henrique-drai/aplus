<title>A+ for Students</title>
<script>setPageName("home")</script>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/calendario.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/home.css">
<script>setRole("student")</script>
<script src="<?=$base_url?>js/calendario.js"></script>
<script src="<?=$base_url?>js/home.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
<?php $this->view('templates/popup'); ?>
<main>
    <h1>Painel de Controlo</h1>
    <h3 style="text-align: center">Calendário</h3>
    <div id="calendario-hook"></div>

    <h3 style="text-align: center">Cadeiras acedidas recentemente</h3>
    <div id="subjects-hook"></div>
</main>
