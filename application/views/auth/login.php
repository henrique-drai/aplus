<title>Login</title>
<script src="<?php echo $base_url; ?>js/auth/login.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/login.css">
</head>

<body>
    <main>
        <h1>A+ Login</h1>
        <form id="login-form" action="javascript:void(0)">
            <label for="email">Email</label>
            <input type="text" name="email" value="admin@mail">
            <label for="password">Password</label>
            <input type="password" name="password" value="admin">
            <input type="submit" id="login-form-submit">
        </form>
    </main>
    
    