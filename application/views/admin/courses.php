<title>A+ for Admins</title>
<script>setPageName("courses")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-subjects.css">


<script src="<?php echo $base_url; ?>js/admin/registerCurso.js"></script>

</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Cursos</h4>
        <h1>Registar Curso</h1>

        <form id="register-cursos-form" action="javascript:void(0)">
        <p>

            <label for="codeCurso">Código de Curso:</label>
            <input type="text" name="codeCurso" required>
        </p>
        <p>
            <label for="nomeCurso">Nome de Curso:</label>
            <input type="text" name="nomeCurso" required>
        </p>
        <p>
            <label for="descCurso">Descrição de Curso:</label>
            <input type="text" name="descCurso" required>
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

        <div id="msgErro">
        </div>


        <h3>Consultar cursos de uma faculdade</h3>
        <select id="consultar_cursos_faculdade" name="consultarCadeirasporFaculdade">
        </select>

        <br><br>
        <div id="course-container" class="container">
        </div>

          
        <br>
       
        <div id="msgErro2">
        </div>

        <div class="cd-popup" role="alert" id="courses_admin_delete">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o ano letivo?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

        <div class="cd-popup" role="alert" id="courses_admin_edit">
	        <div class="cd-popup-container">
                <form id="editCourse-form" action="javascript:void(0)">
                <div class="editCourse_inputs">
                    <h2>Editar Curso</h2>
                    <label for="codCourse">Código Curso</label>
                    <input type="text" name="codCourse" required>
                    <label for="name">Nome</label>
                    <input type="text" name="name" required>
                    <label for="academicYear">Ano Letivo</label>
                    <input type="text" name="academicYear" required>
                    <label for="description">Descrição</label>
                    <textarea name="description" id="descriptionTA" cols="70" rows="10" required></textarea>
                </div>
                <div id="msgErroEditar">
                </div>
                <ul class="cd-buttons">
                    <li><a href="#" id="editCourse-form-submit">Submeter</a></li>
                    <li><a href="#" id="closeButton">Cancelar</a></li>
                </ul>
                </form>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>


    </main>