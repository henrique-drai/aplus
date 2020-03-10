$(document).ready(() => {
    getAllStudents();
})

function getAllStudents(){
    $.ajax({
        type: "GET",
        url: base_url + "api/admin/getallstudents",
        success: function(data) {
            var linhas = '';
            for(i=0; i<data.students.length;i++){
                linhas += '<tr><td class="student_email">' + data.students[i].email + '</td><td>' + data.students[i].name +
                '</td><td>' +  data.students[i].surname + '</td><td><button class="editStudent" type="button">Editar</button></td><td>' +
                '<button class="deleteStudent" type="button">Apagar</button></td></tr>'; 
            }
            $('#show_students').append(linhas);
        },
        error: function(data) {
            alert("Erro a mostrar os alunos!")
        }
    });
    
}