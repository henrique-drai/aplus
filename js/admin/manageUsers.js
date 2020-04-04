$(document).ready(() => {
    $("body").on("click", ".editUser",() => displayEditUser());
    $("body").on("click", "#editUser-form-submit", () => editUser());
    $("body").on("click", ".deleteUser",() => popupVisible());
    
    //close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});

    if (page_name=="students"){
        getAllStudents();
        setInterval(getAllStudents, 3000);
    } else if (page_name=="teachers") {
        getAllTeachers();
        setInterval(getAllTeachers, 3000); 
    } 
})

function popupVisible(){
    event.preventDefault();
    var linha = $(event.target).closest("tr");
    $('.cd-popup').addClass('is-visible');
    $("body").on('click', "#confirmRemove", function(){
        $('.cd-popup').removeClass('is-visible');
        deleteUser(linha);
        event.preventDefault();

    })
}

var oldEmail = "";

function deleteUser(linha){
    $.ajax({
        type: "DELETE",
        url: base_url + "admin/api/deleteUser",
        data: {email: linha.find("td:eq(0)").text()},
        success: function() {
            if (page_name=="students"){
                getAllStudents();
            } else if (page_name=="teachers") {
                getAllTeachers();
            } 
        },
        error: function() {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}

function displayEditUser(){
    var linha = $(event.target).closest("tr");
    oldEmail = linha.find("td:eq(0)").text();
    const data = {
        email: oldEmail,
    }
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getUserByEmail",
        data: data,   
        success: function(data) {
            $("#editUser-form input[name='name']").val(data.name);
            $("#editUser-form input[name='surname']").val(data.surname);
            $("#editUser-form input[name='email']").val(data.email);
            $("#editUser-form").css("display", "block");
        },
        error: function() {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar o utilizador.</p>";
            $("body").append(msgErro);
        }
    });
}

function editUser(){
    const data = {
        name:       $("#editUser-form input[name='name']").val(),
        surname:    $("#editUser-form input[name='surname']").val(),
        email:      $("#editUser-form input[name='email']").val(),
        password:   $("#editUser-form input[name='password']").val(),
        oldemail:   oldEmail,
    }

    $.ajax({
        type: "POST",
        url: base_url + "admin/api/editUser",
        data: data,   
        success: function() {
            if (page_name=="students"){
                getAllStudents();
                $("#editUser-form").css("display", "none");
            } else if (page_name=="teachers") {
                getAllTeachers();
                $("#editUser-form").css("display", "none");
            } 
        },
        error: function() {
            msgErro = "<p class='msgErro'> Não foi possivel editar o utilizador.</p>";
            $("body").append(msgErro);
            $(".msgErro").delay(2000).fadeOut();
        }
    });
}



function getAllStudents(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllStudents",
        success: function(data) {
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
            console.log("Erro a mostrar os alunos!")
        }
    });
}


function getAllTeachers(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllTeachers",
        success: function(data) {
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
            console.log("Erro a mostrar os professores!")
        }
    });
    
} 