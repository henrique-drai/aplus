$(document).ready(() => {
	showCourseStudents();

})

function showCourseStudents() {
	console.log(localStorage.cadeira_id);
	$.ajax({
		type: "GET",
		headers: {
			"Authorization": localStorage.token
		},
		url: base_url + "api/getCourseStudents/" + localStorage.cadeira_id,
		
		success: function (data) {
			var linhas = '';
			if (data.users_id.length > 0) {
				for (i = 0; i < data.users_id.length; i++) {

					linhas += '<tr class="student_row"><td>' + data.info[i][0].email + '</td><td>' + data.info[i][0].name +
                        '</td><td>' + data.info[i][0].surname;
				}
				$('#students_list').append(linhas);
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




