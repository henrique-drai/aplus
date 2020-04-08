<title>A+ for Admins</title>
<script>setPageName("courses")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
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
        <div id="course-container" class="container">
        </div>

        <form id="editCourse-form" action="javascript:void(0)">
        <p>
            <label for="codCourse">Código Curso</label>
            <input type="text" name="codCourse" required>
        </p>                
        <p>   
            <label for="name">Nome</label>
            <input type="text" name="name" required>
        </p>
        <p>
            <label for="academicYear">Ano Letivo</label>
            <input type="text" name="academicYear" required>
        </p>
        <p>    
            <label for="description">Descrição</label>
            <input type="text" name="description" required>
        </p>
      
            <input type="submit" id="editCourse-form-submit" required>
        </form>   
        <br>
        <div id="msgStatus">
        </div>

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o ano letivo?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

    </main>