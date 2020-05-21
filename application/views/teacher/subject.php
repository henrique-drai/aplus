<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/subjects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/subject_page.js"></script>
<script>setID(<?php echo $subject->id; ?>)</script>
<script>setCode("<?php echo $subject->code; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Unidades Curriculares</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a></h4>
        <div class="container">
            <div id="subject_title">
                <h1><?php echo $subject->name; ?></h1>
            </div>
        
            <div class="grid">
                <div class="item1">
                    <div class="header">
                        <h2>Sumário da Unidade Curricular  <span><img src="<?php echo base_url(); ?>/images/icons/edit.png" id="edit_button"></span></h2>
                    </div>
                    <div class="summary"></div>

                    <input type="button" id="save_button" value="Guardar">

                    <div class="message" id="message1">Editado com sucesso!</div>

                    <input type="button" class="studentsList_button" value="Lista de Alunos"> 
                    <input type="button" class="filearea-button" value="Área de ficheiros">
                </div>

                <div class="item2">
                    <h2>Fóruns  <span><img src="<?php echo base_url(); ?>/images/icons/create.png" class="new_forum"></span></h2>
                    <div class="foruns"></div>
                </div>

                <div class="item3">
                    <h2>Projetos  <span><img src="<?php echo base_url(); ?>/images/icons/create.png" class="newProject_button"></span></h2>
                    <div class="projetos"></div>
                </div>
                
                <div class="item4">
                    <div class="hours_header">
                        <h2>Horário de Dúvidas  <span><img src="<?php echo base_url(); ?>/images/icons/edit.png" id="edit_button_hours"></span></h2>
                    </div>
                    <div class="hours"></div>

                    <div class="hours_buttons">
                        <label class="add_hour"><img src="<?php echo $base_url; ?>/images/add.png"></label>
                        <label class="remove_hour"><img src="<?php echo $base_url; ?>/images/close.png"></label>
                        <br>
                    </div>

                    <div class="hours_inputs"></div>
                    <input type="button" id="save_button_hours" value="Guardar">

                    <div class="message" id="message_hour">Editado com sucesso!</div>
                </div>
            </div>

        </div>

    </main>