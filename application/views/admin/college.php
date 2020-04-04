<title>A+ for Admins</title>
<script>setPageName("college")</script>
<script src="<?php echo $base_url; ?>js/admin/registerCollege.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageCollege.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/college.css">

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Faculdades</h4>

        <h1>Registar Faculdade!</h1>

        <form id="register-faculdade-form" action="javascript:void(0)">
            <label for="nomefaculdade">Nome da Faculdade:</label>
            <input type="text" name="nomefaculdade">
            <label for="morada">Morada:</label>
            <input type="text" name="morada">
            <label for="siglas">Siglas da Faculdade:</label>
            <input type="text" name="siglas">

            <input type="submit" id="register-college-submit">
        </form><br>

        <div id="msgStatus">
        </div>

        <h2>Consultar Faculdades</h2>
        <table id="show_colleges">
            <tr>
                <th>Nome</th>
                <th>Localizacao</th>
                <th>Siglas</th>
                <th></th>
            </tr>
            
        </table>

        <div id="msgStatusDelete">
        </div>

    </main>