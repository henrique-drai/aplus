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
    <br>
        <div class="header">
            <div class="picture">
                <img src="<?=$picture?>" alt="Profile Picture">
                <div class="rating">
                    <?=(isset($rating))? $rating.' <i class="fa fa-star"></i>' : null ?>
                    <?=(!isset($rating) && $user->role == "student")? '<div class="empty">Classificação Pendente</div>' : null ?>
                </div>
            </div>
            
            <div class="header-info">
                <div class="name">
                    <?=$user->name." ". $user->surname?>
                    <span class="gabinete"><?=$user->gabinete?></span>
                    <span class="chat">
                        <a href="<?=$base_url?>app/chat/p/<?=$user->id?>">
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
        <?=($user->id == $this->session->userdata('id'))? '<a class="std-btn" href="'.base_url().'app/profile/edit">Editar</a>' : null ?>
        
    </main>