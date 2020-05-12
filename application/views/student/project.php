<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/student-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
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
    <p> <?php echo $project[0]["description"]; ?></p>
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_title">Enunciado:</h3>
        <h4 id="enunciado_h4"></h4>
        <div class="container-header">
            <br><br>
            <!-- Mostramos em baixo o grupo se já tiver grupo ou a criação dos grupos no caso de não ter
                ficando a criação ao criterio do ye -->
            <h2 id="grupo-name">Grupo</h2>
        </div>

        <div id="grupos-container" class="container">
        </div>         <!-- Criação de grupos - @ye -->

        <br><br>

        <h2>Etapas</h2>
        <div id="etapas-container" class="container">
            <div id="etapas-container2"></div>
        </div>

        <div id="popups">

          <div class="overlay" id="etapa-overlay">
            <div class="popup" id="etapa-popup">
            <a class="close" href="#">&times;</a>
              <div class="content">
                <h3>Descrição:</h3>
                <label></label>
                <h3>Enunciado: </h3>
                <label id="enunciado_label"></label>
                <h3>Submissão: </h3>
                <label id="sub_label"></label>
                <h3>Feedback: </h3>
                <label id="feedback_label"></label>
                <div class="wrapper">
                    <hr>
                    <input id="submitEtapa" type="button" value="Submeter etapa">
                </div>

                <div id=forms>
                    <?php echo form_open_multipart('UploadsC/uploadSubmissao', 'id="form-submit-etapa"');?>
                        <label id="letapa" for="file">Entrega:</label>
                        <input class="form-input-file" type="file" id="file_submit" name="file_submit" accept=".zip,.rar">
                        <p>
                            <div class="submit-msg">Mensagem de sucesso template</div>
                            <div class="submit-msg">Mensagem de erro template</div>
                        </p>
                        <input id="addSubmission" type="submit" value="Enviar submissão">
                    </form>
                </div>
               </div>
              </div>
            </div>
    </div>
    </main>