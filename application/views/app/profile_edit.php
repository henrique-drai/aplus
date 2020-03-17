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
            <label for="name">      Name
                <input type="text" name="name" value="Loading..."></label>
            <label for="surname">   Surname
                <input type="text" name="surname" value="Loading..."></label>
            <label for="password">  New Password
                <input type="password" name="password"></label>
            <label for="confirm">  Confirm Password
                <input type="password" name="confirm">
                <div class="form-error-message"></div>
            </label>

            <br><input type="submit" value="Update Profile" disabled>
        </form>

    </main>
