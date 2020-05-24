<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/ficheiros.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/ficheiros-cadeira.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/student/ficheiros-cadeira.js"></script>
<script>setCadeira("<?php echo $subject->id; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year; ?>"><?php echo $subject->name; ?></a> &gt; Ficheiros </h4>
    <h2>Área de ficheiros da cadeira "<?php echo $subject->name; ?>"<h2>

    <h3>Ficheiros:</h3>
    <div class="container" id="container-ficheiros">
        <div class="file-div" id="show-files-div">
            <hr>
        </div>
    </div>
