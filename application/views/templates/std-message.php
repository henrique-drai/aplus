<?php if(strlen($this->session->userdata('std-message'))): ?>

<div id="std-message" class="<?=$this->session->userdata('std-message-type')?>">
  <div class="content"> <?=$this->session->userdata('std-message')?> </div>
  <div class="close"> <i class="fa fa-times" aria-hidden="true"></i> </div>
</div>

<?php endif;
$this->session->set_userdata('std-message', "");
$this->session->set_userdata('std-message-type', "");
?>

<style>
  #std-message {
    color: white;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    padding: 8px;
    box-sizing: border-box;
    font-size: 15px;
  }
  #std-message.error { background-color: rgb(255, 72, 72); }
  #std-message.success { background-color: rgb(14, 183, 2); }
  #std-message > * {
    display: inline;
    padding: 5px 3px;
  }
  #std-message .close:hover {
    opacity: 0.5;
    cursor:pointer;
  }
</style>

<script>
  $(document).ready(()=>{
    $("#std-message .close").click((e)=>{
      $("#std-message").css("visibility","hidden")
    })
  })
</script>