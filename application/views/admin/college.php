<title>A+ for Admins</title>
<script>setPageName("college")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerCollege.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageCollege.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Registar Faculdade!</h1>

        <form id="register-faculdade-form" action="javascript:void(0)">
            <label for="nomefaculdade">Nome da Faculdade:</label><br>
            <input type="text" name="nomefaculdade"><br>
            <label for="morada">Morada:</label><br>
            <input type="text" name="morada"><br>
            <label for="siglas">Siglas da Faculdade:</label><br>
            <input type="text" name="siglas"><br>

            <input type="submit" id="register-college-submit">
        </form><br>

        <h2>Consultar Faculdades</h2>
        <table id="show_colleges">
            <tr>
                <th>Nome</th>
                <th>Localizacao</th>
                <th>Siglas</th>
            </tr>
            
        </table>

    </main>