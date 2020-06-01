<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/subjects.css">
<script>setPageName("subjects")</script>
<script>setRole("student")</script>
<script src="<?php echo $base_url; ?>js/subjects.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>subjects">Unidades Curriculares</a>
        </h4>
        <div class="container">
            <div class="cadeiras">
                <div class="filter">
                    <input class="filter_dropdown" type="button" value="Filtrar">
                    <div class="dropdown-content">
                        <a class="filter_button" id="abc" href="#">Ordem Alfabética</a>
                        <a class="filter_button" id="last" href="#">Último Acesso</a>
                    </div>
                </div>

                <div class="semestre1"></div>
                <div class="semestre2"></div>
            </div>
        </div>
    </main>