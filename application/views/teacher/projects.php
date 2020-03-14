<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("projects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/project-teacher.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <h1>Suposto ser acedido pela página de cada cadeira!</h1>
    
    <div class="form-container">
        <div class="form-container-header">
            <h2>Criar novo projeto</h2>
        </div>

        <form id="projForm" class="project-form"  action="javascript:void(0)">
            <p>
                <label class="form-label">Nome do Projeto:</label>
                <input class="form-input-text" type="text" name="projName" required>
            </p>

            <p>
                <label class="form-label">Número mínimo de alunos por grupo:</label>
                <input id="minnuminput" class="form-input-number" type="number" name="groups_min" min="1" required>
            </p>

            <p>
                <label class="form-label">Número máximo de alunos por grupo:</label>
                <input id="maxnuminput" class="form-input-number" type="number" name="groups_max" min="1" required>
            </p>

            <p>
                <label class="form-label">Descrição:</label>
                <input class="form-input-text" type="text" name="projDescription">
            </p>

            <p>
                <label for="file">Ficheiro do enunciado:</label>
                <input type="file" id="file" name="file" required>
            </p>

            <p>
                <label class="form-label">Etapas:</label>
                <label id="addEtapa">+</label>
            </p>

            <p id="etapa1" class="etapa">
                <label class="form-label">Nome</label>
                <input class="form-input-text" type="text" name="etapaName" required>
                <label class="form-label">Descrição</label>
                <input class="form-input-text" type="text" name="etapaDescription" required>
                <label class="form-label">Data de entrega</label>
                <input class="form-input-text" type="date" name="etapaDate" required>
            </p>


            <div>
                <button type="submit" id="createProjectButton" class="form-button">Criar</button>
            </div>

        </form>
    </div>   
    </main>

 