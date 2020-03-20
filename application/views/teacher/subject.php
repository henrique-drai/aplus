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
            <div id="header">
                <h2>Sumário da Cadeira</h2>
                <a href="#" class="button" id="edit_button">Editar</a>
                <div class="message">Editado com sucesso!</div>
            </div>
            <div id="summary"></div>

            <a href="#" class="button" id="save_button">Guardar</a>

            <br><br>

            <a class="button">Fórum</a>
            <a href="<?php echo $base_url; ?>app/teacher/studentsList" class="button">Lista de Alunos</a>

            <br><br>
            
            <a href="<?php echo $base_url; ?>projects/new/<?php echo $subject->code; ?>" class="button">Criar Projeto</a>
            <a class="button">Projeto 1 *buscar se existir algum projeto*</a>

            <br><br>

            <div id="hours_header">
                <h2>Horário de Dúvidas</h2>
                <a href="#" class="button" id="edit_button_hours">Editar</a>
                <div class="message" id="message_hour">Editado com sucesso!</div>
            </div>
            <div id="hours"></div>

            <div id="hours_inputs">
                <label id="add_hour"><img src="<?php echo $base_url; ?>/images/add.png"></label>
                <label id="remove_hour"><img src="<?php echo $base_url; ?>/images/close.png"></label>
                <br>
            </div>

            <a href="#" class="button" id="save_button_hours">Guardar</a>
        </div>

    </main>