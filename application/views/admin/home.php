<title>A+ for Admins</title>
<script>setPageName("home")</script>
<script src="<?php echo $base_url; ?>js/admin/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/admin/home.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/home.css">
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
        <section class="admin-stats">
            <div class="admin-stats-window" id="users-hook">
                <div class="admin-stats-title">Users</div>
                <div class="admin-stats-content">
                    Registered Teachers: <span id="hook-num_teachers"></span>
                    <br>
                    Registered Students: <span id="hook-num_students"></span>
                </div>
                <div class="admin-stats-btn">
                    
                    <a href="<?php echo $base_url; ?>app/admin/users"><div>Manage</div></a>
                </div>
            </div>

            <div class="admin-stats-window" id="unis-hook">
                <div class="admin-stats-title">Colleges</div>
                <div class="admin-stats-content">
                    Registered Colleges: <span id="hook-num_colleges"></span>
                </div>
                <div class="admin-stats-btn">
                <a href="<?php echo $base_url; ?>app/admin/college"><div>Manage</div></a>
                </div>
            </div>
        </section>


        <div class="form-container">
            
        
            <h1>Import/Export Data</h1>

            
            <div id="importSide">

                <h3>TODO:</h3>
                <ul>
                    <li>Importar utilizadores</li>
                    <li>Exportar utilizadores</li>
                </ul>

                <form id="exportCsv" action="<?php echo base_url(); ?>admin/api/saveCSV">
                    <input type="submit" id="exportInfo" value="Exportar Users">
                </form>
            
            </div>

            <div id="exportSide" >
                <!-- <form id="file-form" action="javascript:void(0)"> -->
                <form id="file-form" method="post" action="<?php echo base_url(); ?>admin/api/importCSV" enctype="multipart/form-data">
                    <!-- <label for="myfile">Importar dados:</label> -->
                    <input type="file" id="myfile" name="userfile" ><br><br>
                    <input type="submit" id="import-data-submit"  value="Importar Data">
                </form>
            </div>

            
            <br>
        
        </div>
        
    </main>
