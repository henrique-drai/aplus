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
        
        <div class="container">
            <table id="students_list">
                <tr>
                    <th>Email</th>
                    <th>Nome</th> 
                    <th>Apelido</th> 
                </tr>
            </table>
        </div>

        <br>

        <div id="msg-sem-alunos"></div>

    </main>
