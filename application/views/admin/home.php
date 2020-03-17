<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/home.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/home.css">
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <section class="admin-stats">
            <div class="admin-stats-window" id="users-hook">
                <div class="admin-stats-title">Users:</div>
                <div class="admin-stats-content">
                Registed Teachers: <span id="hook-num_teachers"></span>
                <br>
                Registed Students: <span id="hook-num_students"></span>
                </div>
                <div class="admin-stats-btn">Manage</div>
            </div>

            <div class="admin-stats-window" id="unis-hook">
                <div class="admin-stats-title">Universities:</div>
                <div class="admin-stats-content">
                </div>
                <div class="admin-stats-btn">Manage</div>
            </div>
        </section>
    </main>
