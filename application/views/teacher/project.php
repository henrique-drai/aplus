<title>A+ for Teachers</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/teacher-projects.css">
<script>setPageName("subjects")</script>
<script src="<?php echo $base_url; ?>js/teacher/nav-menu.js"></script>
<script src="<?php echo $base_url; ?>js/teacher/project.js"></script>
</head>

<body>
    <div id="nav-menu-hook"></div>
    <main>
    <div class="container">
        <h1>Projeto x</h1>

        <div class="container-header">
            <a class="back-a" href="<?php echo $base_url; ?>subjects/subject/<?php echo $subject->code; ?>"  class="button">Back</a>
            <h3>Grupos</h3>
        </div>

        <div class="flex-container">
            <div class="item">
                <p>1</p>
            </div>
            <div class="item">
                <p>2</p>
            </div>
            <div class="item">
                <p>3</p>
            </div>
            <div class="item">
                <p>4</p>
            </div>
            <div class="item">
                <p>5</p>
            </div>
            <div class="item">
                <p>6</p>
            </div>
            <div class="item">
                <p>7</p>
            </div>
            <div class="item">
                <p>8</p>
            </div>
            <div class="item">
                <p>9</p>
            </div>
            <div class="item">
                <p>10</p>
            </div>
            <div class="item">
                <p>11</p>
            </div>
            <div class="item">
                <p>12</p>
            </div>
            <div class="item">
                <p>13</p>
            </div>
            <div class="item">
                <p>14</p>
            </div>
        </div>

        <div class="cd-popup" role="alert">
	        <div class="cd-popup-container">
		        <p>Tem a certeza que deseja eliminar o projeto?</p>
                <ul class="cd-buttons">
                    <li><a href="#" id="confirmRemove">Yes</a></li>
                    <li><a href="#" id="closeButton">No</a></li>
                </ul>
		        <a class="cd-popup-close"></a>
	        </div> <!-- cd-popup-container -->
        </div> <!-- cd-popup -->

        <div class="buttons-container">
            <a id="removeProject" class="small-button">Eliminar projeto</a>
            <a id="viewEtapas" class="small-button">Ver etapas</a>
        </div>
    </div>
    </main>