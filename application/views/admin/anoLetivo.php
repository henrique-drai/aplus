<title>A+ for Admins</title>
<script>setPageName("anoLetivo")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerSchoolYear.js"></script>

</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <div class="container">

        <h1>Ano Letivo</h1>

        <form id="register-anoletivo-form" action="javascript:void(0)">
        <p>
            <label for="anoLetivo">Insira um ano válido:</label>
            <input class="form-input-number" type="text" name="anoLetivo" required>
        </p>

        <input type="submit" id="register-anoletivo-submit">
        
    </form>
    <div id="msgStatus">
        </div>
    <div id="years-container" class="container">
        </div>
<!-- 
        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o projeto?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div> -->

        <!-- <table id="show_years">
            <tr>
                <th>Início</th>  
                <th>Fim</th>
                
            </tr>
            
        </table> -->

    </div>
    </main>