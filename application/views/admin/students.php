<title>A+ for Admins</title>
<script>setPageName("students")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<script src="<?php echo $base_url; ?>js/admin/manageUsers.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>    <main>
        <h1>Estudantes</h1>
        
        <table id="show_students">
            <tr>
                <th>Email</th>
                <th>Nome</th>
                <th>Apelido</th>
                <th>Editar</th>
                <th>Apagar</th>
            </tr>
            
        </table>
        <form id="editUser-form" action="javascript:void(0)">
            <label for="name">Nome</label>
            <input type="text" name="name">
            <label for="surname">Apelido</label>
            <input type="text" name="surname">
            <label for="email">Email</label>
            <input type="text" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">
            <label for="role">Role</label>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <br>

            <input type="submit" id="editUser-form-submit">
        </form><br>
        
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
        <div id="msgStatus">
        </div>
        
    </main>