<title>A+ Profile</title>
<script>setPageName("profile")</script>
<script src="<?php echo $base_url; ?>js/profile.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/profile.css">
</head> 

<?php

    $file = "uploads/profile/" . $user->id . ".jpg";
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
            <img src="<?php echo $picture; ?>" alt="Profile Picture">
            <div class="header-info">
                <div class="name">
                    <?php echo $user->name." ". $user->surname; ?>
                    <span><?php echo $user->gabinete; ?><span>
                </div>
                <hr>
                <div class="bio">
                    <pre><?php echo $user->description; ?></pre>
                </div>
                <div class="email">
                <?php echo $user->email; ?>
                </div>
            </div>
        </div>
    </main>