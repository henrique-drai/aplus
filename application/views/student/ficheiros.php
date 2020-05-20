<title>A+ for Students</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/ficheiros.css">
<script>setPageName("Grupos")</script>
<script src="<?php echo $base_url; ?>js/student/ficheiros.js"></script>
</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app/student/grupos">Grupos</a> > <a href="<?php echo base_url(); ?>app/grupo/<?php echo $grupo[0]["id"];?>">Área de Grupo > Ficheiros</a></h4>
    <h2>Área de ficheiros do grupo "<?php echo $grupo[0]["name"]; ?>"<h2>

    <h3>Enviar um ficheiro:</h3>
    <div class="container" id="container-upload">
        <?php echo form_open_multipart('UploadsC/uploadFicheirosGrupo', 'id="form-submit"');?>
            <div class="file-div">
            <input type="file" id="file_submit" name="file_submit" accept=".zip,.rar,.pdf,.docx">
            </div>
            <input id="submit-file" type="submit" value="Enviar">
        </form>
    </div>
    <br>
    <br>
    <h3>Ficheiros partilhados:</h3>
    <div class="container" id="container-ficheiros">

    </div>



