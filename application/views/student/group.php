<title>A+ for Students</title>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-subject.css"> -->
<script>setPageName("group")</script>
<script src="<?php echo $base_url; ?>js/student/rating_page.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app/student/rating">Rating</a> > <a href="<?php echo base_url(); ?>app/student/group">Grupo</a> </h4>
     
        <div class="container">
        
            <div class="header">
                <!-- <h2 id="SubjectName">Cadeira: </h2> -->
                <h2 id="groupName">Grupo: </h2>
            </div>

            <br>
            
            <h2>Membros:</h2>
            <div class="membros"></div>


        </div>

    </main>