<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-thread.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/thread.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > 
            <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>"><?php echo $subject->name; ?></a> >
            <a href="<?php echo base_url(); ?>foruns/forum/<?php echo $forum->id; ?>"><?php echo $forum->name; ?></a> >
            <a href="<?php echo base_url(); ?>foruns/forum/<?php echo $thread->id; ?>"><?php echo $thread->title; ?></a>
        </h4>
        <div class="container">
            <h2>Tópico: <span class="threadName"></span></h2>

            <div>
                <p><b>Descrição:</b> <span class="threadDesc"></span></p>
            </div>

            <div class="message">Adicionado com sucesso!</div>
            <div id="popups"></div>

            <div class="threads"></div>

            <input type="button" id="create_post_button" value="Criar novo post">

            <div class="overlay">
                <div class="popup">
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <h2>Criar novo post</h2>
                        <form id="threadForm" class="thread-form"  action="javascript:void(0)">
                            <p>
                                <label class="form-label">Conteúdo:</label>
                                <textarea class="form-text-area" type="text" name="threadDescription" required></textarea>
                            </p>

                            <input type="button" id="popup_button" value="Criar">
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </main>