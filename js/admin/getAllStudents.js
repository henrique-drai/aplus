$(document).ready(() => {
    getAllStudents();
})

function getAllStudents(){
    $.ajax({
        type: "GET",
        url: base_url + "api/admin/getAllStudents",
        success: function(data) {
            $("#show_students").css("display", "block");
            $(".student_row").remove();
            $("#mens_sem_alunos").remove();
            var linhas = '';
            if(data.students.length>0){
                for(i=0; i<data.students.length;i++){
                    linhas += '<tr class="student_row"><td>' + data.students[i].email + '</td><td>' + data.students[i].name +
                    '</td><td>' +  data.students[i].surname + '</td><td><button class="editUser" type="button">Editar</button></td><td>' +
                    '<button class="deleteUser" type="button">Apagar</button></td></tr>'; 
                }
                $('#show_students').append(linhas);
            }
            else{
                $("#mens_sem_alunos").remove();
                $("#show_students").css("display", "none");
                var mensagem = "<h2 id='mens_sem_alunos'>Não existe nenhum aluno</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            alert("Erro a mostrar os alunos!")
        }
    });
    
}

var timeout = setInterval(getAllStudents, 3000);   
