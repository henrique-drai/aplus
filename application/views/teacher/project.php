<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/project.js"></script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
<script>setEnunciado("<?php echo addslashes($project[0]["enunciado_url"]); ?>")</script>
<script>setBackPage("<?php echo $base_url; ?>" + "subjects/subject/" + "<?php echo $subject->code; ?>")</script>

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4>
    <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
    <input id="removeProject" class="remove" type="button" value="Eliminar projeto">
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h3"></h3>
        <div class="wrapper-top">
            <input class="form-input-file" type="file" id="file_projeto" name="file_proj" title="Escolher enunciado">
            <input id="addEnunciado" type="button" value="Adicionar enunciado">
        </div>
        <div class="container-header">
            <h3>Descrição</h3>
            <p> <?php echo $project[0]["description"]; ?></p>
            <h3>Grupos</h3>
        </div>

        <div class="container">
            <table id="groups_list"></table>
        </div>

        <h3>Etapas</h3>
        <div id="etapas-container" class="container">
        </div>

        <div id="popups">

        </div>

        <div id="etapa-info-extra">
        </div>

        <div class="buttons-container">
            <input id="opennewEtapa" type="button" value="Criar etapa">
        </div>


        <form id="feedback-form">
            <p>
                <label class="form-label">Selecione o grupo</label>
                <select id="select_grupo_feedback" name="GrupoSelect">
                </select>
                <label for="file">Entrega:</label>
                <a href="">link da submissao de cada grupo - clicar deveria fazer download</a>
                <label class="form-label">Descrição</label>
                <textarea class="form-text-area" type="text" name="feedback-text" required></textarea>
            </p>
            <input type="submit" id="confirmFeedback" value="Confirmar">
        </form>

        <form id="etapa-form">

            <p id="etapa" class="etapa">
                <label id="etapa-label" class="form-label-title">Nova etapa:</label>
                <label class="form-label">Nome</label>
                <input class="form-input-text" type="text" name="etapaName" required>
                <label class="form-label">Descrição</label>
                <textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>
                <label for="file">Enunciado:</label>
                <input class="form-input-file" type="file" id="file_etapa" name="file">
                <label class="form-label">Data de entrega</label>
                <input class="form-input-text" type="datetime-local" name="etapaDate" required>
            </p>
            <p>
                <div id="errormsg" class="submit-msg">Mensagem de erro template</div>
            </p>

            <input type="submit" id="newEtapa" value="Criar">
            <input type="submit" id="newEtapaEDIT" value="Confirmar">
        </form>


    </div>
    </main>