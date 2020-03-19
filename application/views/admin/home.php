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
                <div class="admin-stats-title">Users</div>
                <div class="admin-stats-content">
                    Registered Teachers: <span id="hook-num_teachers"></span>
                    <br>
                    Registered Students: <span id="hook-num_students"></span>
                </div>
                <div class="admin-stats-btn">
                    
                    <a href="<?php echo $base_url; ?>app/admin/users"><div>Manage</div></a>
                </div>
            </div>

            <div class="admin-stats-window" id="unis-hook">
                <div class="admin-stats-title">Colleges</div>
                <div class="admin-stats-content">
                    Registered Colleges: <span id="hook-num_colleges"></span>
                </div>
                <div class="admin-stats-btn">
                <a href="<?php echo $base_url; ?>app/admin/college"><div>Manage</div></a>
                </div>
            </div>
        </section>
    </main>
