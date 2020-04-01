<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-subject.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/student/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/student/subject_page.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>

        <div class="container">
            <div id="subject_title"></div>
        
            <div class="header">
                <h2>Sumário da Cadeira</h2>
            </div>
            <div class="summary"></div>

            <br>

            <div class="buttons">
                <input type="button" class ="forum" value="Fórum">
            </div>

            <br>
            
            <h2>Projetos</h2>
            <div class="projetos"></div>

            <div class="hours_header">
                <h2>Horário de Dúvidas</h2>
            </div>
            <div class="hours"></div>
        </div>

    </main>