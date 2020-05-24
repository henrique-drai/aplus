<title>A+ for Students</title>
<script>setPageName("grupo")</script>
<script src="<?=$base_url?>js/student/grupo.js"></script>
<script src="<?=$base_url?>js/student/calendario-grupo.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/student/grupo.css"> 
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/calendario.css"> 

<!--  ######################  -->

<!-- <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.css" id=theme_base"> -->
<link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.date.css" id="theme_date">
<link rel="stylesheet" href="https://amsul.ca/pickadate.js/vendor/pickadate/lib/themes/default.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.date.js"></script>



<!-- ###################### -->


</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?=$base_url?>app/student/grupos">Grupos</a> > Área de Grupo
        </h4>

        <h1>Área de Grupo</h1>

        <div id="btnArea">
            <input id="ficheiros" type="button" value="Ficheiros">  
        </div>

        <h2>Agenda</h2>
        <div id="calendario-hook"></div>
        <br>
        
        
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



        <h2>Marcar Eventos</h2>

       <div id="marcarEvento">

          <form id="eventSchedule" class="event-Schedule"  action="javascript:void(0)">
                  
              
                  <label for="">Data:</label>
                  <input class="datepicker" name="dateEvento" type="text">
              
                  <label for="">Nome Evento:</label>
                  <input class="name" name="nomeEvento" type="text" >
              
                  <label for="">Descrição:</label>
                  <input class="name" name="descEvento" type="text" >
              
                  <label for="">Localização:</label>
                  <input class="name" name="localEvento" type="text" >
                            
              <input id="submitEvento" type="submit"  value="Efetuar marcação">
          
          </form>
        </div>