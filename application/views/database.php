<title>A+ Database</title>
</head>

<body>
    <main style="width: 100%; text-align: center;">
    
      <h2>Scripts:</h2>
      <input type="button" value="Correr os 2 scripts de uma vez" id="btn-small">
      <input type="button" value="Correr apenas o large_script" id="btn-large">
      <input type="button" value="Correr o smart_script" id="btn-smart">
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
        $("#btn-smart").click((event)=>{
          event.preventDefault()
          $("#msg-box").html("A processar o pedido...")
          $.get( "<?=$base_url?>database/smart_script", function(data) {$("#msg-box").html(data); console.log(data)});
        })
      </script>
    </main>