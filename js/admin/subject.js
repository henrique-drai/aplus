var aluno = "";

$(document).ready(() => {
    getCadeiraNome();
    getStudents();

     //open popup
	$('body').on('click','.deleteStudentSubject', function(event){
        event.preventDefault();
        aluno = $(event.target).closest("tr");
        $('#student_subject_admin_delete').addClass('is-visible');
    });
    
	//close popup
	$('#student_subject_admin_delete').on('click', function(event){
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

    $("body").on('click', "#confirmRemove", function(){
        $('#student_subject_admin_delete').removeClass('is-visible');
        deleteStudentSubject();
    })

});


function getCadeiraNome(){
    var idcadeira = localStorage.getItem("cadeira_id");
    $.ajax({
        type: "GET",
        url: base_url + "api/adminSubject",
        data: {idcadeira},
        success: function(data) {
            $("#adminCadeira").text(data.cadeira["name"]);
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function getStudents(){
    var idcadeira = localStorage.getItem("cadeira_id");
    $.ajax({
        type: "GET",
        url: base_url + "api/getStudentsSubjectAdmin",
        data: {idcadeira},
        success: function(data) {
            if(data.info != ""){
                makeStudentSubjectTable(data);
            }
            else{
                $("#aluno-subject-container").text("Não existem alunos nesta unidade curricular");
            }
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}


function makeStudentSubjectTable(data){   
    var allStudentSubject="";
    for(i=0; i<data.info.length;i++){
        allStudentSubject += '<tr class="student_subject_row">' +
                    '<td>'+ data.info[i][0].email +'</td>' +
                    '<td>'+ data.info[i][0].name + " " +data.info[i][0].surname + '</td>' +
                    '<td><input class="deleteStudentSubject" type="button" value="Eliminar"></td>' +
                    '</tr>';
    }
    var table = '<h2>Alunos Inscritos</h2>' + 
    '<table class="adminTable" id="student_subject_list">' +
    '<tr><th>Email</th>' +
    '<th>Nome</th>' +
    '<th>Apagar</th>' +
    allStudentSubject + 
    '</table>'

    $("#aluno-subject-container").html(table);       
}


function deleteStudentSubject(){
    var idcadeira = localStorage.getItem("cadeira_id");
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteUserFromSubject",
        data: {aluno: aluno.find("td:eq(0)").text(),
                cadeira: idcadeira},
        success: function(data) {
            getStudents();
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });

}