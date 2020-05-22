<title>A+ for Students</title>
<script>setPageName("grupo")</script>
<script src="<?=$base_url?>js/student/grupo.js"></script>
<script src="<?=$base_url?>js/student/calendario-grupo.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/student/grupo.css">
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?=$base_url?>app/student/grupos">Grupos</a> > Área de Grupo
        </h4>

        <h1>Área de Grupo</h1>

        <div id="calendario-hook"></div>

        <div id="btnArea">
            <input id="ficheiros" type="button" value="Ficheiros">  
        </div>
        
        
        <h2>Gestão de Tarefas</h2>

        <div class="message">Adicionado com sucesso!</div>
        
        <div class="tasksTable"></div>

        <div id="msg-sem-tarefas"></div>

        <div class="buttons-container">
            <input id="newTarefa" type="button" value="Adicionar tarefa">
            <input id="editTarefa" type="button" value="Editar tarefa">
            <input id="deleteTarefa" type="button" value="Eliminar tarefa">
        </div>

        <!-- Popups gerados em js -->
        <div id="popups"></div>

        <!-- Pop up para o add -->
        <div class="popupAdd"></div>


    </main>