<title>A+ for Teachers</title>
<script>setPageName("subjects")</script>

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <!-- <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year[0]["inicio"]; ?>"><?php echo $subject->name; ?></a> &gt; Projeto </h4> -->
    <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>
    <p> <?php echo $project[0]["description"]; ?></p>
    <div class="container">
        <h3 id="entrega_h3"></h3>
        <h3 id="enunciado_h4"></h3>
    </div>
    </main>