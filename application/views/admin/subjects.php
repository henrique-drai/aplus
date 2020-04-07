<title>A+ for Admins</title>
<script>setPageName("subjects")</script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin-subjects.css">
<script src="<?php echo $base_url; ?>js/admin/registerunidCurricular.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageunidCurricular.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <div class="container">

        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Unidades Curriculares</h4>

        <h1>Unidades Curriculares</h1>

        <form id="register-cadeiras-form" action="javascript:void(0)">
            <p>
                <label for="codeCadeira">Código da Unidade Curricular:</label>
                <input class="form-input-number" type="text" name="codeCadeira" required>
            </p><p>
                <label for="nomeCadeira">Unidade Curricular:</label>
                <input class="form-input-text" type="text" name="nomeCadeira" required>
            </p><p>
                <label for="descCadeira">Descrição da Unidade Curricular:</label>
                <textarea class="form-text-area" type="text" name="descCadeira" required></textarea>
            </p><p>
                <select id="faculdades_register_UnidCurricular" name="faculdade">
                </select>
            </p><p>
                <select id="cursos_register_UnidCurricular" name="curso">
                </select>
            </p>
            <div id="msgStatus">
            </div>
            <input type="submit" id="register-cadeira-submit">
        </form><br>

        
        
        <h2>Consultar Unidades Curriculares</h2>

        <select id="Consultar_Cadeiras" name="consultarcadeiras">
            <option value="">Selecione uma Opção</option>
            <option value="All">Todas as Cadeiras</option>
            <option value="Faculdade">Por Faculdade</option>
            <option value="Curso">Por Curso</option>
            <option value="AnoLetivo">Por Ano Letivo (***** AINDA NAO ESTA FEITO *****)</option>
        </select>

        <select id="Consultar_Cadeiras_Faculdade" name="consultarCadeirasporFaculdade">
        </select>

        <select id="Consultar_Cadeiras_Curso" name="consultarCadeirasporCurso">
        </select>

        <select id="Consultar_Cadeiras_Ano" name="consultarCadeirasporAno">
        </select>

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


        <table class="adminTable" id="show_subjects">
            <tr>
                <th>Código da UC</th>
                <th>Curso</th>  
                <th>Nome</th>
                <th>Descrição</th>
            </tr>
            
        </table>
        <div>
</main>