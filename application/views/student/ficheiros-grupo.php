<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/ficheiros.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("grupos")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/ficheiros-geral.js"></script>
<script src="<?php echo $base_url; ?>js/student/ficheiros-grupo.js"></script>
<script>setGrupo("<?php echo $grupo[0]["id"]; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app/student/grupos">Grupos</a> > <a href="<?php echo base_url(); ?>app/grupo/<?php echo $grupo[0]["id"];?>">Área de Grupo > Ficheiros</a></h4>
    <h2>Área de ficheiros do grupo "<?php echo $grupo[0]["name"]; ?>"<h2>

    <h3>Enviar um ficheiro:</h3>
    <div class="container" id="container-upload">
        <?php echo form_open_multipart('UploadsC/uploadFicheirosGrupo', 'id="form-submit-grupo"');?>
            <div class="file-div" id="upload-file-div">
            <input type="file" id="file_submit" name="file_submit" accept=".zip,.rar,.pdf,.docx">
            <div class="file-text">
                <div class="success-file">Nome do ficheiro</div>
                <div class="default-file">Selecione o ficheiro a enviar</div>
                <div class="error-file">Tem de selecionar um ficheiro</div>
            </div>
            </div>
            <input id="submit-file" type="submit" value="Enviar">
            <div id="success" class="submit-msg">Ficheiro adicionado com sucesso!</div>
        </form>
    </div>
    <br>
    <br>
    <div id="popups"></div>
    <h3>Ficheiros partilhados:</h3>
    <div class="container" id="container-ficheiros">
        <div class="file-div" id="show-files-div">
        </div>
    </div>



