<title>A+ for Admins</title>
<script>setPageName("teachers")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-users.css">
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageUsers.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Professores</h1>
    
        <table id="show_teachers">
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
    </main>