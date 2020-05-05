<title>A+ for Teachers</title>
<script>setPageName("grupos")</script>
<script src="<?php echo $base_url; ?>js/student/grupos.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/popup.css">


</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>app/student/grupos">Grupos</a>
        </h4>
        <h1>Grupos</h1>

        <label for="groupStatus"></label>
        
        <select id="status" name="groupStatus">
            <option value="allGroups">Todos os Grupos</option>
            <option value="ongoing">Em curso</option>
            <option value="terminated">Terminados</option>
        </select>

        <div class="form-container">
            <div class="grupos"></div>
        </div>


    </main>