<title><?php echo $course->name; ?></title>
<script>setPageName("courses")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <h2>Alterem esta página para ser a página de cadeira.</h2>
    <h3><?php echo $course->name; ?></h3>
    <?php echo $course->description; ?>
    </main>