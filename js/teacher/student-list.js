$(document).ready(() => {
    showCourseStudents();

})

function showCourseStudents() {
	console.log(localStorage.cadeira_id);
	$.ajax({
		type: "GET",
		url: base_url + "teacher/api/getCourseStudents",
		data: {
			id: localStorage.cadeira_id
		},
		success: function (data) {
			console.log(data);
			$("#students_list").css("display", "block");
			$(".student_row").remove();
			$("#mens_sem_alunos").remove();
			var linhas = '';
			if (data.users_id.length > 0) {
				for (i = 0; i < data.users_id.length; i++) {
                    console.log(data.info[i]);

					linhas += '<tr class="student_row"><td>' + data.info[i][0].email + '</td><td>' + data.info[i][0].name +
                        '</td><td>' + data.info[i][0].surname;
                    console.log(data.info[i].email);
				}
				$('#students_list').append(linhas);
			} else {
				$("#mens_sem_alunos").remove();
				$("#show_students").css("display", "none");
				var mensagem = "<h2 id='mens_sem_alunos'>Não existe nenhum aluno nesta cadeira</h2>";
				$("body").append(mensagem)
			}
		},
		error: function (data) {
			console.log("Houve um erro ao ir buscar os alunos da cadeira.");
		}
	});
}
