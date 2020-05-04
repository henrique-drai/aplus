<title>A+ for Students</title>
<script>setPageName("grupo")</script>
<script src="<?php echo $base_url; ?>js/student/grupo.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/grupo.css">

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>app/student/grupos">Grupos</a> > <a href="<?php echo base_url(); ?>app/student/grupo">Área de Grupo</a>
        </h4>
        <h1>Área de Grupo</h1>
        <input id="ficheiros" type="button" value="Ficheiros">
        <input id="ratingmembros" type="button" value="Rating Membros">
        
        <h2>Gestão de Tarefas</h2>
        
        <table id="tab-gerir-tarefas">
            <tr>
                <th>Tarefa</th>
                <th>Descrição</th>
                <th>Membro Responsável</th>
                <th>Começo</th>
                <th>Fim</th>
            </tr>
        </table>

        <div id="msg-sem-tarefas"></div>

        <div class="buttons-container">
            <input id="newTarefa" type="button" value="Adicionar tarefa">
            <input id="editTarefa" type="button" value="Editar tarefa">
            <input id="deleteTarefa" type="button" value="Eliminar tarefa">
        </div>

        <!-- Popups gerados em js -->
        <div id="popups">
        </div>

        <!-- Pop up com form, criado logo à mao -->
        <div class="overlay" id="tarefa-overlay-new">
            <div class="popup" id="tarefa-form-popup">
            <a class="close" href="#">&times;</a>
                <div class="content">
                <form id="tarefa-form" action="javascript:void(0)">
                    <p id="tarefa" class="tarefa">
                        <label id="tarefa-label" class="form-label-title">Nova tarefa:</label>
                        <label class="form-label">Nome</label>
                        <input class="form-input-text" type="text" name="tarefaName" required>
                        <label class="form-label">Descrição</label>
                        <textarea class="form-text-area" type="text" name="tarefaDescription" required></textarea>
                        <label class="form-label">Membro responsável</label>
                        <input class="form-input-text" type="text" name="tarefaMembro" required>
                        <label class="form-label">Data de começo</label>
                        <input class="form-input-text" type="datetime-local" name="tarefaDateInicio" required>
                        <label class="form-label">Data de fim</label>
                        <input class="form-input-text" type="datetime-local" name="tarefaDateFim" required>
                    </p>
                     <p>
                        <div id="errormsg" class="submit-msg">Mensagem de erro template</div>
                    </p>

                    <input type="submit" id="newTarefa" value="Criar">
                    <input type="submit" id="newTarefaEDIT" value="Confirmar">
                </form>
                </div>
            </div>
        </div>


    </main>