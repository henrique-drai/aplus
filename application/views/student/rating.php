<title>A+ for Teachers</title>
<script>setPageName("rating")</script>
<script src="<?php echo $base_url; ?>js/student/rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/popup.css">


</head>

<?php
$file = "uploads/profile/" . $this->session->id . ".jpg";
if(!file_exists($file)) {$file = "uploads/profile/default.jpg";}
$picture = $base_url . $file . "?" . time();
?>



<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>app/student/rating">Rating</a>
        </h4>
        <h1>Grupos</h1>
        <div class="form-container">
            <div class="grupos"></div>
        </div>


    </main>