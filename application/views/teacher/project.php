<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/window-date-picker.min.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/teacher/teacher-projects.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/pagination-min.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/projects/projects-general.css">
<script src="<?=$base_url?>js/window-date-picker.min.js"></script>
<script src="<?=$base_url?>js/pagination.min.js"></script>
<script src="<?=$base_url?>js/project/project-global.js"></script>
<script src="<?=$base_url?>js/teacher/project.js"></script>
<script>setPageName("subjects")</script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
<script>setEnunciado("<?php echo addslashes($project[0]["enunciado_url"]); ?>")</script>
<script>setEnunciadoOriginal("<?php echo addslashes($project[0]["enunciado_original"]); ?>")</script>
<script>setBackPage("<?=$base_url?>" + "subjects/subject/" + "<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>")</script>
<script>setMsg("<?php echo $msg["msg"]; ?>", "<?php echo $msg["type"]; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>

<main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4>
    <div id="successm" class="submit success">Mensagem de sucesso template</div>
    <div id="errorm" class="submit error">Mensagem de erro template</div>
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

    <input id="removeProject" class="remove" type="button" value="Eliminar projeto">
    <h3 id="entrega_h3"></h3>
    <h3 id="enunciado_h4"></h3>

    
    <input id="openEnunc" type="button" value="Adicionar enunciado">

    <!-- grupos -->
    <div class="container-header">
        <br><br>
        <h2>Grupos</h2>
    </div>

    <div id="grupos-container" class="container">
        <div id="grupos-container2"></div>
    </div>

    <br><br><br>

    <!-- etapas  -->
    <h2>Etapas</h2>
    <div id="etapas-container" class="container">
        <div id="etapas-container2"></div>
    </div>

    <!-- Popups -->
    <div id="popups">
        <?php $this->view('templates/popup'); ?>
    </div>
    
    <br><br>
</main>


