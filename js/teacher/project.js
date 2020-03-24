var proj
var back_page

$(document).ready(() => {
	//open popup
	$('#removeProject').on('click', function(event){
		event.preventDefault();
		$('.cd-popup').addClass('is-visible');
	});
	
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });

    // back button
    $("#back").click(() => window.location.assign(back_page));

    //confirmed delete 
    //apagar projeto pelo id

    $("#confirmRemove").on('click', function(){
        const data = {
            projid : proj
        }
    
        $.ajax({
            type: "POST",
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "teacher/api/removeProject",
            data: data,
            success: function(data) {
                console.log(data);
                window.location.assign(back_page);
            },
            error: function(data) {
                console.log("Erro na API:")
                console.log(data)
            }
        });
    })
})

function setProj(id){
    proj = id;
}

function setBackPage(href){
    back_page = href;
}