<title>A+ for Students</title>
<script>setPageName("grupos")</script>
<script src="<?php echo $base_url; ?>js/student/grupos.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/student/popup.css">


</head>

<body>
<?php $this->view('templates/nav-menu'); ?>
    <main>
        <h4 class="breadcrumb">
            <a href="<?php echo base_url(); ?>app/grupos">Grupos</a>
        </h4>

        <label for="groupStatus"></label>
        
        <select id="status" name="groupStatus">
            <option value="allGroups">Todos os Grupos</option>
            <option value="ongoing">Em curso</option>
            <option value="terminated">Terminados</option>
        </select>

        <div class="form-container">
            <div class="grupos"></div>
        </div>


    </main>

    <style>
        /* .grupos{
            display: flex;
            flex-wrap: wrap;
        }

        .groupMembros{
            min-height: 195px;
            width: 320px;
            background-color: rgb(255, 255, 255);
            box-shadow: rgba(4, 4, 4, 0.1) 0px 0px 5px 0px;
            display: flex;
            flex-direction: column;
            margin: 10px;
            overflow: hidden;
        }
        #groupId {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            padding: 15px 10px 10px 20px;
            color: #928f8f;
        }

        #subject, #project{
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            padding: 5px 10px 5px 17px;
        }

        #subject{
            font-size: 20px;
            font-weight:bold;
        }

        #statusOff, #statusOn{
            text-align:center;
        } */

       

    </style>