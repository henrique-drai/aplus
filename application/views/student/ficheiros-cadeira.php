<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/ficheiros.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/ficheiros-cadeira.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/student/ficheiros-cadeira.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year; ?>"><?php echo $subject->name; ?></a> &gt; Ficheiros </h4>
    <h2>Área de ficheiros da cadeira "<?php echo $subject->name; ?>"<h2>

    <h3>Ficheiros:</h3>
    <div class="container" id="container-ficheiros">
        <div class="file-div" id="show-files-div">
            <div class="file-row" id="file-row-aluno">
                 <!-- template, isto sera adicionado em js -->
                <p><a href="">nome-do-ficheiro-grande-e-tal.pdf</a></p>
            </div>
            <hr>
        </div>
    </div>
