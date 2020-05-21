<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/subjects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/student/subject_page.js"></script>
<script>setID(<?php echo $subject->id; ?>)</script>
<script>setCode("<?php echo $subject->code; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Unidades Curriculares</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a></h4>
        <div class="container">
            <div id="subject_title"></div>
            
            <div class="grid">
                <div class="item1">
                    <div class="header">
                        <h2>Sumário da Unidade Curricular</h2>
                    </div>
                    <div class="summary"></div>
                    <input type="button" class="filearea-button" value="Área de ficheiros">
                </div>

                <br>

                <div class="item2">
                    <h2>Fóruns</h2>
                    <div class="foruns"></div>
                </div>
                    
                <div class="item3">
                    <h2>Projetos</h2>
                    <div class="projetos"></div>
                </div>

                <div class="item4">
                    <div class="hours_header">
                        <h2>Horário de Dúvidas</h2>
                    </div>
                    <div class="hours"></div>
                    <div class="message" id="message_hour_s">Adicionado ao calendário!</div>
                </div>
            </div>
        </div>

    </main>