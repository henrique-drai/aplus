<title>A+ Profile</title>
<script>setPageName("profile")</script>
<script src="<?php echo $base_url; ?>js/<?php echo $this->session->role; ?>/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/profile.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/profile.css">
</head>

<body>
    <div id="nav-menu-hook"></div>

    <main>
        <div class="profile-edit">
            <h3>Editar informação:</h3>
            <form class="profile-edit-user" action="javascript:void(0)">
                    <div class="left">
                        <label for="name">      Nome
                            <input type="text" name="name" value="<?php echo $user->name; ?>"></label>
                        <label for="surname">   Apelido
                            <input type="text" name="surname" value="<?php echo $user->surname; ?>"></label>
                        <label for="password"> Password Nova
                            <input type="password" name="password"></label>
                        <label for="confirm">  Confirmar Password
                            <input type="password" name="confirm">
                            <div class="form-error-message"></div>
                        </label>
                    </div>

                    <div class="right">
                        <label for="description">  Descrição
                            <textarea name="description" rows="4"><?php echo $user->description; ?></textarea>
                        </label>
                        <input type="submit" value="Guardar Alterações">
                    </div>

            </form>
        </div>
        <br>
        <hr>

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
