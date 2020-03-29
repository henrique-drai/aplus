<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/students-list.css">
<script>setPageName("studentsList")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/student-list.js"></script>

</head>
<body>
    <div id="nav-menu-hook"></div>
    <main>
        
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

        <br><br>

        <h3>Consultar alunos por:</h3>

        <form id="consultar_aluno" action="">
            <select id="consultar_aluno" name="consultarAluno">
                <option value="">Selecione uma opção</option>
                <option value="Curso">Por Curso</option>
            </select>
            <input type="submit" id="consultar-btn" value="Consultar">     
        </form>

        <br><br>

        <table id="show_studs">
            <tr>
                <th>Nome</th>
                <th>Apelido</th>
                <th>Curso</th> 
            </tr>
            
        </table>

    </main>
