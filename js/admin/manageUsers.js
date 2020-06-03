var User
var responsive = 0; 

$(document).ready(() => {
    $("body").on("click", "#editUser-form-submit", () => editUser());    

    $('body').on('click','#deleteUser', function(event){
        event.preventDefault();
        User = $(event.target).closest("tr");
        $('#users_admin_delete').addClass('is-visible');
    });

    //close popup delete
	$('#users_admin_delete').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });
    
    $("body").on('click', "#confirmRemove", function(){
        $('#users_admin_delete').removeClass('is-visible');
        deleteUser(User);
    });

    // POPUP Edit
    $('body').on("click", "#editUser",function() {
        event.preventDefault();
        User = $(event.target).closest("tr");
        $('#users_admin_edit').addClass('is-visible');
        displayEditUser();
    });

    $('#users_admin_edit').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(".editUser_inputs input").val("");
			$(this).removeClass('is-visible');
		}
    });


    if (page_name=="students"){
        $("#search_text_students").keyup(function(event){
            var s = $(this).val();
            if(s == '*'){
                if(event.keyCode !=16){
                    $("#mens_erro_alunos").remove();
                    getAllStudents();
                }
               
            }
            else if(s!=''){
                getSearchStudent(s);
            }
            else{
                $(".adminTable").css("display","none");
                $(".paginationjs").remove();
            }
        })
    } else if (page_name=="teachers") {
        $("#search_text_profs").keyup(function(event){
            var s = $(this).val();
            if(s=="*"){
                if(event.keyCode !=16){
                    $("#mens_erro_professores").remove();
                    getAllTeachers();
                }
            }
            else if(s!=''){
                getSearchTeacher(s);
            }
            else{
                $(".adminTable").css("display","none");
                $(".paginationjs").remove();
            }
        })
    } 
    })

var oldEmail = "";
function deleteUser(linha){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteUser",
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
        url: base_url + "api/editUser",
        data: data,   
        success: function() {
            $("#msgStatus").text("Utilizador editado com sucesso");
            $("#msgStatus").show().delay(5000).fadeOut();

            if (page_name=="students"){
                if($("#search_text_students").val()=="*"){
                    getAllStudents();
                }
                else{
                    getSearchStudent($("#search_text_students").val());
                }   
                event.preventDefault();
                $(".editUser_inputs input").val("");
                $("#users_admin_edit").removeClass('is-visible');
                
                
            } else if (page_name=="teachers") {
                if($("#search_text_profs").val()=="*"){
                    getAllTeachers();
                }
                else{
                    getSearchTeacher($("#search_text_profs").val());
                }
                event.preventDefault();
                $(".editUser_inputs input").val("");
                $("#users_admin_edit").removeClass('is-visible');
            } 
        },
        error: function() {
            msgErro = "<p class='msgErro'> Não foi possivel editar o utilizador.</p>";
            $("#msgErroEditar").append(msgErro);
            $(".msgErro").delay(2000).fadeOut();
        }
    });
}



function getAllStudents(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllStudents",
        success: function(data) {
            $("#mens_sem_alunos").remove();
            if(data.students.length>0){
                makeStudentTable(data);
            }
            else{
                $(".paginationjs").remove();
                $(".adminTable").css("display","none");
                $("#mens_sem_alunos").remove();
                var mensagem = "<h2 id='mens_sem_alunos'>Não existe nenhum aluno</h2>";
                $("main").append(mensagem)
            }
            
        },
        error: function(data) {
            $(".paginationjs").remove();
            $(".adminTable").css("display","none");
            var mensagem = "<h2 id='mens_erro_alunos'>Não é possivel apresentar os alunos.</h2>";
            $("main").append(mensagem);
            $("#mens_erro_alunos").delay(2000).fadeOut();        }
    });
}

function makeStudentTable(data){
    $(".adminTable").css("display", "table");
    students = []
    for (i=0; i<data.students.length; i++){
        students.push('<tr class="students">' +
            '<td>'+ data.students[i].email +'</td>' +
            '<td>'+ data.students[i].name +'</td>' +
            '<td>' + data.students[i].surname + '</td>' +
            '<td><input id="editUser" type="button" value="Editar"></td>' +
            '<td><input id="deleteUser" type="button" value="Eliminar"></td>' +
            '</tr>'
        )
    }
    const mq = window.matchMedia( "(max-width: 610px)" );
    const mq2 = window.matchMedia( "(max-width: 400px)" );
    $('#student-container').pagination({
            dataSource: students,
            pageSize: 8,
            pageNumber: 1,
            callback: function(data, pagination) {
                $(".students").remove();
                $(".adminTable").append(data);
                if (mq.matches) {
                    $('.adminTable tr').find('td:eq(3)').remove();
                    $('.adminTable tr').find('td:eq(2)').remove();  
                    if (mq2.matches) {
                        $('.adminTable tr').find('td:eq(1)').remove();
                    } 
                } 
            }
    })  
    if (mq.matches && responsive == 0) {
        responsive=1;
        $('.adminTable tr').find('th:eq(3)').remove();
        $('.adminTable tr').find('th:eq(2)').remove();
        if (mq2.matches) {
            $('.adminTable tr').find('th:eq(1)').remove();
        } 
    }
}


function getSearchStudent(query){
    $.ajax({
        type: "GET",
        url: base_url + "api/getSearchStudent",
        data: {query: query},
        success: function(data){
            if(data.students != "no data"){
                $("#mens_erro_alunos").remove();
                makeStudentTable(data);
            }
            else{
                $(".adminTable").css("display","none")
                $(".paginationjs").remove();
                $("#mens_erro_alunos").remove();
                var mensagem = "<h2 id='mens_erro_alunos'>Não existe nenhum aluno com o email, nome ou apelido indicado.</h2>";
                $("#msgSemAlunos").append(mensagem);
            }
        },
        error: function(data) {
            $(".paginationjs").remove();
            $(".adminTable").css("display","none");
            var mensagem = "<h2 id='mens_erro_alunos'>Não é possivel apresentar os alunos.</h2>";
            $("msgErro").append(mensagem);
            $("#mens_erro_alunos").delay(2000).fadeOut();
        }
    })
}

function getSearchTeacher(query){
    $.ajax({
        type: "GET",
        url: base_url + "api/getSearchTeacher",
        data: {query: query},
        success: function(data){
            if(data.teachers != "no data"){
                $("#mens_erro_professores").remove();
                makeTeacherTable(data);
            }
            else{
                $(".paginationjs").remove();
                $(".adminTable").css("display","none");
                $("#mens_erro_professores").remove();
                var mensagem = "<h2 id='mens_erro_professores'>Não existe nenhum professor com o email, nome ou apelido indicado.</h2>";
                $("#msgSemAlunos").append(mensagem);
            }
        },
        error: function(data) {
            $(".paginationjs").remove();
            $(".adminTable").css("display","none");
            var mensagem = "<h2 id='mens_erro_professores'>Não é possivel apresentar os professores.</h2>";
            $("msgErro").append(mensagem);
            $("#mens_erro_professores").delay(2000).fadeOut();
        }
    })
}


function getAllTeachers(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllTeachers",
        success: function(data) {
            $("#mens_sem_teachers").remove();
            if(data.teachers.length>0){
                makeTeacherTable(data)
            }
            else{
                $(".paginationjs").remove();
                $(".adminTable").css("display","none");
                $("#mens_sem_teachers").remove();
                var mensagem = "<h2 id='mens_sem_teachers'>Não existe nenhum Professor</h2>";
                $("#msgErro").append(mensagem)
            }
            
        },
        error: function(data) {
            $(".paginationjs").remove();
            $(".adminTable").css("display","none");
            var mensagem = "<h2 id='mens_erro_professores'>Não é possivel apresentar os professores.</h2>";
            $("#msgErro").append(mensagem);
            $("#mens_erro_professores").delay(2000).fadeOut();
        }
    });
    
} 

function makeTeacherTable(data){
    $(".adminTable").css("display", "table");
    teachers = [];
    for (i=0; i<data.teachers.length; i++){
        teachers.push('<tr class="teachers">' +
            '<td>'+ data.teachers[i].email +'</td>' +
            '<td>'+ data.teachers[i].name +'</td>' +
            '<td>' + data.teachers[i].surname + '</td>' +
            '<td><input id="editUser" type="button" value="Editar"></td>' +
            '<td><input id="deleteUser" type="button" value="Eliminar"></td>' +
            '</tr>')
    }
   
    // var table = '<table class="adminTable" id="teacher_list">' +
    //     '<tr><th>Email</th>' +
    //     '<th>Nome</th>' + 
    //     '<th>Apelido</th>' +
    //     '<th>Editar</th>' +
    //     '<th>Apagar</th></tr>' +
    //     teacher + 
    //     '</table>'
    const mq = window.matchMedia( "(max-width: 610px)" );
    const mq2 = window.matchMedia( "(max-width: 400px)" );
    $('#teacher-container').pagination({
        dataSource: teachers,
        pageSize: 8,
        pageNumber: 1,
        callback: function(data, pagination) {
            $(".teachers").remove();
            $(".adminTable").append(data);
            if (mq.matches) {
                $('.adminTable tr').find('td:eq(3)').remove();
                $('.adminTable tr').find('td:eq(2)').remove();  
                if (mq2.matches) {
                    $('.adminTable tr').find('td:eq(1)').remove();
                } 
            } 
        }
    })   

    if (mq.matches && responsive == 0) {
        responsive=1;
        $('.adminTable tr').find('th:eq(3)').remove();
        $('.adminTable tr').find('th:eq(2)').remove();
        if (mq2.matches) {
            $('.adminTable tr').find('th:eq(1)').remove();
        } 
     
    }
}



