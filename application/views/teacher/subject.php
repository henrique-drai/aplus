<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-subject.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/subject_page.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a></h4>
        <div class="container">
            <div id="subject_title"></div>
        
            <div class="header">
                <h2>Sumário da Cadeira</h2>
                <input type="button" id="edit_button" value="Editar">
                <div class="message" id="message1">Editado com sucesso!</div>
            </div>
            <div class="summary"></div>

            <input type="button" id="save_button" value="Guardar">

            <br>

            <input type="button" class="studentsList_button" value="Lista de Alunos"> 

            <h2>Fóruns</h2>
            <input type="button" class ="new_forum" value="Criar Fórum">
            <div class="foruns"></div>

            <br>
            
            <h2>Projetos</h2>
            <input type="button" class="newProject_button" value="Criar Projeto">
            <div class="projetos"></div>

            <div class="hours_header">
                <h2>Horário de Dúvidas</h2>
                <div class="save_edit">
                    <input type="button" id="edit_button_hours" value="Editar">
                    <input type="button" id="save_button_hours" value="Guardar">
                </div>
                <div class="message" id="message_hour">Editado com sucesso!</div>
            </div>
            <div class="hours"></div>

            <div class="hours_buttons">
                <label class="add_hour"><img src="<?php echo $base_url; ?>/images/add.png"></label>
                <label class="remove_hour"><img src="<?php echo $base_url; ?>/images/close.png"></label>
                <br>
            </div>

            <div class="hours_inputs"></div>

        </div>

    </main>