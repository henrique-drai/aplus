<title>A+ Profile</title>
<script>setPageName("profile")</script>
<script src="<?php echo $base_url; ?>js/<?php echo $this->session->role; ?>/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/profile.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/profile.css">
</head>

<body>
    <div id="nav-menu-hook"></div>

    <main>
        <form class="profile-edit-user" action="javascript:void(0)">
            <label for="name">      Nome
                <input type="text" name="name" value="Loading..."></label>
            <label for="surname">   Apelido
                <input type="text" name="surname" value="Loading..."></label>
            <label for="password"> Password Nova
                <input type="password" name="password"></label>
            <label for="confirm">  Confirmar Password
                <input type="password" name="confirm">
                <div class="form-error-message"></div>
            </label>

            <br><input type="submit" value="Update Profile" disabled>
        </form>
        <br>


        <div class="picture-form">
            <h3>Alterar imagem de perfil:</h3>
            <?php echo form_open_multipart('app/uploadProfilePic'); ?>
                <input type="file" name="userfile" size="20">
                <input type="submit" value="Carregar">
            </form>
        </div>


        <!--

        https://codeigniter.com/user_guide/libraries/file_uploading.html
        https://codeigniter.com/user_guide/libraries/ftp.html
        https://stackoverflow.com/questions/9747897/deleting-a-file-using-php-codeigniter

            -->

    </main>
