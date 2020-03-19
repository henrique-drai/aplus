<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/users.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/users.css">
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Utilizadores</h1>
        <h4>Painel de Controlo</h4>

        <section class="flex-section">
            
            <div class="admin-users-window">
                <div class="title">Registar</div>
                <form id="register-form" action="javascript:void(0)">
                    <label for="name">Nome:</label>
                    <input type="text" name="name">
                    <label for="surname">Apelido:</label>
                    <input type="text" name="surname">
                    <label for="email">Email:</label>
                    <input type="text" name="email">
                    <label for="password">Password:</label>
                    <input type="password" name="password">
                    <label for="role">Role:</label>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                    <br>

                    <input type="submit" id="register-form-submit">
                </form>
            </div>


            <div class="admin-users-window">
                <div class="title">Migrações</div>
                <form id="exportCsv" action="<?php echo base_url(); ?>admin/api/saveCSV">
                    <input type="submit" id="exportInfo" value="Exportar Utilizadores">
                </form>
            </div>

        </section>

    
    </main>
