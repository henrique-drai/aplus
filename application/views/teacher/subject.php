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
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a></h4>
        <div class="container">
            <div id="subject_title">
                <h1><?php echo $subject->name; ?></h1>
            </div>
        
            <div class="grid">
                <div class="item1">
                    <div class="header">
                        <h2>Sumário da Cadeira</h2>
                        <a id="edit_button"><img src="<?php echo base_url(); ?>/images/icons/edit.png"></a>
                    </div>
                    <div class="summary"></div>

                    <input type="button" id="save_button" value="Guardar">

                    <div class="message" id="message1">Editado com sucesso!</div>

                    <input type="button" class="studentsList_button" value="Lista de Alunos"> 
                </div>

                <div class="item2">
                    <h2>Fóruns</h2>
                    <a class="new_forum"><img src="<?php echo base_url(); ?>/images/icons/create.png"></a>
                    <div class="foruns"></div>
                </div>

                <div class="item3">
                    <h2>Projetos</h2>
                    <a class="newProject_button"><img src="<?php echo base_url(); ?>/images/icons/create.png"></a>
                    <div class="projetos"></div>
                </div>
                
                <div class="item4">
                    <div class="hours_header">
                        <h2>Horário de Dúvidas</h2>
                        <div class="save_edit">
                            <a id="edit_button_hours"><img src="<?php echo base_url(); ?>/images/icons/edit.png"></a>
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
                    <input type="button" id="save_button_hours" value="Guardar">
                </div>
            </div>

        </div>

    </main>