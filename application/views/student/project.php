<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/student-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/student/project.js"></script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4>
    <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
    <p> <?php echo $project[0]["description"]; ?></p>
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h3"></h3>
        <div class="container-header">
            <br><br>
            <!-- Mostramos em baixo o grupo se já tiver grupo ou a criação dos grupos no caso de não ter
                ficando a criação ao criterio do ye -->
            <h2 id="grupo-name">Grupo</h2>
        </div>

        <div id="grupos-container" class="container">
        </div>

        <!-- Criação de grupos - @ye -->

        <br><br>

        <h2>Etapas</h2>
        <div id="etapas-container" class="container">
            <div id="etapas-container2"></div>
        </div>

        <!-- Nesta etapa info mostramos só as infos e o feedback de cada etapa se houver ou botao de submit-->
        <div id="etapa-info-extra"> 
        </div>


    </div>
    </main>