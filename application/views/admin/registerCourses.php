<title>A+ for Admins</title>
<script>setPageName("registerCourses")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerCurso.js"></script>

</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <form id="register-cursos-form" action="javascript:void(0)">

            <label for="codeCurso">Código de Curso:</label><br>
            <input type="text" name="codeCurso" required><br>


            <label for="nomeCurso">Nome de Curso:</label><br>
            <input type="text" name="nomeCurso" required><br>

            <label for="descCurso">Descrição de Curso:</label><br>
            <input type="text" name="descCurso" required><br>

            <label for="academicYear">Ano Letivo:</label>
            <select id="consultar_anos_letivos" name="academicYear">
            </select>
            
            <br>
            <label for="college">Faculdade:</label>
            <select id="faculdades_register_UnidCurricular" name="faculdade">
            </select>


            <input type="submit" id="register-course-submit">
        </form><br>

        <div id="msgStatus">
        </div>
    </main>