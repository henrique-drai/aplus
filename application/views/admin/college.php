<title>A+ for Admins</title>
<script>setPageName("college")</script>
<script src="<?php echo $base_url; ?>js/admin/manageCollege.js"></script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/college.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Faculdades</h4>

        <h2>Registar Faculdade</h2>
        
        <form id="register-faculdade-form" action="javascript:void(0)">
        <p>
            <label for="siglas">Sigla da Faculdade:</label>
            <input type="text" name="siglas" required>
        </p>
        <p>
            <label for="nomefaculdade">Nome da Faculdade:</label>
            <input class="notSmallInput" type="text" name="nomefaculdade" required>
        </p>
        <p>
            <label for="morada">Morada:</label>
            <input class="notSmallInput" type="text" name="morada" required>
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
        <h2>Consultar Faculdades</h2>
        <div id="college-container" class="container">
            <table class="adminTable" id="student_list"> 
                <tr>
                    <th>Nome</th>
                    <th>Localização</th>
                    <th>Siglas</th>
                    <th>Apagar</th>
                </tr>
            </table>
        </div>

        

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>


    </main>