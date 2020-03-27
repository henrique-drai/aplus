<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/home.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/home.css">
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Painel de Controlo</h1>
        <section class="admin-stats">
            <div class="admin-stats-window" id="users-hook">
                <div class="admin-stats-title">Utilizadores</div>
                <div class="admin-stats-content">
                    Professores: <span id="hook-num_teachers"></span>
                    <br>
                    Alunos: <span id="hook-num_students"></span>
                </div>
                <div class="admin-stats-btn">
                    
                    <a href="<?php echo $base_url; ?>app/admin/users"><div>Gerir</div></a>
                </div>
            </div>

            <div class="admin-stats-window" id="unis-hook">
                <div class="admin-stats-title">Faculdades</div>
                <div class="admin-stats-content">
                    Faculdades: <span id="hook-num_colleges"></span>
                </div>
                <div class="admin-stats-btn">
                <a href="<?php echo $base_url; ?>app/admin/college"><div>Gerir</div></a>
                </div>
            </div>


            <div class="admin-stats-window" id="courses-hook">
                <div class="admin-stats-title">Cursos</div>
                <div class="admin-stats-content">
                    Cursos: <span id="hook-num_courses"></span>
                </div>
                <div class="admin-stats-btn">
                <a href="<?php echo $base_url; ?>app/admin/courses"><div>Gerir</div></a>
                </div>
            </div>
        </section>
    </main>
