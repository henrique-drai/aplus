<title>A+ for Admins</title>
<script>setPageName("subjects")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-subjects.css">
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
            <label for="descCadeira">Descrição da Unidade Curricular:</label><br>
            <input type="text" name="descCadeira"><br>

            <select id="faculdades_register_UnidCurricular" name="faculdade">
            </select>

            <select id="cursos_register_UnidCurricular" name="curso">
            </select>

            <input type="submit" id="register-cadeira-submit">
        </form><br>

        <h2>Consultar Unidades Curriculares</h2>
        <table id="show_subjects">
            <tr>
                <th>Código da UC</th>
                <th>Curso</th>  
                <th>Nome</th>
                <th>Descrição</th>
            </tr>
            
        </table>