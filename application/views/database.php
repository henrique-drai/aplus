<title>A+ Database</title>
</head>

<body>
    <main style="width: 100%; text-align: center;">
    
      <h2>Scripts:</h2>
      <input type="button" value="Reset" id="btn-reset">
      <div id="msg-box"></div>




      <script>
        $("#btn-reset").click((event)=>{
          event.preventDefault()
          $("#msg-box").html("A processar o pedido...")
          $.get( "<?=$base_url?>database/small_script", function(data) {$("#msg-box").html(data)});
        })
      </script>
    </main>