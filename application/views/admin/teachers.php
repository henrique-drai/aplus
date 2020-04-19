<title>A+ for Admins</title>
<script>setPageName("teachers")</script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/styles.css">

<script src="<?php echo $base_url; ?>js/admin/manageUsers.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>   
        <h1>Professores</h1>
        
        <div class="form-group">
            <div class="input-group">
                <h2>Procurar Professores</h2>
                <input type="text" name="search_text" id="search_text_profs" placeholder = "Procurar Professores pelo email, nome ou apelido" class="form-control"/>
                <p class="informacaoUsers">Use * para visualizar todos os professores</p>
            </div>
        </div>

        <div id="teacher-container" class="container">
        </div> 
        <div class='overlay'>
            <div class='popup'>
                <a class='close' href='#'>&times;</a>
                <div class='content'>
                    <h2>Editar Professor</h2>
                    <form id="editUser-form" action="javascript:void(0)">
                    <p>
                        <label for="name" class='form-label'>Nome</label>
                        <input type="text" name="name" required>
                    </p><p>
                        <label for="surname" class='form-label'>Apelido</label>
                        <input type="text" name="surname" required>
                    </p><p>
                        <label for="email" class='form-label'>Email</label>
                        <input type="text" name="email" required>
                    </p><p>
                        <label for="password" class='form-label'>Password</label>
                        <input type="password" name="password">
                    </p><p>
                        <input type="submit" id="editUser-form-submit">
                    </form>
                </div>
            </div>
        </div>
                    
        
        <!-- <form id="editUser-form" action="javascript:void(0)">
        <p>
            <label for="name">Nome</label>
            <input type="text" name="name" required>
        </p><p>
            <label for="surname">Apelido</label>
            <input type="text" name="surname" required>
        </p><p>
            <label for="email">Email</label>
            <input type="text" name="email" required>
        </p><p>
            <label for="password">Password</label>
            <input type="password" name="password">
        </p><p>
            <input type="submit" id="editUser-form-submit">
        </form><br> -->
        <div class="cd-popup" role="alert">
            <div class="cd-popup-container">
                <p>Tem a certeza que deseja eliminar o professor?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
                <a class="cd-popup-close"></a>
            </div>
        </div>
        <div id="msgStatus">
        </div>
    </main>