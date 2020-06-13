$(document).ready(() => {
	showCourseStudents();

	$("#search_text_students").keyup(function(){
		var s = $(this).val();
		if(s == '*'){
			showCourseStudents();
		}
		else if(s!=''){
			getSearchStudent(s);
		}
		else{
			$(".adminTable").remove();
		}
	})

	$("body").on("click", ".perfil", function() {
		var id = $(this).attr("id");
		window.location = base_url + "app/profile/" + id;
	})
})

function showCourseStudents() {
	$.ajax({
		type: "GET",
		url: base_url + "api/getCourseStudents/" + localStorage.cadeira_id,
		data: {user_id: localStorage.user_id},
		success: function (data) {
			var linhas = [];
			$("#students_list").empty();
			linhas.push('<tr><th>Email</th><th>Nome</th><th>Apelido</th><th></th></tr>');
			if (data.users_id.length > 0) {
				for (i = 0; i < data.users_id.length; i++) {
		
					linhas.push('<tr class="student_row"><td>' + data.info[i][0].email + '</td><td>' + data.info[i][0].name +
						'</td><td>' + data.info[i][0].surname + "<td><input type='button' value='Ver perfil' class='perfil' id='" + data.info[i][0].id + "'></td>");
				}

				$('.container2').pagination({
					dataSource: linhas,
					pageSize: 10,
					pageNumber: 1,
					callback: function(data, pagination) {
						$("#students_list").html(data);
					}
				})
			} else {
				$("#students_list").css("display", "none");
				var mensagem = "<h4 id='mens_sem_alunos'>Não existe nenhum aluno nesta cadeira</h4>";
				$("#msg-sem-alunos").append(mensagem)
			} 
		},
		error: function (data) {
			console.log("Houve um erro ao ir buscar os alunos da cadeira.");
		}
	});
}

function getSearchStudent(query){
    $.ajax({
        type: "GET",
        url: base_url + "api/getSearchStudentCourse",
        data: {query: query, cadeira_id: localStorage.cadeira_id, user_id: localStorage.user_id},
        success: function(data){
            makeStudentTable(data)
        },
        error: function(data) {
            $("#students_list").css("display", "none");
			var mensagem = "<h4 id='mens_sem_alunos'>Houve um erro ao ir buscar os alunos da cadeira</h4>";
			$("#msg-sem-alunos").append(mensagem)
        }
    })
}

function makeStudentTable(data){
	var linhas = [];
	$("#students_list").empty();
	linhas.push('<tr><th>Email</th><th>Nome</th><th>Apelido</th><th></th></tr>');
	if (data.length > 0) {
		for (i = 0; i < data.length; i++) {
			linhas.push('<tr class="student_row"><td>' + data[i].email + '</td><td>' + data[i].name +
				'</td><td>' + data[i].surname + "<td><input type='button' value='Ver perfil' class='perfil' id='" + data[i].id + "'></td>");
		}

		$('.container2').pagination({
			dataSource: linhas,
			pageSize: 10,
			pageNumber: 1,
			callback: function(data, pagination) {
				$("#students_list").html(data);
			}
		})
	} else {
		$("#students_list").css("display", "none");
		var mensagem = "<h4 id='mens_sem_alunos'>Não existe nenhum aluno nesta cadeira</h4>";
		$("#msg-sem-alunos").append(mensagem)
	} 
}