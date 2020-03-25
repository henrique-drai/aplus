<title>A+ for Admins</title>
<script>setPageName("anoLetivo")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
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
    
        <table id="show_years">
            <tr>
                <th>Início</th>  
                <th>Fim</th>
                
            </tr>
            
        </table>

    </div>
    </main>