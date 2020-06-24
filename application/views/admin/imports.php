<title>A+ for Admins</title>
<script>setPageName("imports")</script>

<script src="<?php echo $base_url; ?>js/admin/users.js"></script>
<script src="<?php echo $base_url; ?>js/admin/imports.js"></script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/users.css">


</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h1>Importar Grupos</h1>

        <form id="gruposImport" action="javascript:void(0)" enctype="multipart/form-data">
            <input class="form-input-file" type="file" id="file_grupos_admin" name="userfile" title="Inserir Grupos" required accept=".csv">
            <label for="file_grupos_admin" class="input-label">
            <img id="file-img" class="file-img" src="<?php echo base_url(); ?>images/icons/upload-solid.png">
            <span id="GruposCSVFile" class="span-name">Enviar ficheiro .csv</span></label>
            <input type='submit' id='importGrupos' value='Importar Grupos'>
        </form>
        <div id="error-popup">
        </div>
    </main>