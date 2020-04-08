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

            <div class="threadTable"></div>
            <input type="button" id="add_button" value="Criar Tópico">

            <div class="overlay">
                <div class="popup">
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <h2>Criar novo tópico</h2>
                        <form id="threadForm" class="thread-form"  action="javascript:void(0)">
                            <p>
                                <label class="form-label">Nome do Fórum:</label>
                                <input class="form-input-text" type="text" name="threadName" required>
                            </p>

                            <p>
                                <label class="form-label">Descrição:</label>
                                <textarea class="form-text-area" type="text" name="threadDescription" required></textarea>
                            </p>

                            <input type="button" id="popup_button" value="Criar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>