<title>A+ Database</title>
</head>

<body>
    <main style="width: 100%; text-align: center;">
    
      <h2>Scripts:</h2>
      <input type="button" value="Small Reset" id="btn-small">
      <input type="button" value="Large Reset" id="btn-large">
      <div id="msg-box"></div>




      <script>
        $("#btn-small").click((event)=>{
          event.preventDefault()
          $("#msg-box").html("A processar o pedido...")
          $.get( "<?=$base_url?>database/small_script", function(data) {$("#msg-box").html(data)});
        })
        $("#btn-large").click((event)=>{
          event.preventDefault()
          $("#msg-box").html("A processar o pedido...")
          $.get( "<?=$base_url?>database/large_script", function(data) {$("#msg-box").html(data)});
        })
      </script>
    </main>