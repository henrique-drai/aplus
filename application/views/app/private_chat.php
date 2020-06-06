<title>A+ Chat</title>
<script>setPageName("chat")</script>

<script src="<?php echo $base_url; ?>js/private_chat.js"></script>

<?php if(isset($user_id)):?><script>setChatUserId(<?=$user_id?>)</script><?php endif; ?>
<?php if(isset($chatType)):?><script>setChatType(<?='"'.$chatType.'"'?>)</script><?php endif; ?>

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/chat.css">
</head>

<body>
    <?php $this->view('templates/nav-menu'); ?>

    <main>
    
    <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>app/chat">Chat</a>
    </h4>
        <div id="all-chat">
        <div id="leftSideChat">           
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="search_text" id="search_text_chat" placeholder = "Procurar utilizador" class="form-control"/>
                <!-- <p class="informacaoUsers">Use * para visualizar todos os utilizadores da sua ?faculdade?</p> -->
                <div id="msgStatus">
                </div>
            </div>
        </div>

        <div id="results-container" class="accordions">
        <div id="privateChat" class="accordion-item"></div>
        <div id="groupChat" class="accordion-item"></div>
        </div>
        </div>
        <div id="chat-container" class="container">
            <div class="headName"></div>
            <div class="bodyChat"></div>
            <div class="footSend"><div class="type-msg"><input type="text" id="write_msg" placeholder="Type a message"><img id="icon-send" class="icon-send"src="<?=$base_url?>images/icons/paper-airplane.png"> </div></div>
        </div> 
        </div>
        <!--

        https://codeigniter.com/user_guide/libraries/file_uploading.html
        https://codeigniter.com/user_guide/libraries/ftp.html
        https://stackoverflow.com/questions/9747897/deleting-a-file-using-php-codeigniter

            -->

    </main>
