<title><?php echo $subject->name; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/forum/forum.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/new_forum.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > 
            <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year; ?>"><?php echo $subject->name; ?></a>
            &gt; Criar Fórum 
        </h4>
        <div class="container">
            <h2>Criar novo fórum</h2>

            <form id="forumForm" class="forum-form"  action="javascript:void(0)">
                <p>
                    <label class="form-label">Nome do Fórum:</label>
                    <input class="form-input-text" type="text" name="forumName" required>
                </p>

                <p>
                    <label class="form-label">Descrição:</label>
                    <textarea class="form-text-area" type="text" name="forumDescription" required></textarea>
                </p>

                <p>
                    <label class="form-label">Só professores podem criar tópicos neste fórum?</label>
                    <select>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </p>

                <div class="btn-wrap">
                    <input type="submit" id="createForumButton" value="Criar">
                </div>
            </form>
        </div>

    </main>