<title>A+ for Admins</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<script>setPageName("anoLetivo")</script>
<script src="<?php echo $base_url; ?>js/admin/registerSchoolYear.js"></script>

</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>
    <main>
    <div class="container">

        <h1>Ano Letivo</h1>

        <form id="register-anoletivo-form" action="javascript:void(0)">
        <p>
            <label for="anoLetivo">Insira um ano válido:</label>
            <input class="form-input-number" type="number" name="anoLetivo" required>
        </p>

        <input type="submit" id="register-anoletivo-submit">
        
    </form>
    
    <div id="years-container" class="container">
        </div>
        <div id="msgStatus">
        </div>

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o ano letivo?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

        <!-- <table id="show_years">
            <tr>
                <th>Início</th>  
                <th>Fim</th>
                
            </tr>
            
        </table> -->

    </div>
    </main>