<title>A+ Profile</title>
<script>setPageName("profile")</script>
<script src="<?php echo $base_url; ?>js/<?php echo $this->session->role; ?>/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/profile.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/profile.css">
</head> 

<?php
// VERIFICAR SE O UTILIZADOR TEM FOTO
    $picture = "http://files.luzamag.com/profile/". $user->id . ".jpg?" . time();
    $file_headers = @get_headers($picture);
    if(!$file_headers || strpos($file_headers[0], '404') !== false) {
        $picture = $base_url."uploads/profile/default.jpg";
    }
?>

<body>
    <div id="nav-menu-hook"></div>

    <main>
        <div class="header">
            <img src="<?php echo $picture; ?>" alt="Profile Picture">
            <div class="header-info">
                <div class="name">
                    <?php echo $user->name." ". $user->surname; ?>
                </div>
                <hr>
                <div class="bio">
                    <?php echo $user->description; ?>
                </div>
                <div class="email">
                <?php echo $user->email; ?>
                </div>
            </div>
        </div>
    </main>