<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/window-date-picker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/teacher-newproject.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/window-date-picker.min.js"></script>
<script src="<?php echo $base_url; ?>js/project/project-global.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/projectNEW.js"></script>
<script>setSubjectID("<?php echo $subject->id; ?>")</script>
<script>setProjectPage("<?php echo $base_url; ?>" + "projects/project/")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
<main>
<h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year; ?>"><?php echo $subject->name; ?></a> &gt; Criar Projeto </h4>
    <h1>Novo projeto para a cadeira <?php echo $subject->name; ?></h1>
    <div class="container">
        <div class="container-header">
            <h3>Preencha todos os campos</h3>
        </div>

        <form id="projForm" class="project-form"  action="javascript:void(0)">
            <p>
                <label class="form-label">Nome do Projeto:</label>
                <input class="form-input-text" type="text" name="projName" required>
            </p>

            <p class="pminmax">
                <label class="form-label">Número de alunos por grupo:</label>
                <input id="minnuminput" class="form-input-number" type="number" name="groups_min" min="1" placeholder="Mínimo" required>
                <input id="maxnuminput" class="form-input-number" type="number" name="groups_max" min="1" placeholder="Máximo" required>
            </p>

            <p>
                <label class="form-label">Descrição:</label>
                <textarea class="form-text-area" type="text" name="projDescription" required></textarea>
            </p>

            <p>
                <!-- <label class="form-label">Etapas:</label> -->
                <h3>Etapas:</h3>
                <label id="addEtapa"><img src="<?php echo $base_url; ?>/images/add.png"></label>
            </p>

            <div id="etapa1" class="etapa">
                <label id="etapa-label" class="form-label-title">Etapa 1</label>
                <div id="inputsduo">
                    <label class="form-label">Nome
                        <input class="form-input-text" type="text" name="etapaName" required>
                    </label>
                    <label class="form-label" id="date-picker-label">Data de entrega
                        <input class="form-input-text" id="datepicker1" name="etapaDate" autocomplete="off" readonly="readonly" required>
                        <div id="placeholder-picker1"></div>
                    </label>
                </div>

                <label class="form-label">Descrição</label>
                <textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>
            </div>

            <p>
                <div id="errormsg" class="submit-msg">Mensagem de erro template</div>
            </p>

            <div class="btn-wrap">
                <input type="submit" id="createProjectButton" value="Criar">
            </div>

        </form>
    </div>   
    </main>