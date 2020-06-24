<title>A+ for Admins</title>
<script>setPageName("courses")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-subjects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">

<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerCurso.js"></script>

</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Cursos</h4>
        <h2>Registar Curso</h2>

        <form id="register-cursos-form" action="javascript:void(0)">
        <div class="double_input">

            <label for="codeCurso">
                Código de Curso:
                <input type="text" name="codeCurso" required>
            </label>
            <label for="academicYear">
                Ano Letivo:
                <select id="consultar_anos_letivos" name="academicYear"></select>
            </label>
        </div>
        <div>
            <label for="nomeCurso">Nome de Curso:</label>
            <input class="notSmallInput" type="text" name="nomeCurso" required>
        </div>
        <div>
            <label for="descCurso">Descrição de Curso:</label>
            <textarea class="notSmallInput" type="text" name="descCurso" required></textarea>
        </div>

        <div>
            <label for="college">Faculdade:</label>
            <select id="faculdades_register_UnidCurricular" name="faculdade">
            </select>
        </div>

            <input type="submit" id="register-course-submit">
        </form><br>

        <div id="msgStatus">
        </div>

        <div id="msgErro">
        </div>


        <h3>Consultar cursos de uma faculdade</h3>
        <select id="consultar_cursos_faculdade" name="consultarCadeirasporFaculdade">
        
        </select>

        <br>
        <div id="course-container" class="container">
            <div id="msgStatusEditar">
            </div>
            <table class="adminTable" id="show_courses">
                <tr><th>Código de Curso</th>
                <th>Nome</th>
                <th>Ano Letivo</th>
                <th>Descrição</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </table>
        </div>

          
        <br>
       
        <div id="msgErro2">
        </div>

        <div class="cd-popup" role="alert" id="courses_admin_delete">
	        <div class="cd-popup-container">
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