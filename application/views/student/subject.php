<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-subject.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/student/subject_page.js"></script>
<script>setID(<?php echo $subject->id; ?>)</script>
<script>setCode("<?php echo $subject->code; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a></h4>
        <div class="container">
            <div id="subject_title"></div>
        
            <div class="header">
                <h2>Sumário da Cadeira</h2>
            </div>
            <div class="summary"></div>

            <br>

            <h2>Fóruns</h2>
            <div class="foruns"></div>
            
            <h2>Projetos</h2>
            <div class="projetos"></div>

            <div class="hours_header">
                <h2>Horário de Dúvidas</h2>
            </div>
            <div class="hours"></div>
        </div>

    </main>