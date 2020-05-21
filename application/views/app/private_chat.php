<title>A+ Chat</title>
<script>setPageName("chat")</script>
<script src="<?php echo $base_url; ?>js/private_chat.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/chat.css">
</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>

    <main>
        
    <h1>Chat</h1>

        <div id="leftSideChat">           
        <div class="form-group">
            <div class="input-group">
                <h2>Procurar utilizadores</h2>
                <input type="text" name="search_text" id="search_text_chat" placeholder = "Procurar utilador" class="form-control"/>
                <!-- <p class="informacaoUsers">Use * para visualizar todos os utilizadores da sua ?faculdade?</p> -->
            </div>
        </div>
        </div>

        <div id="chat-container" class="container">
        </div> 

        <!--

        https://codeigniter.com/user_guide/libraries/file_uploading.html
        https://codeigniter.com/user_guide/libraries/ftp.html
        https://stackoverflow.com/questions/9747897/deleting-a-file-using-php-codeigniter

            -->

    </main>
