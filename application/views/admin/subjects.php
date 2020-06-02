<title>A+ for Admins</title>
<script>setPageName("subjects")</script>

<script src="<?php echo $base_url; ?>js/admin/registerunidCurricular.js"></script>
<script src="<?php echo $base_url; ?>js/admin/manageunidCurricular.js"></script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-subjects.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <div class="container">

        <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Unidades Curriculares</h4>
        <br>
        <h2>Registar Unidades Curriculares</h2>

        <form id="register-cadeiras-form" action="javascript:void(0)">
            <p>
                <label for="codeCadeira">Código da Unidade Curricular:</label>
                <input class="form-input-number" type="text" name="codeCadeira" required>
            </p><p>
                <label for="siglaCadeira">Sigla da Unidade Curricular:</label>
                <input type="text" name="siglaCadeira" required>
            </p><p>
                <label for="nomeCadeira">Unidade Curricular:</label>
                <input class="form-input-text" type="text" name="nomeCadeira" required>
            </p><p>
                <label for="descCadeira">Descrição da Unidade Curricular:</label>
                <textarea class="form-text-area" type="text" name="descCadeira" required></textarea>
            </p><p>
                <label for="academicYear">Ano Letivo:</label>
                <select id="anos_register_UnidCurricular" name="academicYear">
                </select>
            </p><p>
                <label for="faculdade">Faculdade:</label>
                <select id="faculdades_register_UnidCurricular" name="faculdade">
                </select>
            </p><p>
                <label for="semestre">Semestre:</label>
                <select id="semestre_register_UnidCurricular" name="semestre">
                    <option value="1">1º semestre </option>
                    <option value="2">2º semestre </option>
                </select>
            </p><p>
                <label for="curso">Curso:</label>
                <select id="cursos_register_UnidCurricular" name="curso">
                </select>
            </p>
            
            <input type="submit" id="register-cadeira-submit">
            <div id="msgStatus">
            </div>
            <div id="msgErro">
            </div>
        </form><br>        
        
        <h2>Consultar Unidades Curriculares</h2>
        <h3>Filtros</h3>
        <!-- <select id="Consultar_Cadeiras" name="consultarcadeiras">
            <option value="">Selecione uma Opção</option>
            <option value="All">Todas as Cadeiras</option>
            <option value="Faculdade">Por Faculdade</option>
            <option value="Curso">Por Curso</option>
            <option value="AnoLetivo">Por Ano Letivo</option>
        </select> -->

        <select id="Consultar_Cadeiras_Faculdade" class="SubjectsSelects" name="consultarCadeirasporFaculdade">
        </select>

        <!-- <select id="Consultar_Cadeiras_Faculdade_Curso" name="consultarCadeirasporCurso">
        </select> -->

        <select id="Consultar_Cadeiras_Curso" class="SubjectsSelects" name="consultarCadeirasporCurso">
        </select>

        <select id="Consultar_Cadeiras_Ano" class="SubjectsSelects" name="consultarCadeirasporAno">
        </select>

        <div id="subject-container" class="container">
            <table class="adminTable" id="subject_list">
                <tr><th>ID</th>
                <th>Código da UC</th>
                <th>Curso</th> 
                <th>Nome</th>
                <th>Sigla</th>
                <th>Semestre</th>
                <th>Descrição</th> 
                <th>Editar</th>
                <th>Apagar</th></tr>
            </table>
        </div> 

        <div class="cd-popup" role="alert" id="subject_admin_edit">
	        <div class="cd-popup-container">
                <form id="editSubject-form" action="javascript:void(0)">
                <div class="editSubjects_inputs">
                    <h2>Editar Unidade Curricular</h2>
                    <label for="codigo" class='form-label'>Código da UC</label>
                    <input class="form-input-text" type="text" name="codigo" required>
                    <label for="nome" class='form-label'>Nome da UC</label>
                    <input class="form-input-text" type="text" name="nome" required>
                    <label for="sigla" class='form-label'>Sigla da UC</label>
                    <input class="form-input-text" type="text" name="sigla" required>
                    <label for="semestre" class='form-label'>Semestre (1 ou 2)</label>
                    <input class="form-input-text" type="text" name="semestre" required>
                    <label for="descCadeira">Descrição da Unidade Curricular:</label>
                    <textarea class="form-text-area" type="text" name="descCadeira" required></textarea>
                </div>
                <div id="msgErroEditar">
                </div>
                <ul class="cd-buttons">
                    <li><a href="#" id="editSubject-form-submit">Submeter</a></li>
                    <li><a href="#" id="closeButton">Cancelar</a></li>
                </ul>
                </form>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>
        

        <div class="cd-popup" role="alert" id="subject_admin_delete">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar a Unidade Curricular?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Sim</a></li>
                    <li><a href="#" id="closeButton">Não</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>

        <!-- <div id="subject-container" class="container">
        </div>  -->
        
</main>