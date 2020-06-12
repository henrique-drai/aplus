<title>A+ for Admins</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<script>setPageName("anoLetivo")</script>
<script src="<?php echo $base_url; ?>js/admin/registerSchoolYear.js"></script>

</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>
    <main>
    <div class="container">

        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Ano Letivo</h4>

        <!-- <form id="register-anoletivo-form" action="javascript:void(0)">
        <p>
            <label for="anoLetivo">Insira um ano válido:</label>
            <input class="form-input-number" type="number" name="anoLetivo" required>
        </p>

        <input type="submit" id="register-anoletivo-submit">
        
    </form>
    <br> -->
    
    <div id="years-container" class="container">
        </div>
        <div id="msgStatus">
        </div>
        <div id="msgErro">
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
    </div>
    </main>