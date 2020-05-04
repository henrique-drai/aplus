$(document).ready(() => {

    // dar set no id do grupo pelo url - ou seja - se o utilizador vier para esta pagina pelo link.

    var link = location.href.split("grupo");
    var id = link[1].replace("/","");
    localStorage.setItem("grupo_id", id);

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/student/memberRtg/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
     
        window.location = base_url + "app/student/grupos/ficheiros/" + localStorage.grupo_id;
    })

    getAllTasks(localStorage.grupo_id);


});

function getAllTasks($grupo_id) {
    console.log(localStorage.grupo_id);
    $.ajax({
        type: "GET",
        headers: {
        	"Authorization": localStorage.token
        },
        url: base_url + "api/getAllTasks/" + localStorage.grupo_id,

        success: function (data) {
        	console.log(data);

        	var linhas = '';
        	if (data.tarefas.length > 0) {
        		for (i = 0; i < data.tarefas.length; i++) {
                    for (i = 0; i < data.membro_nome.length; i++) {

        			    linhas += '<tr class="tarefa_row"><td>' + data.tarefas[i].name + '</td><td>' + data.tarefas[i].description +
                            '</td><td>' + data.membro_nome[i][0].name + '</td><td>' + data.tarefas[i].start_date + '</td><td>' + data.tarefas[i].done_date;
            
                    }
                }
        	$('#tab-gerir-tarefas').append(linhas);
        	} else {
        		$("#tab-gerir-tarefas").css("display", "none");
        		var mensagem = "<h4 id='mens_sem_alunos'>Não existem tarefas atribuidas</h4>";
        		$("#msg-sem-tarefas").append(mensagem)
        	}
        },
        error: function (data) {
        	console.log("Houve um erro ao ir buscar as tarefas.");
        }
    });
}
