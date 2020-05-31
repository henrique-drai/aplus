<title>A+ for Admins</title>
<script>setPageName("registerCourses")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-subjects.css">
<script src="<?php echo $base_url; ?>js/admin/registerCurso.js"></script>

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>

        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Cursos</h4>

        <h1>Registar Cursos!</h1>

        <form id="register-cursos-form" action="javascript:void(0)">
        <p>
            <label for="codeCurso">Código de Curso:</label>
            <input type="text" name="codeCurso" required>
        </p>
        <p>
            <label for="nomeCurso">Nome de Curso:</label>
            <input class="notSmallInput" type="text" name="nomeCurso" required>
        </p>
        <p>
            <label for="descCurso">Descrição de Curso:</label>
            <input class="notSmallInput"type="text" name="descCurso" required>
        </p>
        <p>
            <label for="academicYear">Ano Letivo:</label>
            <select id="consultar_anos_letivos" name="academicYear">
            </select>
        </p>
        <p>
            <label for="college">Faculdade:</label>
            <select id="faculdades_register_UnidCurricular" name="faculdade">
            </select>
        </p>

            <input type="submit" id="register-course-submit">
        </form><br>

        <div id="msgStatus">
        </div>
    </main>