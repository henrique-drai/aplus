<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/project.js"></script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
<script>setEnunciado("<?php echo $project[0]["enunciado_url"]; ?>")</script>
<script>setBackPage("<?php echo $base_url; ?>" + "subjects/subject/" + "<?php echo $subject->code; ?>")</script>

</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <div class="container">
        <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h3"></h3>
        <div class="container-header">
            <div class="wrapper">
                <input class="form-input-file" type="file" id="file_projeto" name="file_proj" title="Escolher enunciado">
                <input id="addEnunciado" type="button" value="Adicionar enunciado">
            </div>
            <input type="button" id="back" value="Voltar">
            <input id="removeProject" class="remove" type="button" value="Eliminar projeto">
            <h3>Grupos</h3>
        </div>

        <div class="container">
            <table id="groups_list"></table>
        </div>

        <h3>Etapas</h3>
        <div id="etapas-container" class="container">
        </div>

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o projeto?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

        <div id="etapa-info-extra">
        </div>

        <div class="buttons-container">
            <input id="opennewEtapa" type="button" value="Criar etapa">
        </div>

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