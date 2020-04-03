<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/users.js"></script>
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
                    <label for="name">Nome:</label>
                    <input type="text" name="name">
                    <label for="surname">Apelido:</label>
                    <input type="text" name="surname">
                    <label for="email">Email:</label>
                    <input type="text" name="email">
                    <label for="password">Password:</label>
                    <input type="password" name="password">
                    <label for="role">Role:</label>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                    <input type="submit" id="register-form-submit">
                </form>
                <div id="msgStatus">
                </div>
            </div>


            <div class="admin-users-window">
                <div class="title">Migrações</div>
                
                <form id="exportCsv" action="<?php echo base_url(); ?>admin/api/saveCSV">
                    <label for="data">Exportar dados:</label>
                        
                        <select name="role">
                            <option value="student">Students</option>
                            <option value="teacher">Teachers</option>
                            <option value="studentsTeachers">Students + Teachers</option>
                        </select>
                    <input type="submit" id="exportInfo" value="Exportar">
                
                </form>

                <br>

                <form id="file-form" method="post" action="<?php echo base_url(); ?>admin/api/importCSV" enctype="multipart/form-data">
                    <label for="myfile">Importar dados:</label>
                    <input type="file" id="myfile" name="userfile">
                    <input type="submit" id="import-data-submit"  value="Importar">
                </form>
            </div>

        </section>

    
    </main>
