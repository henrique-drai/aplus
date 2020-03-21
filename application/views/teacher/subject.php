<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-subject.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/subject_page.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        
        <div id="subject_title"></div>
        <div class="form-container">
            <div class="header">
                <h2>Sumário da Cadeira</h2>
                <a href="#" class="button" id="edit_button">Editar</a>
                <div class="message" id="message1">Editado com sucesso!</div>
            </div>
            <div class="summary"></div>

            <a href="#" class="button" id="save_button">Guardar</a>

            <br>

            <a class="button">Fórum</a>
            <a href="<?php echo $base_url; ?>app/teacher/studentsList" class="button">Lista de Alunos</a>

            <br><br>
            
            <h2>Projetos</h2>
            <a href="<?php echo $base_url; ?>projects/new/<?php echo $subject->code; ?>" class="button">Criar Projeto</a>
            <div class="projetos"></div>

            <div class="hours_header">
                <h2>Horário de Dúvidas</h2>
                <a href="#" class="button" id="edit_button_hours">Editar</a>
                <div class="message" id="message_hour">Editado com sucesso!</div>
                <a href="#" class="button" id="save_button_hours">Guardar</a>
            </div>
            <div class="hours"></div>

            <div class="hours_inputs">
                <label class="add_hour"><img src="<?php echo $base_url; ?>/images/add.png"></label>
                <label class="remove_hour"><img src="<?php echo $base_url; ?>/images/close.png"></label>
                <br>
            </div>

            
        </div>

    </main>