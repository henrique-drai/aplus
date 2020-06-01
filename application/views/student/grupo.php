<title>A+ for Students</title>
<script>setPageName("grupo")</script>
<script src="<?=$base_url?>js/student/grupo.js"></script>
<script src="<?=$base_url?>js/student/calendario-grupo.js"></script>
<?='<script>setGrupoId("'.$grupo["id"].'")</script>'?>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/student/grupo.css"> 
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/calendario.css"> 
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?=$base_url?>app/student/grupos">Grupos</a> > Área de Grupo
        </h4>
        
        <div class="clickable-title">
            <a href="<?=$base_url?>route/subject/<?=$info->cadeira_id?>">
                <h2><?=$info->name?></h2>
            </a> 
            <a href="<?=$base_url?>projects/project/<?=$info->projeto_id?>">
                <span>(<?=$info->nome?>)</span>
            </a>
        </div>

        

        <div id="btnArea">
            <input id="ficheiros" type="button" value="Ficheiros">  
        </div>

        <h2>Agenda</h2>
        <div id="calendario-hook"></div>
        <br>
        
        
        <h2>Gestão de Tarefas</h2>
        <div class="buttons-container">
            <input id="newTarefa" type="button" value="Adicionar tarefa">
        </div>
        
        <div class="tasksTable"></div>

        <div class="message"></div>

        <div id="msg-sem-tarefas"></div>

        <!-- Popups gerados em js -->
        <div id="popups"></div>

        <!-- Pop up para o add -->
        <div class="popupAdd"></div>

        <!-- Pop up para o edit -->
        <div class="popupEdit"></div>
