<title>A+ for Admins</title>
<script>setPageName("college")</script>
<script src="<?php echo $base_url; ?>js/admin/registerCollege.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageCollege.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/college.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Faculdades</h4>

        <h1>Registar Faculdade!</h1>

        <form id="register-faculdade-form" action="javascript:void(0)">
        <p>
            <label for="nomefaculdade">Nome da Faculdade:</label>
            <input type="text" name="nomefaculdade" required>
        </p>
        <p>
            <label for="morada">Morada:</label>
            <input type="text" name="morada" required>
        </p>
        <p>
            <label for="siglas">Sigla da Faculdade:</label>
            <input type="text" name="siglas" required>
        </p>
            <input type="submit" id="register-college-submit">
            <div id="msgStatus">
            </div>
            <div id="msgErro">
            </div>
        </form><br>

        <div id="msgStatusDelete">
        </div>
        <div id="msgErroDelete">
        </div>
        <div id="college-container" class="container">
        </div>

        

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar a faculdade?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>


    </main>