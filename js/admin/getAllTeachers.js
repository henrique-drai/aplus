$(document).ready(() => {
    getAllTeachers();
})

function getAllTeachers(){
    $.ajax({
        type: "GET",
        url: base_url + "api/admin/getAllTeachers",
        success: function(data) {
            $("#show_teachers").css("display", "block");
            $(".teacher_row").remove();
            $("#mens_sem_teachers").remove();
            var linhas = '';
            if(data.teachers.length>0){
                for(i=0; i<data.teachers.length;i++){
                    linhas += '<tr class="teacher_row"><td>' + data.teachers[i].email + '</td><td>' + data.teachers[i].name +
                    '</td><td>' +  data.teachers[i].surname + '</td><td><button class="editUser" type="button">Editar</button></td><td>' +
                    '<button class="deleteUser" type="button">Apagar</button></td></tr>'; 
                }
                $('#show_teachers').append(linhas);
            }
            else{
                $("#mens_sem_teachers").remove();
                $("#show_teachers").css("display", "none");
                var mensagem = "<h2 id='mens_sem_teachers'>Não existe nenhum aluno</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            alert("Erro a mostrar os professores!")
        }
    });
    
}

var timeout = setInterval(getAllTeachers, 3000);   
