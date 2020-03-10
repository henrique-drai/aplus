<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("projects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/project-teacher.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <h1>Página dos projetos! No futuro é suposto ser acedido pela página de cada cadeira!!!!!</h1>
    
    <div class="form-container">
        <div class="form-container-header">
            <h2>Criar novo projeto</h2>
        </div>

        <form class="project-form" method="post" enctype="multipart/form-data">
            <p>
                <label class="form-label">Nome do Projeto:</label>
                <input class="form-input-text" type="text" name="projName">
            </p>

            <p>
                <label class="form-label">Número de alunos por grupo:</label>
                <input class="form-input-number" placeholder="Mínimo" type="number" name="groups_min" min="1">
                <input class="form-input-number" placeholder="Máximo" type="number" name="groups_max" min="1">
            </p>

            <p>
                <label class="form-label">Descrição:</label>
                <input class="form-input-text" type="text" name="projDescription">
            </p>

            <p>
                <label for="file">Ficheiro do enunciado:</label>
                <input type="file" id="file" name="file" multiple>
            </p>

            <p>
                <label class="form-label">Etapas:</label>
                <label id="addEtapa">+</label>
            </p>

            <p class="etapa">
                <label class="form-label">Nome</label>
                <input class="form-input-text" type="text" name="etapaName">
                <label class="form-label">Descrição</label>
                <input class="form-input-text" type="text" name="etapaDescription">
                <label class="form-label">Data de entrega</label>
                <input class="form-input-text" type="date" name="etapaDate">
            </p>


            <div>
                <button type="submit" id="createProject" class="form-button">Criar</button>
            </div>

        </form>
    </div>   



    </main>

 