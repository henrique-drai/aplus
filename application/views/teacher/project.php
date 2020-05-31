<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/project/project-global.js"></script>
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
    <p> 
        <?php echo $project[0]["description"]; ?>
        <br><br>
        Número mínimo de elementos num grupo: <?php echo $project[0]["min_elementos"]; ?>
        <br>
        Número máximo de elementos num grupo: <?php echo $project[0]["max_elementos"]; ?>
        <br><br>
    </p>
    <input id="removeProject" class="remove" type="button" value="Eliminar projeto">
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <!-- <h3 id="enunciado_title">Enunciado:</h3>
        
         -->
        <h3 id="enunciado_h4"></h3>
        <!-- <div id="removeDiv"></div> -->

        <input id="openEnunc" type="submit" value="Adicionar enunciado">
        
        <div class="wrapper-top">

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

            <div class="cd-popup2" id="popup-geral">
                <div class="cd-popup-container" id="container-geral">

                    <div class="inputs-div">
                        <h3>Etapa</h3>
                        <h3>Descrição:</h3>
                        <label></label>
                        <h3>Enunciado: </h3>
                        <label id="enunciado_label"></label>
                    </div>

                    <div id="forms">
                        <?php echo form_open_multipart('UploadsC/uploadEnunciadoEtapa', 'id="form-upload-etapa"');?>
                            <br>
                            <input class="form-input-file" type="file" id="file_etapa" name="file_etapa" accept=".pdf">
                            <label for="file_etapa" class="input-label">
                                <img id="file-img-etapa" class="file-img" src="<?php echo base_url(); ?>images/icons/upload-solid.png">
                                <span id="name-enunciado-etapa" class="span-name">Envie o ficheiro do enunciado</span>
                            </label>
                            <p class="msg-warning-size"><b>Tamanho máximo de ficheiro é de 5MB</b></p>
                        </form>

                        <form id="feedback-form">
                            <div id="feedback-div">
                                <label class="form-label-title">Selecione o grupo</label>
                                <select id="select_grupo_feedback" name="GrupoSelect">
                                </select>
                                <label for="file" class="form-label-title">Entrega:</label>
                                <p id="sub_url">Entrega ainda não foi submetida</p>
                                <label class="form-label-title">Feedback dado:</label>
                                <p id="fb_content">Ainda não atribuiu feedback a esta etapa</p>
                                <label class="form-label-title">Dar feedback:</label>
                                <textarea class="form-text-area" type="text" name="feedback-text" disabled required></textarea>
                            </div>
                        </form>

                        <form id="etapa-form-edit" action="javascript:void(0)">
                            <div id="etapa-edit">
                                <label id="etapa-label-edit" class="form-label-title"></label>
                                <label class="form-label-title">Nome</label>
                                <input class="form-input-text" type="text" name="editetapaName" required>
                                <label class="form-label-title">Descrição</label>
                                <textarea class="form-text-area" type="text" name="editetapaDescription" required></textarea>
                                <label class="form-label-title">Data de entrega</label>
                                <input class="form-input-date" type="datetime-local" name="editetapaDate" required>
                            </div>
                        </form>

                        <div class="wrapper">
                            <hr>
                            <input id="addEtapaEnunciado" class="addE" type="button" value="Enunciado">
                            <input id="editEtapaButton" class="editb" type="button" value="Editar">
                            <input id="feedbackEtapaButton" class="feedbackb" type="button" value="Feedback">
                            <input id="removeEtapaButton" class="remove" type="button" value="Eliminar">
                            <br>
                        </div>

                        <div id="successmsgenunc" class="submit-msg">Mensagem de sucesso template</div>
                        <div id="errormsgenunc" class="submit-msg">Mensagem de erro template</div>
                        <div id="successmsg_editar" class="submit-msg">Etapa editada com sucesso</div>
                        <div id="errormsgedit" class="submit-msg">Mensagem de erro template</div>
                        <div id="successmsgfb" class="submit-msg">Mensagem de sucesso template</div>
                        <div id="errormsgfb" class="submit-msg">Mensagem de erro template</div>

                        <ul class="cd-buttons" id="ul-buttons">
                            <li><a href="#" id="id-generico">Submeter</a></li>
                            <li><a href="#" id="closeButton-hide">Cancelar</a></li>
                        </ul>
                    </div>
                    <a class="cd-popup-hide"></a>
              </div>
            </div>


            <!-- Pop up com form do criar nova etapa, criado logo à mao -->
       


            <!-- usar cdpopup2 para os que se escondem -->
            <!-- POP UP JÁ ESTÁ COMO O NOVO. ATENÇÃO ÀS CLASSES E IDS DOS BUTTONS -->
            <!--    SE O POPUP FOR GERADO PELO MAKEPOPUP, USAR O CLOSE NORMAL, CASO CONTRARIO USAR -HIDE -->
            <div class="cd-popup2" id="etapa-form-popup">
                <div class="cd-popup-container">
                    <form id="etapa-form" action="javascript:void(0)">
                       <div class="inputs-popup" id="etapa">
                            <label id="etapa-label" class="form-label-title">Nova etapa:</label>
                            <label class="form-label">Nome</label>
                            <input class="form-input-text" type="text" name="etapaName" required>
                            <label class="form-label">Descrição</label>
                            <textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>
                            <label class="form-label">Data de entrega</label>
                            <input class="form-input-date" type="datetime-local" name="etapaDate" required>
                        </div>
               
                        <div id="successmsg_criar" class="submit-msg">Etapa criada com sucesso</div>
                        <div id="errormsg" class="submit-msg">Mensagem de erro template</div>
                
                        <ul class="cd-buttons" id="ul-buttons-etapa">
                            <li><a href="#" id="newEtapa">Submeter</a></li>
                            <li><a href="#" id="closeButton-hide">Cancelar</a></li>
                        </ul>
                    </form>
                    <a class="cd-popup-hide"></a>
                </div>
            </div>


            <div class="cd-popup2" id="enunciado-popup">
                <div class="cd-popup-container">
                <?php echo form_open_multipart('UploadsC/uploadEnunciadoProjeto', "id='enunciado-form'");?>
                        <div class="inputs-popup">
                            <label class="form-label-title">Escolher um enunciado para o projeto</label>
                            <br>
                            <input class="form-input-file" type="file" id="file_projeto" name="file_proj" title="Escolher enunciado" accept=".pdf">
                            <label for="file_projeto" class="input-label">
                                <img id="file-img" class="file-img" src="<?php echo base_url(); ?>images/icons/upload-solid.png">
                                <span id="name-enunciado-proj" class="span-name">Envie o ficheiro do enunciado</span>
                            </label>
                            <p class="msg-warning-size"><b>Tamanho máximo de ficheiro é de 5MB</b></p>
                        </div>


                        <div id="projenuncsucc" class="submit-msg">Enunciado submetido com sucesso</div>
                        <div id="projenuncerror" class="submit-msg">Tem de selecionar um ficheiro</div>


                        <ul class="cd-buttons" id="ul-buttons-enunc">
                            <li><a href="#" id="addEnunciado">Submeter</a></li>
                            <li><a href="#" id="closeButton-hide">Cancelar</a></li>
                        </ul>
                </form>
                <a class="cd-popup-hide"></a>
                </div>
            </div>
            
            
        </div>



    <br><br>
    </div>
    </main>