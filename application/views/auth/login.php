<title>Login</title>
<script src="<?php echo $base_url; ?>js/auth/login.js"></script>
</head>

<body>
    <h1>Login do A+</h1>
    <p>Neste momento, só temos um user, que tem acesso a tudo o que está na API.</p>
    <form id="login-form" action="javascript:void(0)">
        <label for="username">Email</label>
        <input type="text" name="username" value="Test">
        <label for="password">Password</label>
        <input type="password" name="password" value="test">
        <input type="submit" id="login-form-submit">
    </form>

    
    