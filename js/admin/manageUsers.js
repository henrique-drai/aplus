$(document).ready(() => {
    $("body").on("click", ".editUser",() => displayEditUser());
    $("body").on("click", "#editUser-form-submit", () => editUser());
    $("body").on("click", ".deleteUser",() => deleteUser());
    

    if (page_name=="Students"){
        getAllStudents();
        setInterval(getAllStudents, 3000);
    } else if (page_name=="Teachers") {
        getAllTeachers();
        setInterval(getAllTeachers, 3000); 
    } 
})


var oldEmail = "";

function deleteUser(){
    var linha = $(event.target).closest("tr");
    $.ajax({
        type: "DELETE",
        url: base_url + "api/admin/deleteUser",
        data: {email: linha.find("td:eq(0)").text()},
        success: function() {
            if (page_name=="Students"){
                getAllStudents();
            } else if (page_name=="Teachers") {
                getAllTeachers();
            } 
        },
        error: function() {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}

function displayEditUser(){
    $("#editUser-form").css("display", "block");
    var linha = $(event.target).closest("tr");
    oldEmail = linha.find("td:eq(0)").text();
}

function editUser(){
    const data = {
        name:       $("#editUser-form input[name='name']").val(),
        surname:    $("#editUser-form input[name='surname']").val(),
        email:      $("#editUser-form input[name='email']").val(),
        password:   $("#editUser-form input[name='password']").val(),
        role:       $("#editUser-form select[name='role']").val(),
        oldemail:   oldEmail,
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/admin/editUser",
        data: data,   
        success: function() {
            if (page_name=="Students"){
                getAllStudents();
            } else if (page_name=="Teachers") {
                getAllTeachers();
            } 
        },
        error: function() {
            msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            $("body").append(msgErro);
        }
    });
}



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