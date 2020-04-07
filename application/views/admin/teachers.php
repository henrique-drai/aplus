<title>A+ for Admins</title>
<script>setPageName("teachers")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<script src="<?php echo $base_url; ?>js/admin/manageUsers.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>   
    <div id="teacher-container" class="container">
        </div> 
       
        <form id="editUser-form" action="javascript:void(0)">
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
        </form><br>
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