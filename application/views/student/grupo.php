<title>A+ for Students</title>
<script>setPageName("grupo")</script>
<script src="<?=$base_url?>js/window-date-picker.min.js"></script>
<script src="<?=$base_url?>js/student/grupo.js"></script>
<script src="<?=$base_url?>js/student/calendario-grupo.js"></script>
<script src="<?=$base_url?>js/pagination.min.js"></script>
<script src="<?=$base_url?>js/student/criarGrupos.js"></script>

<?='<script>setGrupoId("'.$grupo["id"].'")</script>'?>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/window-date-picker.min.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/student/grupo.css"> 
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/calendario.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/pagination-min.css">
</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>
    <?php $this->view('templates/popup'); ?>
    <div id="placeholder-picker-start"></div>
    <div id="placeholder-picker-end"></div>
    <main>
        <h4 class="breadcrumb">
            <a href="<?=$base_url?>app/student/grupos">Grupos</a> > Área de Grupo (<?=$grupo["name"]?>)
        </h4>
        <div class="clickable-title">
            <a href="<?=$base_url?>route/subject/<?=$info->cadeira_id?>">
                <h2><?=$info->name?></h2>
            </a> 
            <a href="<?=$base_url?>projects/project/<?=$info->projeto_id?>">
                <span id='project_name'>(<?=$info->nome?>)</span>
            </a>
        </div>

        <div id="btnArea">
            <div class='btnForArea'>
                <input id="ficheiros" type="button" value="Área de Ficheiros">
                <div class="fichNumb"></div>
            </div>
            <div class='btnForArea'>
                <a href="<?=$base_url."app/chat/g/".$grupo["id"]?>" class="std-btn">Chat de Grupo</a>
            </div>
            <!-- <div class='btnForArea' id='position3'>
            </div> -->
            
        </div>

        <h2>Agenda <img src="<?=base_url()?>images/icons/add_event.png" alt="Add Event" class="add-event-icon"></h2>
        <div id="calendario-hook"></div>
        <br>
        
        <h2>Gestão de Tarefas</h2>
        <div class="buttons-container">
            <input id="newTarefa" type="button" value="Adicionar tarefa">
            <input type="button" id="exportInfo" value="Exportar dados">
        </div>

        <div class="message"></div>
        
        <div class="tasksTable">
            <table id='tab-gerir-tarefas'>
                <thead>
                    <th>Tarefa</th>
                    <th>Membro Responsável</th>
                    <th>Completo</th>
                    <th>Tempo gasto</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody class="insertHere"></tbody>
            </table>
            
            <div class="container2"></div>
        </div>

        <div id="msg-sem-tarefas"></div>

        <!-- Popups gerados em js -->
        <div id="popups"></div>

        <!-- Pop up para o add -->
        <div class="popupAdd"></div>

        <!-- Pop up para o edit -->
        <div class="popupEdit"></div>

        <div class="cd-popup2" role="alert">
            <div class="cd-popup-container">
                <div class="cd-message"><!-- MENSAGEM --></div>
                <ul class="cd-buttons">
                    <li><a href="#" id="actionButton">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
                <a class="cd-popup-close"></a>
            </div>
        </div>

        <div class="GroupMembers"></div>

        <a id="linkParaProjeto" href="<?=$base_url?>projects/project/<?=$info->projeto_id?>"><input class="quitGroupButton" id='quit"<?=$grupo["id"]?>"' type="button" value="Sair do Grupo"></input></a>

</main>