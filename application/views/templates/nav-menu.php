
<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/nav-menu.css">
<script src="<?=$base_url?>js/nav-menu.js"></script>
<script src="<?=$base_url?>js/<?=$this->session->role?>/nav-menu.js"></script>


<div id="nav-menu-hook">
    <div id="nav-menu-container">
        <div class="nav-menu-user-section">
            <div class="nav-menu-profile-picture">
                <a href="<?=$base_url?>app/profile/edit">
                    <img src="<?=$base_url . "file/profilePic/" . $this->session->id ?>" alt="Profile Picture">
                    <div class="nav-menu-profile-picture-hover">
                        Edit
                    </div>
                </a>
            </div>
            <div class="nav-menu-user-name">
                <?=$this->session->name . " " . $this->session->surname?>
            </div>
            <div class="nav-menu-btn-logout nav-menu-btn">
                Terminar Sessão
            </div>
            <div class="btn-notifications nav-menu-btn">
                <img src="<?=$base_url?>images/icons/bell.png" alt="">
                <div class="alert hidden"></div>
            </div>
        </div>

        <div class="nav-notifications hidden"></div>

        <hr>
        <ul id="nav-menu-links"></ul>
        <hr>
        <?php if($this->session->role == "teacher" || $this->session->role == "student"): ?>
            <script src="<?=$base_url?>js/agenda.js"></script>
            <div id="nav-menu-agenda"></div>
        <?php endif; ?>
    </div>
</div>

<div id="mobile-navbar">
    <div id="nav-menu-toggle">></div>
    <div class="right">
        <div class="btn-notifications nav-menu-btn">
            <img src="<?=$base_url?>images/icons/bell.png" alt="">
            <div class="alert hidden"></div>
        </div>
        <div class="img"><img src="<?=$base_url . "file/profilePic/" . $this->session->id ?>" alt="Profile"></div>
    </div>
</div>