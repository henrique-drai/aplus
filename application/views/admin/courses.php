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
        <h1>Courses</h1>


        <h3>Registar Curso</h3>

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

        <div class='overlay'>
            <div class='popup'>
                <a class='close' href='#'>&times;</a>
                <div class='content'>
                    <h2>Editar Curso</h2>
                    <form id="editCourse-form" action="javascript:void(0)">
                    <p>
                        <label for="codCourse">Código Curso</label>
                        <input type="text" name="codCourse" required>
                    </p><p>
                        <label for="name">Nome</label>
                        <input type="text" name="name" required>
                    </p><p>
                        <label for="academicYear">Ano Letivo</label>
                        <input type="text" name="academicYear" required>
                    </p><p>
                        <label for="description">Descrição</label>
                        <!-- <input type="text" name="description" required> -->
                        <textarea name="description" id="descriptionTA" cols="30" rows="3" required></textarea>
                    </p><p>
                        <input type="submit" id="editCourse-form-submit" required>
                    </form>
                </div>
            </div>
        </div>

    </main>