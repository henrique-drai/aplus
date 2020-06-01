<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/users.js"></script>
<script src="<?php echo $base_url; ?>js/pagination.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/users.css">


</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
    <h4 class="breadcrumb"><a href="<?php echo base_url(); ?>app">Painel de Controlo</a> > Utilizadores</h4>

        <h1>Utilizadores</h1>

        <section class="flex-section">
            
            <div class="admin-users-window">
                <div class="title">Registar</div>
                <form id="register-form" action="javascript:void(0)">
                    <p class="double_input">
                        <label for="name">Nome:<br><input type="text" name="name"></label>
                        <label for="surname">Apelido:<br><input type="text" name="surname"></label>
                    </p>
                    <p class="double_input">
                        <label for="email">Email:<br><input type="text" name="email"></label>
                        
                        <label for="password">Password:<br><input type="password" name="password"></label>                
                    </p>
                    <p>
                    <label for="role">Privilégio:</label>
                    <select name="role">
                        <option value="admin">Administrador</option>
                        <option value="student">Aluno</option>
                        <option value="teacher">Professor</option>
                    </select>
                    </p>
                    <p>
                        <label for="academicYearUser">Ano Letivo:</label>
                        <select id="registerAnoUser" name="academicYearUser">
                        </select>
                    </p>
                    <p>
                        <label for="faculUser">Faculdade:</label>
                        <select id="registerUserFacul" name="faculUser">
                        </select>
                    </p>
                    <p id="cursoUser">
                        <label for="cursoUserSel">Curso:</label>
                        <select id="registerUserCurso" name="cursoUserSel">
                        </select>
                    </p>
                    <p id="cadeirasUser">
                        <label for="caderiasAlunProf">Cadeiras:</label>
                        <select id="registerUserCadeira" name="caderiasAlunProf" multiple="multiple">
                        </select>
                    </p>
                    <div id="selectedCadeiras">
                        <h4>Cadeiras a inscrever</h4>
                        <div id="cadeiras">
                        </div>
                    </div>
                    <input type="submit" id="register-form-submit">
                </form>
                <br>
                <div id="msgStatus">
                </div>
                <div id="msgErro">
                </div>
            </div>


<!-- ################################################################################################# -->

            <div class="admin-users-window-export">
                <!-- <div class="title">Exportar</div> -->
<!--                 
                <form id="exportCsv">
                <p>
                    <label for="data">Exportar dados:</label>
                        
                        <select name="role">
                            <option value="student">Students</option>
                            <option value="teacher">Teachers</option>
                            <option value="studentsTeachers">Students + Teachers</option>
                        </select>
                </p><p>
                    <input type="submit" id="exportInfo" value="Exportar">
                
                </form> -->

                <!-- <br>
                <br> -->

                
                <form id="export2Csv" action="javascript:void(0)">

                        <div class="title">Exportar</div>

                        <br>

                        <label for="data">Exportar alunos:</label>
                        
                            <select id="collegesDisplay" name="colleges">
                            </select>

                            <br>

                            <select id="yearsDisplay" name="years">
                            </select>


                            <div id="collegeStatus">
                            </div>                    
                </form>

                <br>

                <form id="importFromCsv" action="javascript:void(0)" enctype="multipart/form-data">
                    
                    <div class="title">Importar</div>

                    <br>
                    
                    <label for="data">Importar alunos: <a href="#" id="showDemo">Formato</a></label>
            
                    <select id="collegesDisplay1" name="colleges">
                    </select>

                    <br>

                    <select id="yearsDisplay1" name="years">
                    </select>

                    
                    <div id="collegeStatus1">
                    </div>

                </form>
                <br>

                <div id="importSuccess">
                </div>

                <div id="importError">
                </div>

                
            </div>


<!-- ################################################################################################# -->

            <!-- <div class="admin-users-window">
                <div class="title">Importar</div>
                

                <form id="file-form" action="javascript:void(0)" enctype="multipart/form-data">
                    
                    <label for="myfile">Importar dados:</label>
                    
                    <select name="role">
                        <option value="users">All Users</option>
                        <option value="studentsSubject">Students + Subjects</option>
                    </select>

                    <br>
                
                    <input type="file" id="myfile" name="userfile" accept=".csv" required>
                    <input type="submit" id="import-data-submit"  value="Importar">
                </form>
                <br>

                <div id="importStatus">
                </div> 
            
            </div> -->


        </section>


        <div class="cd-popup" role="alert" id="import_csv_style">
            <div class="cd-popup-container">
                <p id="removePadding">Formato ficheiro ".csv" para importação</p>
                <img src="<?php echo base_url(); ?>images/csv_example.png" alt="csv_example">
                <ul class="cd-buttons">
                    <li id="fullW"><a href="#" id="closePopUp">Fechar</a></li>
                </ul>
                <a class="cd-popup-close"></a>
            </div>
        </div>

    
    </main>
