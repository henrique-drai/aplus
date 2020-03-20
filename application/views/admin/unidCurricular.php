<title>A+ for Admins</title>
<script>setPageName("unidCurricular")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/registerunidCurricular.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageunidCurricular.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <h1>Unidades Curriculares</h1>

        <form id="register-cadeiras-form" action="javascript:void(0)">
            <label for="codeCadeira">Código da Unidade Curricular(5 números):</label><br>
            <input type="text" name="codeCadeira"><br>
            <label for="nomeCadeira">Unidade Curricular:</label><br>
            <input type="text" name="nomeCadeira"><br>
            <label for="DescCadeira">Descrição da Unidade Curricular:</label><br>
            <input type="text" name="DescCadeira"><br>
            <select id="faculdades_register_UnidCurricular" name="faculdade">
            </select>
            <select id="cursos_register_UnidCurricular" name="faculdade">
            </select>

            <input type="submit" id="register-cadeira-submit">
        </form><br>