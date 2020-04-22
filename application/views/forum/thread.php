<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/forum/thread.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/forum/thread.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > 
            <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> >
            <a href="<?php echo base_url(); ?>foruns/forum/<?php echo $forum->id; ?>"><?php echo $forum->name; ?></a> >
            <a href="<?php echo base_url(); ?>foruns/thread/<?php echo $thread->id; ?>"><?php echo $thread->title; ?></a>
        </h4>
        <div class="container">
            <h2>Tópico: <span class="threadName"></span></h2>

            <div>
                <p><b>Descrição:</b> <span class="threadDesc"></span></p>
            </div>

            <div class="message">Adicionado com sucesso!</div>
            <div id="popups"></div>

            <div class="threads"></div>

            <div class="add"></div>
        </div>

    </main>