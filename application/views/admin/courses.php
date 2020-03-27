<title>A+ for Admins</title>
<script>setPageName("courses")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerCurso.js"></script>

</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Courses</h1>

        <h3>Consultar cursos de uma faculdade</h3>
        <select id="consultar_cursos_faculdade" name="consultarCadeirasporFaculdade">
        </select>

        <br><br>
        <table id="show_courses">
            <tr>
                <th>Código de Curso</th>  
                <th>Nome</th>
                <th>Descrição</th>
                
            </tr>
            
        </table>

    </main>