<title>A+ for Admins</title>
<script>setPageName("registerUser")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerUser.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <h1>Registar User!</h1>

    <form id="register-form" action="javascript:void(0)">
        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="surname">Surname</label>
        <input type="text" name="surname">
        <label for="email">Email</label>
        <input type="text" name="email">
        <label for="password">Password</label>
        <input type="password" name="password">
        <label for="role">Role</label>
        <input type="text" name="role">

        <input type="submit" id="register-form-submit">
    </form>

    </main>
