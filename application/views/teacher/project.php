<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/project.js"></script>
<script>setProj("<?php echo $project[0]["id"]; ?>")</script>
<script>setBackPage("<?php echo $base_url; ?>" + "subjects/subject/" + "<?php echo $subject->code; ?>")</script>

</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <div class="container">
        <h1>Projeto: <?php echo $project[0]["nome"]; ?></h1>

        <div class="container-header">
            <input type="button" id="back" value="Voltar">
            <h3>Grupos - Estático</h3>
        </div>

        <div class="container">
            <table id="groups_list">
                <tr>
                    <th>Nome</th>
                    <th>Número de elementos</th>
                    <th>Elementos</th>
                    <th>Chat</th> 
                </tr>
                <tr>
                    <td>Grupo 1</td>
                    <td>4</td>
                    <td>David Silva | Inês Sousa | Raul Koch | João Ye </td>
                    <td><input id="chatButton" type="button" value="Chat"></td>
                </tr>
            </table>
        </div>

        <h3>Etapas</h3>
        <div id="etapas-container" class="container">
        </div>

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o projeto?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

        <div class="buttons-container">
            <input id="removeProject" class="remove" type="button" value="Eliminar projeto">
        </div>
    </div>
    </main>