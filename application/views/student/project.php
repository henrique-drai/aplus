<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/student-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/project/project-global.js"></script>
<script src="<?php echo $base_url; ?>js/student/project.js"></script>
<script src="<?php echo $base_url; ?>js/student/criarGrupos.js"></script>
<script>setEnunciado("<?php echo addslashes($project[0]["enunciado_url"]); ?>")</script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4>
    <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
    <p> 
        <?php echo $project[0]["description"]; ?>
        <br><br>
        Número mínimo de elementos num grupo: <?php echo $project[0]["min_elementos"]; ?>
        <br>
        Número máximo de elementos num grupo: <?php echo $project[0]["max_elementos"]; ?>
        <br><br>
    </p>
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h4"></h3>
        <div class="container-header">
            <br><br>
            <h2 id="grupo-name">Grupo</h2> <span class="criarGrupo"><img src="<?php echo base_url(); ?>images/add.png" id="criarGrupo_button"></span>
            <div id="criarGrupoName">
            </div>
        </div>

        <div id="grupos-container" class="container">
            <div id="grupos-container2"></div>
            <div id="msgStatus">
            </div>
        </div>       

        <br><br>

        <h2>Etapas</h2>
        <div id="etapas-container" class="container">
            <div id="etapas-container2"></div>
        </div>

        <div id="popups">

        <div class="cd-popup2" id="popup-geral">
            <div class="cd-popup-container" id="container-geral">
                <div class="inputs-div">
                    <h3>Etapa</h3>
                    <h3>Descrição:</h3>
                    <label></label>
                    <h3>Enunciado: </h3>
                    <label id="enunciado_label"></label>
                    <h3>Submissão: </h3>
                    <label id="sub_label"></label>
                    <h3>Feedback: </h3>
                    <label id="feedback_label"></label>
                </div>
                <div class="wrapper">
                    <hr>
                    <div id="erro-entrega" class="submit-msg">A data de entrega foi ultrapassada.</div>
                    <div id="no-group-erro" class="submit-msg">Para fazer submissões é necessário estar inscrito num grupo.</div>
                </div>

                <div id="forms">
                    <?php echo form_open_multipart('UploadsC/uploadSubmissao', 'id="form-submit-etapa"');?>
               
                        <input class="form-input-file" type="file" id="file_submit" name="file_submit" accept=".zip,.rar,.pdf,.docx">
                        <label for="file_submit" class="input-label">
                            <img id="file-img-submit" src="<?php echo base_url(); ?>images/icons/upload-solid.png">
                            <span id="name-file-submit">Submeter etapa do projeto</span>
                        </label>
                        <p class="msg-warning-size"><b>Tamanho máximo de ficheiro é de 5MB</b></p>
                        <!-- <input id="addSubmission" type="submit" value="Confirmar"> -->
                    </form>
                    <div id="enviado-sucesso" class="submit-msg">Etapa submetida com sucesso.</div>
                    <div id="enviado-erro" class="submit-msg">Tem de selecionar um ficheiro.</div>
                    
                    <ul class="cd-buttons" id="ul-buttons">
                        <li><a href="#" id="addSubmission">Submeter</a></li>
                        <li><a href="#" id="closeButton-hide">Cancelar</a></li>
                    </ul>

                </div>
                <a class="cd-popup-hide"></a>
            </div>
        </div>
    
    <br><br>
    </div>
    </main>