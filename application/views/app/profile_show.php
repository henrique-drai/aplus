<title>A+ Profile</title>
<script>setPageName("profile")</script>
<script src="<?=$base_url?>js/profile.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/profile.css">
</head> 

<?php

    $file = "uploads/profile/" . $user->id .  $user->picture;
    // VERIFICAR SE O UTILIZADOR TEM FOTO
    if(!file_exists($file)) {
        $file = "uploads/profile/default.jpg";
    }
    // ACRESCENTAR O TIME() PARA FAZER BYPASS NA CACHE
    $picture = $base_url . $file . "?" . time();
?>

<body>
    <?php $this->view('templates/nav-menu'); ?>

    <main>
        <div class="header">
            <img src="<?=$picture?>" alt="Profile Picture">
            <div class="header-info">
                <div class="name">
                    <?=$user->name." ". $user->surname?>
                    <span class="gabinete"><?=$user->gabinete?></span>
                    <span class="chat">
                        <a href="<?=$base_url?>app/chat/<?=$user->id?>">
                            <img src="<?=$base_url?>images/icons/message_black.png" alt="Chat">
                        </a>
                    </span>
                </div>
                <hr>
                <div class="bio">
                    <pre><?=$user->description?></pre>
                </div>
                <div class="email">
                    <?=$user->email?>
                </div>
            </div>
        </div>
    </main>