<title>A+ Profile</title>
<script>setPageName("profile")</script>
<script src="<?php echo $base_url; ?>js/<?php echo $this->session->role; ?>/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/profile.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/profile.css">
</head>

<body>
    <div id="nav-menu-hook"></div>

    <main>
        <h1>Perfil do utilizador com email <?php echo $user->email; ?></h1>
        Listar info sobre este utilizador, sem deixar editar.

    </main>