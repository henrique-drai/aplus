<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/forum/forum.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/forum/forum.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>subjects">Unidades Curriculares</a> > 
            <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a>
            &gt; Fórum
        </h4>
        <div class="container">
            <h2>Fórum: <span class="forumName"></span></h2>

            <div>
                <p><b>Descrição:</b> <span class="forumDesc"></span></p>
            </div>

            <br>
            <h3>Tópicos:</h3>

            <div class="remove_button"></div>

            <div class="message">Adicionado com sucesso!</div>

            <div class="threadTable"></div>

            <div id="popups"></div>

            <div class="add"></div>
        </div>

    </main>