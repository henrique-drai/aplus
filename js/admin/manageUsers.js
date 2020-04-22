var User

$(document).ready(() => {
    $("body").on("click", "#editUser-form-submit", () => editUser());    

    $('body').on('click','#deleteUser', function(event){
        event.preventDefault();
        User = $(event.target).closest("tr");
        $('.cd-popup').addClass('is-visible');
    });

    //close popup delete
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });
    
    $("body").on('click', "#confirmRemove", function(){
        $('.cd-popup').removeClass('is-visible');
        deleteUser(User);
    });

    // POPUP Edit
    $('body').on("click", "#editUser",function() {
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');
        displayEditUser();
    });

    $('.close').click(function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    $('#popup_button').click(function() {
        var name = $("input[type='text']").val();
        var desc = $("textarea").val();
        insertThread(name, desc);
        getThreads();
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })


    if (page_name=="students"){
        $("#search_text_students").keyup(function(){
            var s = $(this).val();
            if(s == '*'){
                getAllStudents();
            }
            else if(s!=''){
                getSearchStudent(s);
            }
            else{
                $(".adminTable").remove();
            }
        })
    } else if (page_name=="teachers") {
        $("#search_text_profs").keyup(function(){
            var s = $(this).val();
            if(s=="*"){
                getAllTeachers();
            }
            else if(s!=''){
                getSearchTeacher(s);
            }
            else{
                $(".adminTable").remove();
            }
        })
    } 
    })

var oldEmail = "";

function deleteUser(linha){
    $.ajax({
        type: "DELETE",
        headers: {"Authorization": localStorage.token},
        url: base_url + "admin/api/deleteUser",
        data: {email: linha.find("td:eq(0)").text()},
        success: function() {
            if (page_name=="students"){
                if($("#search_text_students").val()=="*"){
                    getAllStudents();
                }
                else{
                    getSearchStudent($("#search_text_students").val());
                }   
            } else if (page_name=="teachers") {
                if($("#search_text_profs").val()=="*"){
                    getAllTeachers();
                }
                else{
                    getSearchTeacher($("#search_text_profs").val());
                }
            } 
        },
        error: function() {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}

function displayEditUser(){
    var linha = $(event.target).closest("tr");
    name = linha.find("td:eq(1)").text();
    surname = linha.find("td:eq(2)").text();
    oldEmail =  linha.find("td:eq(0)").text();
    
   
    $("#editUser-form input[name='name']").val(name);
    $("#editUser-form input[name='surname']").val(surname);
    $("#editUser-form input[name='email']").val(oldEmail);
    $(".popup").css("display", "block");
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
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/editUser",
        data: data,   
        success: function() {
            if (page_name=="students"){
                if($("#search_text_students").val()=="*"){
                    getAllStudents();
                }
                else{
                    getSearchStudent($("#search_text_students").val());
                }   
                $(".overlay").css('visibility', 'hidden');
                $(".overlay").css('opacity', '0');
                $(".popup").css("display", "none");
            } else if (page_name=="teachers") {
                if($("#search_text_profs").val()=="*"){
                    getAllTeachers();
                }
                else{
                    getSearchTeacher($("#search_text_profs").val());
                }
                $(".overlay").css('visibility', 'hidden');
                $(".overlay").css('opacity', '0');
                $(".popup").css("display", "none");
            } 
        },
        error: function() {
            msgErro = "<p class='msgErro'> Não foi possivel editar o utilizador.</p>";
            $("#msgStatus").append(msgErro);
            $(".msgErro").delay(2000).fadeOut();
        }
    });
}



function getAllStudents(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getAllStudents",
        success: function(data) {
            $("#mens_sem_alunos").remove();
            if(data.students.length>0){
                makeStudentTable(data);
            }
            else{
                $("#mens_sem_alunos").remove();
                var mensagem = "<h2 id='mens_sem_alunos'>Não existe nenhum aluno</h2>";
                $("main").append(mensagem)
            }
            
        },
        error: function(data) {
            var mensagem = "<h2 id='mens_erro_alunos'>Não é possivel apresentar os alunos.</h2>";
            $("main").append(mensagem);
            $("#mens_erro_alunos").delay(2000).fadeOut();        }
    });
}

function makeStudentTable(data){
    student = '';
    for (i=0; i<data.students.length; i++){
        student += '<tr>' +
            '<td>'+ data.students[i].email +'</td>' +
            '<td>'+ data.students[i].name +'</td>' +
            '<td>' + data.students[i].surname + '</td>' +
            '<td><input id="editUser" type="button" value="Editar"></td>' +
            '<td><input id="deleteUser" type="button" value="Eliminar"></td>' +
            '</tr>'
    }
   
    var table = '<table class="adminTable" id="student_list">' +
        '<tr><th>Email</th>' +
        '<th>Nome</th>' + 
        '<th>Apelido</th>' +
        '<th>Editar</th>' +
        '<th>Apagar</th></tr>' +
        student + 
        '</table>'


    $("#student-container").html(table);    
}


function getSearchStudent(query){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getSearchStudent",
        data: {query: query},
        success: function(data){
            if(data.students != "no data"){
                $("#mens_erro_alunos").remove();
                makeStudentTable(data);
            }
            else{
                $(".adminTable").remove();
                $("#mens_erro_alunos").remove();
                var mensagem = "<h2 id='mens_erro_alunos'>Não existe nenhum aluno com o email, nome ou apelido indicado.</h2>";
                $("#msgStatus").append(mensagem);
            }
        },
        error: function(data) {
            var mensagem = "<h2 id='mens_erro_alunos'>Não é possivel apresentar os professores.</h2>";
            $("msgStatus").append(mensagem);
            $("#mens_erro_alunos").delay(2000).fadeOut();
        }
    })
}

function getSearchTeacher(query){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getSearchTeacher",
        data: {query: query},
        success: function(data){
            if(data.teachers != "no data"){
                $("#mens_erro_professores").remove();
                makeTeacherTable(data);
            }
            else{
                $(".adminTable").remove();
                $("#mens_erro_professores").remove();
                var mensagem = "<h2 id='mens_erro_professores'>Não existe nenhum professor com o email, nome ou apelido indicado.</h2>";
                $("#msgStatus").append(mensagem);
            }
        },
        error: function(data) {
            var mensagem = "<h2 id='mens_erro_professores'>Não é possivel apresentar os professores.</h2>";
            $("msgStatus").append(mensagem);
            $("#mens_erro_professores").delay(2000).fadeOut();
        }
    })
}


function getAllTeachers(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getAllTeachers",
        success: function(data) {
            $("#mens_sem_teachers").remove();
            if(data.teachers.length>0){
                makeTeacherTable(data)
            }
            else{
                $("#mens_sem_teachers").remove();
                var mensagem = "<h2 id='mens_sem_teachers'>Não existe nenhum aluno</h2>";
                $("#msgStatus").append(mensagem)
            }
            
        },
        error: function(data) {
            var mensagem = "<h2 id='mens_erro_professores'>Não é possivel apresentar os professores.</h2>";
            $("#msgStatus").append(mensagem);
            $("#mens_erro_professores").delay(2000).fadeOut();
        }
    });
    
} 

function makeTeacherTable(data){
    teacher = '';
    for (i=0; i<data.teachers.length; i++){
        teacher += '<tr>' +
            '<td>'+ data.teachers[i].email +'</td>' +
            '<td>'+ data.teachers[i].name +'</td>' +
            '<td>' + data.teachers[i].surname + '</td>' +
            '<td><input id="editUser" type="button" value="Editar"></td>' +
            '<td><input id="deleteUser" type="button" value="Eliminar"></td>' +
            '</tr>'
    }
   
    var table = '<table class="adminTable" id="teacher_list">' +
        '<tr><th>Email</th>' +
        '<th>Nome</th>' + 
        '<th>Apelido</th>' +
        '<th>Editar</th>' +
        '<th>Apagar</th></tr>' +
        teacher + 
        '</table>'


    $("#teacher-container").html(table);    
}



