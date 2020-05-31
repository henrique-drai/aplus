<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/home.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/home.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/styles.css">
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>

        <h4 class="breadcrumb">Painel de Controlo</h4>
        <br>
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
                <a href="<?php echo $base_url; ?>app/admin/registerCourses"><div>Gerir</div></a>
                </div>
            </div>


            <div class="admin-stats-window" id="years-hook">
                <div class="admin-stats-title">Ano Letivo</div>
                <div class="admin-stats-content">
                    Ano Letivo: <span id="hook-num_academicYear"></span>
                </div>
                <div class="admin-stats-btn">
                <a href="<?php echo $base_url; ?>app/admin/anoLetivo"><div>Gerir</div></a>
                </div>
            </div>

            <div class="admin-stats-window" id="subjects-hook">
                <div class="admin-stats-title">Unidades Curriculares</div>
                <div class="admin-stats-content">
                    Unidades Curriculares: <span id="hook-num_subjects"></span>
                </div>
                <div class="admin-stats-btn">
                <a href="<?php echo $base_url; ?>app/admin/subjects"><div>Gerir</div></a>
                </div>
            </div>
        </section>
    </main>
