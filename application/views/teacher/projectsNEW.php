<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/projectNEW.js"></script>
<script>setSubjectID("<?php echo $subject->id; ?>")</script>
<script>setProjectPage("<?php echo $base_url; ?>" + "projects/project/")</script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <div class="container">

        <h1>Novo projeto para a cadeira <?php echo $subject->name; ?></h1>
    
        <div class="container-header">
            <a class="back-a" href="<?php echo $base_url; ?>subjects/subject/<?php echo $subject->code; ?>"  class="button">Back</a>
            <h3>Preencha todos os campos</h3>
        </div>

        <form id="projForm" class="project-form"  action="javascript:void(0)">
            <p>
                <label class="form-label">Nome do Projeto:</label>
                <input class="form-input-text" type="text" name="projName" required>
            </p>

            <p class="pminmax">
                <label class="form-label">Número de alunos por grupo:</label>
                <input id="minnuminput" class="form-input-number" type="number" name="groups_min" min="1" placeholder="Mínimo" required>
                <input id="maxnuminput" class="form-input-number" type="number" name="groups_max" min="1" placeholder="Máximo" required>
            </p>

            <p>
                <label class="form-label">Descrição:</label>
                <textarea class="form-text-area" type="text" name="projDescription" required></textarea>
            </p>

            <p>
                <label for="file">Ficheiro do enunciado:</label>
                <input class="form-input-file" type="file" id="file" name="file" required>
            </p>

            <p>
                <label class="form-label">Etapas:</label>
                <label id="addEtapa"><img src="<?php echo $base_url; ?>/images/add.png"></label>
            </p>

            <p id="etapa1" class="etapa">
                <label id="etapa-label" class="form-label-title">Etapa 1</label>
                <label class="form-label">Nome</label>
                <input class="form-input-text" type="text" name="etapaName" required>
                <label class="form-label">Descrição</label>
                <textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>
                <label class="form-label">Data de entrega</label>
                <input class="form-input-text" type="datetime-local" name="etapaDate" required>
            </p>

            <p>
                <div id="errormsg" class="submit-msg">Mensagem de erro template</div>
                <!-- <div id="successmsg" class="submit-msg">Projeto adicionado com sucesso</div> -->
            </p>

            <div class="btn-wrap">
                <button type="submit" id="createProjectButton" class="form-button">Criar</button>
            </div>

        </form>
    </div>   
    </main>