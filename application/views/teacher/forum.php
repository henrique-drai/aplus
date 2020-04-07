<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-forum.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/forum.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > 
            <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a>
            &gt; Fórum
        </h4>
        <div class="container">
            <h2>Fórum: <span class="forumName"></span></h2>

            <div>
                <p><b>Descrição:</b> <span class="forumDesc"></span></p>
            </div>

        </div>

    </main>