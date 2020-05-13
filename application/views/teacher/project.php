<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
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
        <h3 id="enunciado_title">Enunciado:</h3>
        <div id="removeDiv"></div>
        <h4 id="enunciado_h4"></h4>
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

        <br><br><br>

        <h2>Etapas</h2>
        <div id="etapas-container" class="container">
            <div id="etapas-container2"></div>
        </div>

        <!-- Popups gerados em js -->
        <div id="popups">

          <div class="overlay" id="etapa-overlay">
            <div class="popup" id="etapa-popup">
            <a class="close" href="#">&times;</a>
              <div class="content">
                <h3>Descrição:</h3>
                <label></label>
                <h3>Enunciado: </h3>
                <label id="enunciado_label"></label>
                <div class="wrapper">
                    <hr>
                    <input id="addEtapaEnunciado" class="addE" type="button" value="Adicionar Enunciado">
                    <input id="editEtapaButton" class="editb" type="button" value="Editar">
                    <input id="feedbackEtapaButton" class="feedbackb" type="button" value="Feedback">
                    <input id="removeEtapaButton" class="remove" type="button" value="Eliminar">
                </div>

                <div id=forms>
                    <?php echo form_open_multipart('UploadsC/uploadEnunciadoEtapa', 'id="form-upload-etapa"');?>
                        <label id="letapa" for="file" class="form-label-title">Enunciado:</label>
                        <input class="form-input-file" type="file" id="file_etapa" name="file_etapa" accept=".pdf">
                        <p>
                            <div id="successmsgenunc" class="submit-msg">Mensagem de sucesso template</div>
                            <div id="errormsgenunc" class="submit-msg">Mensagem de erro template</div>
                        </p>
                        <input id="addEnuncEtapa" type="submit" value="Adicionar enunciado">
                    </form>

                    <form id="feedback-form">
                        <p>
                            <label class="form-label-title">Selecione o grupo</label>
                            <select id="select_grupo_feedback" name="GrupoSelect">
                            </select>
                            <label for="file" class="form-label-title">Entrega:</label>
                            <p id="sub_url">Entrega ainda não foi submetida</p>
                            <label class="form-label-title">Feedback dado:</label>
                            <p id="fb_content">Ainda não atribuiu feedback a esta etapa</p>
                            <br>
                            <label class="form-label-title">Dar feedback:</label>
                            <textarea class="form-text-area" type="text" name="feedback-text" required></textarea>
                        </p>
                        <p>
                            <div id="successmsgfb" class="submit-msg">Mensagem de sucesso template</div>
                            <div id="errormsgfb" class="submit-msg">Mensagem de erro template</div>
                        </p>
                        <input type="submit" id="confirmFeedback" onclick="return false" value="Confirmar">
                    </form>

                    <form id="etapa-form-edit" action="javascript:void(0)">
                        <p id="etapa-edit">
                            <label id="etapa-label-edit" class="form-label-title"></label>
                            <label class="form-label">Nome</label>
                            <input class="form-input-text" type="text" name="editetapaName" required>
                            <label class="form-label">Descrição</label>
                            <textarea class="form-text-area" type="text" name="editetapaDescription" required></textarea>
                            <label class="form-label">Data de entrega</label>
                            <input class="form-input-text" type="datetime-local" name="editetapaDate" required>
                        </p>
                        <p>
                            <div id="errormsgedit" class="submit-msg">Mensagem de erro template</div>
                        </p>

                        <input type="submit" id="newEtapaEDIT" value="Confirmar">
                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Pop up com form do criar nova etapa, criado logo à mao -->
       
        <div class="overlay" id="etapa-overlay-new">
            <div class="popup" id="etapa-form-popup">
            <a class="close" href="#">&times;</a>
                <div class="content">
                    <form id="etapa-form" action="javascript:void(0)">
                        <p id="etapa">
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
                    </form>
                </div>
            </div>
        </div>


    </div>
    </main>