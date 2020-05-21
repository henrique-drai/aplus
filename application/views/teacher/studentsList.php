<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/students-list.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/student-list.js"></script>
</head>
<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year; ?>"><?php echo $subject->name; ?></a> &gt; Lista de Alunos </h4>

        <h1>Lista de Alunos</h1>

        <div class="form-group">
            <div class="input-group">
                <h2>Procurar Estudantes</h2>
                <input type="text" name="search_text" id="search_text_students" placeholder = "Procurar Estudantes pelo email, nome ou apelido" class="form-control"/>
            </div>
        </div>
        
        <div class="container">
            <table id="students_list">
            </table>
        </div>

        <br>

        <div id="msg-sem-alunos"></div>

    </main>
