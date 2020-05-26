<title>A+ for Students</title>
<script>setPageName("memberRtg")</script>
<script src="<?php echo $base_url; ?>js/student/rating_page.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-users.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/admin/admin-subjects.css">

</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
        <a href="<?php echo base_url(); ?>app/student/grupos">Grupos</a> > <a href="<?php echo base_url(); ?>app/grupo/<?php echo $grupo[0]["id"]; ?>">Área de Grupo</a>
         > Rating </h4>
     
        <div class="container">
        
            <div class="header">
                <h2 id="groupName">Grupo: </h2>
                <h3 id="cadeira">Cadeira: </h2>
            </div>

            <br>
            
            <div id="container">
                <h4>Membros Não-Classificados:</h4>
                <div class="notClassified"></div>
            </div>

            <div id="container">  
                <h4>Membros Classificados:</h4>
                <div class="classified"></div>
            </div>
        
        </div>

         <!-- <div class="overlay">
                <div class="popup">
                    <a class="close" href="#">&times;</a>
                    <div class="content">

                        <form id="threadForm" class="thread-form"  action="javascript:void(0)">
                            
                            <p>
                                <div class="value">1</div>
                                <input id="rate" type="range" min="1" max="5" step="1" value="0">
                            </p>

                            <input type="button" id="popup_button" value="Submeter Rating">
                        </form>
                    </div>
                </div>
            </div> -->

            <div class="cd-popup" role="alert" id="user_submit_rating">
	        <div class="cd-popup-container">
                        <form id="threadForm" class="thread-form"  action="javascript:void(0)">
                            
                            <div>
                                <div class="value">1</div>
                                <input id="rate" type="range" min="1" max="5" step="1" value="0">
                            
                            </div>
                            
                            <!-- <input type="button" id="popup_button" value="Submeter Rating"> -->
                            
                            <ul class="cd-buttons">
                                <li><a href="#" id="confirmRating">Classificar</a></li>
                                <li><a href="#" id="closeButton">Cancelar</a></li>
                            </ul>
                        </form>
		        <a class="cd-popup-close"></a>
	        </div>
        </div>


    </main>