<title>A+ for Students</title>
<script>setPageName("grupo")</script>
<script src="<?php echo $base_url; ?>js/student/grupo.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/grupo.css">

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>app/student/grupos">Grupos</a> > <a href="<?php echo base_url(); ?>app/student/grupo">Área de Grupo</a>
        </h4>
        <h1>Área de Grupo</h1>
        <input id="ficheiros" type="button" value="Ficheiros">
        <input id="ratingmembros" type="button" value="Rating Membros">
        
        <h2>Gestão de Tarefas</h2>
        
        <table id="tab-gerir-tarefas">
            <tr>
                <th>Tarefa</th>
                <th>Descrição</th>
                <th>Membro Responsável</th>
                <th>Começo</th>
                <th>Fim</th>
            </tr>
            <tr>
                <td>Front end nav bar</td>
                <td>Fazer o front end da nav bar</td>
                <td>Maria</td>
                <td>20/2/2020</td>
                <td>15/3/2020</td>
            </tr>
            <tr>
                <td>Back end nav bar</td>
                <td>Fazer o back end da nav bar</td>
                <td>Jorge</td>
                <td>15/3/2020</td>
                <td>30/3/2020</td>
            </tr>
        </table>


        <div class="buttons-container">
            <input id="newTarefa" type="button" value="Adicionar tarefa">
            <input id="editTarefa" type="button" value="Editar tarefa">
            <input id="deleteTarefa" type="button" value="Eliminar tarefa">
        </div>

    </main>