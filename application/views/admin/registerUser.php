<title>A+ for Admins</title>
<script>setPageName("registerUser")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerUser.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Registar Utilizador!</h1>

        <form id="register-form" action="javascript:void(0)">
            <label for="name">Nome:</label><br>
            <input type="text" name="name"><br>
            <label for="surname">Apelido</label><br>
            <input type="text" name="surname"><br>
            <label for="email">Email</label><br>
            <input type="text" name="email"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password"><br>
            <label for="role">Role</label><br>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <br><br>

            <input type="submit" id="register-form-submit">
        </form><br>

        <h3>TODO:</h3>
        <ul>
            <li>Importar utilizadores</li>
            <li>Exportar utilizadores</li>
        </ul>


        <form id="exportCsv" action="<?php echo base_url(); ?>api/admin/saveCSV">
            <input type="submit" id="exportInfo" value="Exportar Users">
        </form><br>
    
    </main>
