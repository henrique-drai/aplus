<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/project.js"></script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
<script>setEnunciado("<?php echo addslashes($project[0]["enunciado_url"]); ?>")</script>
<script>setBackPage("<?php echo $base_url; ?>" + "subjects/subject/" + "<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>")</script>

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4>
    <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
    <p> <?php echo $project[0]["description"]; ?></p>
    <input id="removeProject" class="remove" type="button" value="Eliminar projeto">
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h3"></h3>
        <div class="wrapper-top">
            <?php echo form_open_multipart('UploadsC/uploadEnunciadoProjeto', "id='form-upload-proj'");?>
                <input class="form-input-file" type="file" id="file_projeto" name="file_proj" title="Escolher enunciado" accept=".pdf">
                <input id="addEnunciado" type="submit" value="Adicionar enunciado">
            </form>
        </div>
        <div class="container-header">
            <br><br>
            <h2>Grupos</h2>
        </div>

        <div id="grupos-container" class="container">
            <div id="grupos-container2"></div>
        </div>

        <br><br>

        <h2>Etapas</h2>
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
                <p id="sub_url">Entrega ainda não foi submetida</p>
                <label class="form-label">Descrição</label>
                <textarea class="form-text-area" type="text" name="feedback-text" required></textarea>
            </p>
            <p>
                <div id="successmsgfb" class="submit-msg">Mensagem de sucesso template</div>
                <div id="errormsgfb" class="submit-msg">Mensagem de erro template</div>
            </p>
            <input type="submit" id="confirmFeedback" onclick="return false" value="Confirmar">
        </form>


        <?php echo form_open_multipart('UploadsC/uploadEnunciadoEtapa', 'id="form-upload-etapa"');?>
                <label id="letapa" for="file">Enunciado:</label>
                <input class="form-input-file" type="file" id="file_etapa" name="file_etapa" accept=".pdf">
                <input id="addEnuncEtapa" type="submit" value="Adicionar enunciado">
        </form>

        <form id="etapa-form" action="javascript:void(0)">

            <p id="etapa" class="etapa">
                <label id="etapa-label" class="form-label-title">Nova etapa:</label>
                <label class="form-label">Nome</label>
                <input class="form-input-text" type="text" name="etapaName" required>
                <label class="form-label">Descrição</label>
                <textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>
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