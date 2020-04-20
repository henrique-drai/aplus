$(document).ready(function(){
  //PARA ABRIR O POPUP:
  /*
	$('.trigger').click(()=>{
		$('.cd-popup').addClass('is-visible')
  })
  */
	
	//FECHAR O POPUP:
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
      event.preventDefault();
			$(this).removeClass('is-visible');
		}
  });
  
  $('.cd-popup #closeButton').click(()=>{
    $('.cd-popup').removeClass('is-visible')
  })
});