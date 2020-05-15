<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/users.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
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
                    <p>
                    <label for="name">Nome:</label>
                    <input type="text" name="name">
                    </p>
                    <p>
                    <label for="surname">Apelido:</label>
                    <input type="text" name="surname">
                    </p>
                    <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email">
                    </p>
                    <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password">
                    </p>
                    <p>
                    <label for="role">Role:</label>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                    </p>
                    <input type="submit" id="register-form-submit">
                </form>
                <br>
                <div id="msgStatus">
                </div>
            </div>


<!-- ################################################################################################# -->

            <div class="admin-users-window">
                <div class="title">Exportar</div>
                
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
                
                </form>

                <br>
                <br>

                
                <form id="export2Csv" action="javascript:void(0)">

                    <p>
                        <label for="data">Exportar dados 222:</label>
                        
                            <select id="collegesDisplay" name="colleges">
                            </select>

                            <br>

                            <select id="yearsDisplay" name="years">
                            </select>


                            <div id="collegeStatus">
                            </div>
                    </p>
                    
    
                </form>

                <br>

                
            </div>


<!-- ################################################################################################# -->

            <div class="admin-users-window">
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
            </div>

            

        </section>

    
    </main>
