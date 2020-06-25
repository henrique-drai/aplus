<title>A+ for Admins</title>
<script>setPageName("imports")</script>

<script src="<?php echo $base_url; ?>js/admin/users.js"></script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/users.css">



</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Importar Dados</h4>
        <h1>Funções de Exportar/Importar</h1>


<!------------------------------------ COLUNA 1 ------------------------------------------------------------------->


        <div class="admin-users-window-export">
                <div class="title">Exportar</div>                  
                
                <form id="exportCsv">
                <p>
                    <label for="data">Exportar dados:</label>
                        
                        <select name="role">
                            <option value="student">Alunos</option>
                            <option value="teacher">Professores</option>
                            <option value="studentsTeachers">Alunos + Professores</option>
                        </select>
                </p><p>
                    <input type="submit" id="exportInfo" value="Exportar">
                </form>

                <br>
                
                <form id="export2Csv" action="javascript:void(0)">

                        <div class="title">Exportar</div>

                        <label for="data">Exportar alunos:</label>
                        
                            <select id="collegesDisplay" name="colleges">
                            </select>

                            <br>

                            <select id="yearsDisplay" name="years">
                            </select>


                            <div id="collegeStatus">
                            </div>                    
                </form>
        </div>






<!------------------------------------ COLUNA 2 ------------------------------------------------------------------->




        <div class="admin-users-window-export">
           
                <div class="title">Importar</div>

                <label for="data">Importar Informação: 
                            <a href="#" id="showDemo">Alunos</a>
                            <a href="#" id="showDemo2">Professores</a>
                            <a href="#" id="showDemo3">Unidades Curriculares</a>
                            <a href="#" id="showDemo4">Grupos</a>
                </label>

                <select id="studentsOrTeachers">
                        <option value='0'>Informação a Importar</option>
                        <option value='teachers'>Professores (cadeiras lecionadas)</option>
                        <option value='students'>Alunos (de um respetivo curso)</option>
                        <option value='uc&classes'>Unidades curriculares (e respetivas turmas)</option>
                        <option value='groups'>Grupos (e seus elementos)</option>
                </select>


                <form id="importFromCsv" action="javascript:void(0)" enctype="multipart/form-data">                
                    <br id="bk">

                    <select id="collegesDisplay1" name="colleges">
                    </select>

                    <br id="bk">

                    <select id="yearsDisplay1" name="years">
                    </select>
                    
                    <div id="collegeStatus1">
                    </div>

                </form>


                <form id="teachersImport" action="javascript:void(0)" enctype="multipart/form-data">
                    <input class="form-input-file" type="file" id="file_projeto" name="userfile" required accept=".csv">
                    <label for="file_projeto" class="input-label">
                    <img id="file-img-2" class="file-img" src="<?php echo base_url(); ?>images/icons/upload-solid.png">
                    <span id="name-enunciado-proj" class="span-name">Enviar ficheiro .csv</span></label>
                    <input type='submit' id='importTeachers'  value='Importar'>
                </form>

                
                <br>

                <div id="importSuccess">
                </div>

                <div id="importError">
                </div>
                                    
               
        </div>


        
        <div class="cd-popup" role="alert" id="import_csv_style">
            <div class="cd-popup-container">
                <p id="removePadding">Formato ficheiro ".csv" para importação</p>
                <p id="mobileMsg"></p>
                <img id="csvExample" src="<?=base_url()?>images/csv_student.png" alt="csv_example">
                <ul class="cd-buttons">
                    <li id="fullW"><a href="#" id="closePopUp">Fechar</a></li>
                </ul>
                <a class="cd-popup-close"></a>
            </div>
        </div>

    </main>