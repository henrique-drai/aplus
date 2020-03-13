<title>A+ for Admins</title>
<script>setPageName("home")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-users.css">
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/getAllTeachers.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageUsers.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <h1>Professores</h1>
    </main>
    <table id="show_teachers">
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Editar</th>
            <th>Apagar</th>
        </tr>
        
    </table>
    <form id="editUser-form" action="javascript:void(0)">
        <label for="name">Name</label><br>
        <input type="text" name="name"><br>
        <label for="surname">Surname</label><br>
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

        <input type="submit" id="editUser-form-submit">
    </form><br>