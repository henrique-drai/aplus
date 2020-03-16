<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-course.css">
<script>setPageName("courses")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/course_page.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        
        <div id="course_title"></div>
        <div class="form-container">
            <div id="header">
                <h2>Sumário da Cadeira</h2>
                <a href="#" class="button" id="edit_button">Editar</a>
            </div>
            <div id="summary"></div>

            <a href="#" class="button" id="save_button">Guardar</a>

            <br><br>

            <a class="button">Fórum</a>
            <a class="button">Lista de Alunos</a>

            <br><br>
            
            <a href="<?php echo $base_url; ?>app/teacher/projects" class="button">Criar Projeto</a>
            <a class="button">Projeto 1 *buscar se existir algum projeto*</a>

            <br><br>

            <h2>Horário de Dúvidas</h2>
            <div id="hours"></div>
        </div>
    </main>