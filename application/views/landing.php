<title>Login</title>
<script src="<?=$base_url?>js/auth/login.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/landing.css">
</head>

<body>
    <main>
        <!-- <img src="<?=$base_url?>images/logo.png" id="imgLogo"> -->
        <form id="login-form" action="javascript:void(0)">
            <label for="email">Email</label>
            <input type="text" name="email" value="admin@mail">
            <label for="password">Password</label>
            <input type="password" name="password" value="admin">
            <div class="error-msg">A combinação que inseriu é inválida.</div>
            <input type="submit" id="login-form-submit" value="Login">
        </form>
    </main>