<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/ficheiros.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher/ficheiros-cadeira.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/pagination-min.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<script src="<?php echo $base_url; ?>js/ficheiros-geral.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/ficheiros-cadeira.js"></script>
<script>setCadeira("<?php echo $subject->id; ?>")</script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>subjects">Cadeiras</a> > <a href="<?php echo base_url(); ?>subjects/subject/<?php echo $subject->code; ?>/<?php echo $year; ?>"><?php echo $subject->name; ?></a> &gt; Ficheiros </h4>
    <h2>Área de ficheiros da cadeira "<?php echo $subject->name; ?>"<h2>

    <h3>Enviar um ficheiro:</h3>
    <div class="container" id="container-upload">
        <?php echo form_open_multipart('UploadsC/uploadFicheirosCadeira', 'id="form-submit-cadeira"');?>
            <div class="file-div" id="upload-file-div">
            <input type="file" id="file_submit" name="file_submit" accept=".zip,.rar,.pdf,.docx">
            <div class="file-text">
                <div class="success-file">Nome do ficheiro</div>
                <div class="default-file">Selecione o ficheiro a enviar</div>
                <div class="error-file">Tem de selecionar um ficheiro</div>
            </div>
            </div>
            <input id="submit-file-cadeira" type="submit" value="Enviar">
        </form>
    </div>
    <br>
    <br>
    <div id="popups"></div>
    <h3>Ficheiros enviados:</h3>
    <div class="container" id="container-ficheiros">
        <div class="file-div" id="show-files-div">
        </div>
    </div>



