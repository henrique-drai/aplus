<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/projects/projects-general.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/student-projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/project/project-global.js"></script>
<script src="<?php echo $base_url; ?>js/student/project.js"></script>
<script src="<?php echo $base_url; ?>js/student/criarGrupos.js"></script>
<script>setEnunciado("<?php echo addslashes($project[0]["enunciado_url"]); ?>")</script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4>
    <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
    <p> 
        <?php echo $project[0]["description"]; ?>
        <br><br>
        Número de elementos por grupo: 
            <?=$project[0]["min_elementos"]?>
            <?php if($project[0]["min_elementos"] != $project[0]["max_elementos"]): ?>
                 - <?=$project[0]["max_elementos"]?>
            <?php endif; ?>
        <br><br>
    </p>
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h4"></h3>
        <div class="container-header">
            <br><br>
            <!-- mudar depois para o novo botao da ines s -->
            
            <h2 id="grupo-name">Grupo</h2>  <span class="criarGrupo"><img src="<?php echo base_url(); ?>images/add.png" id="criarGrupo_button"></span>
            <input id="areagrupo" type="button" value="Área de Grupo"> 
            <div id="criarGrupoName">
            </div>
        </div>

        <div id="grupos-container" class="container">
            <div id="grupos-container2"></div>
            <div id="msgStatus">
            </div>
        </div>       

        <br><br>

        <h2>Etapas</h2>
        <div id="etapas-container" class="container">
            <div id="etapas-container2"></div>
        </div>

        <div id="popups">
            <?php $this->view('templates/popup'); ?>
        </div>
            
    <br><br>
    </div>
    </main>