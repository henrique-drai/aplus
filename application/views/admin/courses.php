<title>A+ for Admins</title>
<script>setPageName("courses")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-users.css">
<script src="<?php echo $base_url; ?>js/admin/registerCurso.js"></script>

</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>
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

        <form id="editCourse-form" action="javascript:void(0)">
            
            <label for="codCourse">Código Curso</label>
            <input type="text" name="codCourse" required>
                        
            
            <label for="name">Nome</label>
            <input type="text" name="name" required>
            
            <label for="description">Descrição</label>
            <input type="text" name="description" required>

            <br>
            <input type="submit" id="editCourse-form-submit" required>

        </form>   
        
        <div id="msgStatus">
        </div>

    </main>