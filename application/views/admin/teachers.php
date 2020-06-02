<title>A+ for Admins</title>
<script>setPageName("teachers")</script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">

<script src="<?php echo $base_url; ?>js/admin/manageUsers.js"></script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>   
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Professores</h4>
        <br>
        <div class="form-group">
            <div class="input-group">
                <h2>Procurar Professores</h2>
                <input type="text" name="search_text" id="search_text_profs" placeholder = "Procurar Professores pelo email, nome ou apelido" class="form-control"/>
                <p class="informacaoUsers">Use * para visualizar todos os professores</p>
            </div>
        </div>

        <div id="teacher-container" class="container">
            <table class="adminTable" id="student_list"> 
                <tr>
                    <th>Email</th>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Editar</th>
                    <th>Apagar</th>
                </tr>
            </table>
        </div> 
        
        <div class="cd-popup" role="alert" id="users_admin_edit">
	        <div class="cd-popup-container">
                
                <form id="editUser-form" action="javascript:void(0)">
                <div class="editUser_inputs">
                <h2>Editar Professor</h2>
                    <label for="name" class='form-label'>Nome</label>
                    <input type="text" name="name" required>
                    <label for="surname" class='form-label'>Apelido</label>
                    <input type="text" name="surname" required>
                    <label for="email" class='form-label'>Email</label>
                    <input type="text" name="email" required>
                    <label for="password" class='form-label'>Password</label>
                    <input type="password" name="password">
                </div>
                <div id="msgErroEditar">
                </div>
                <ul class="cd-buttons">
                    <li><a href="#" id="editUser-form-submit">Submeter</a></li>
                    <li><a href="#" id="closeButton">Cancelar</a></li>
                </ul>
                </form>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>



        <div class="cd-popup" role="alert" id="users_admin_delete">
            <div class="cd-popup-container">
                <p>Tem a certeza que deseja eliminar o professor?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
                <a class="cd-popup-close"></a>
            </div>
        </div>
        <div id="msgSemAlunos">
        </div>
    </main>