<title>A+ for Admins</title>
<script>setPageName("subject")</script>
<script src="<?php echo $base_url; ?>js/admin/subject.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-subjects.css">
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> <a href="<?php echo base_url(); ?>app/admin/subjects"> > Unidades Curriculares </a> > Unidade Curriculare</h4>

        <h1 id="adminCadeira"></h1>

        <form id="addStudent-form" action="javascript:void(0)">
            <p>
                <label for="alunoemail">Email do Aluno:</label>
                <input id="search_add_aluno_cadeira" type="text" name="alunoemail" required>
            </p>
        </form>
        <div id="alunos-subject-sugestao">
        </div>
        <div id="msgStatus">
        </div>
        <div id="msgErro">
        </div>
        <div id="aluno-subject-container" class="container">
        </div> 

        

        <div class="cd-popup" role="alert" id="student_subject_admin_delete">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o aluno da Unidade Curricular?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

        


    </main>