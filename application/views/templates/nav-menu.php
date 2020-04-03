<?php
$file = "uploads/profile/" . $this->session->id . ".jpg";
if(!file_exists($file)) {$file = "uploads/profile/default.jpg";}
$picture = $base_url . $file . "?" . time();
?>

<script src="<?php echo $base_url; ?>js/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/<?php echo $this->session->role; ?>/nav-menu.js"></script>

<div id="nav-menu-hook">
    <div id="nav-menu-container">
        <div class="nav-menu-user-section">
            <div class="nav-menu-profile-picture">
                <a href="<?php echo $base_url; ?>app/profile/<?php echo $this->session->id; ?>">
                    <img src="<?php echo $picture; ?>" alt="Profile Picture">
                    <div class="nav-menu-profile-picture-hover">
                        Edit
                    </div>
                </a>
            </div>
            <div class="nav-menu-user-name">
                <?php echo $this->session->name . " " . $this->session->surname; ?>
            </div>
            <div class="nav-menu-btn-logout nav-menu-btn">
                Sair
            </div>
        </div>
        <hr>
        <ul id="nav-menu-links">

        </ul>
    </div>
</div>

<div id="mobile-navbar">
    <div id="nav-menu-toggle">
        >
    </div>
</div>