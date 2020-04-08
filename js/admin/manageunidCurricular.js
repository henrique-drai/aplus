var unidCurr

$(document).ready(() => {

    $("#show_subjects").css("display", "none");
    $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    $("#Consultar_Cadeiras_Curso").css("display", "none");
    $("#Consultar_Cadeiras_Ano").css("display", "none");
    
    $("#Consultar_Cadeiras").change(function(){
        if($("#Consultar_Cadeiras").val() == "All"){
            getAllSubjects();
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
        }
        else if($("#Consultar_Cadeiras").val() == "Faculdade"){
            $("#show_subjects").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "block");

            getColleges("faculdade");

            $("#Consultar_Cadeiras_Faculdade").change(function(){
                if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
                    getAllCoursesByCollege($(this).val(), "faculdade");
                    
                }
                else{
                    $("#show_subjects").css("display", "none");
                    $("#mens_sem_cadeiras").remove();
                    $(".subject_row").remove();
                }
                
            })  
        }
        else if($("#Consultar_Cadeiras").val() == "Curso"){
            
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "block");
            $("#show_subjects").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");

            getColleges("curso");

            $("#Consultar_Cadeiras_Faculdade_Curso").change(function(){
                if($("#Consultar_Cadeiras_Faculdade_Curso").val() != "Selecione uma Faculdade"){
                    getAllCoursesByCollege($(this).val(), "curso");                    
                }
                else{
                    $("#show_subjects").css("display", "none");
                    $("#Consultar_Cadeiras_Curso").css("display", "none");
                    $("#mens_sem_cadeiras").remove();
                    $(".subject_row").remove();
                }
                
            })  
            $("#Consultar_Cadeiras_Curso").change(function(){
                if($("#Consultar_Cadeiras_Curso").val() != "Selecione um curso"){
                    $("#show_subjects").css("display", "none");
                    $(".subject_row").remove();
                    getAllSubjectsByCourse($(this).val());
                    
                }
                else{
                    $("#show_subjects").css("display", "none");
                    $("#mens_sem_cadeiras").remove();
                    $(".subject_row").remove();
                }
                
            })
        }
        else if($("#Consultar_Cadeiras").val() == "AnoLetivo"){
            $("#show_subjects").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");

            //Falta SELECT PARA O ANOLETIVO
            console.log("ano");
        }
        else{
            $("#show_subjects").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Ano").css("display", "none");
            $(".subject_row").remove();
        }
    });

    //open popup
	$('body').on('click','.deleteSubject', function(event){
        event.preventDefault();
        unidCurr = $(event.target).closest("tr");
        $('.cd-popup').addClass('is-visible');
    });
    
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });
    
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });

    $("body").on('click', "#confirmRemove", function(){
        $('.cd-popup').removeClass('is-visible');
        deleteSubject(unidCurr);
    })

})



function getAllSubjects(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjects",
        success: function(data) {
            $(".subject_row").remove();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();

            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){
                    getCourseNameById(data.subjects[i].curso_id, data.subjects[i]);
                }
                
            }
            else{
                $("#mens_sem_cadeiras").remove();
                $("#show_subjects").css("display", "none");
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular</h2>";
                $("body").append(mensagem)
            }
            $("#show_subjects").css("display", "block");
            
        },
        error: function(data) {
            $("#show_subjects").css("display", "none");
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();
            var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as unidades curriculares.</h2>";
            $("body").append(mensagem);
        }
    });
}

function getCourseNameById(course_id, dataSubject){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCourseNameById",
        data: {course_id},
        success: function(data) {

            // makeAllSubjectsTable(data.course.name, dataSubject)

            var linhas = '';
            linhas += '<tr class="subject_row"><td>' + dataSubject.code + '</td><td>' + data.course.name + 
                '</td><td>' + dataSubject.name + '</td><td>' + dataSubject.description + 
                '</td><td><button class="editSubject" type="button">Editar</button></td><td><button class="deleteSubject" type="button">Apagar</button></td></tr>'; 
            $('#show_subjects').append(linhas);
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar o curso.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}

// function makeAllSubjectsTable(coursename, dataSubject){
//     allSubjects = '<h1>Professores</h1>';
//     allSubjects += '<tr class="subject_row">' +
//         '<td>'+  dataSubject.code +'</td>' +
//         '<td>'+ coursename +'</td>' +
//         '<td>' + dataSubject.name + '</td>' +
//         '<td>' + dataSubject.description + '</td>' +
//         '<td><input class="editSubject" type="button" value="Editar"></td>' +
//         '<td><input class="deleteSubject" type="button" value="Eliminar"></td>' +
//         '</tr>'
   
//     var table = '<table class="adminTable" id="teacher_list">' +
//         '<tr><th>Código da UC</th>' +
//         '<th>Curso</th>' + 
//         '<th>Nome</th>' +
//         '<th>Descrição</th>' + 
//         '<th>Editar</th>' +
//         '<th>Apagar</th></tr>' +
//         allSubjects + 
//         '</table>'


//     $("#subject-container").html(table);    
// }

function getColleges(option){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllFaculdadesUnidCurricular",
        success: function(data) {
            
            $("#Consultar_Cadeiras_Faculdade option").remove();
            var linhas = '<option class="college_row">Selecione uma Faculdade</option>';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row" value=' + data.colleges[i].id +">" + data.colleges[i].name + '</option>'; 
                }
                if (option == "faculdade"){
                    $("#Consultar_Cadeiras_Faculdade").append(linhas);
                }
                else if(option == "curso"){
                    $("#Consultar_Cadeiras_Faculdade_Curso").append(linhas);
                }                
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar as faculdades.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}


function getAllCoursesByCollege(faculdade, option){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllCoursesByCollege",
        data: {faculdade},
        success: function(data) {
            $(".subject_row").remove();  
            $("#show_subjects").css("display", "none");
            if(data.courses.length>0){

                $("#Consultar_Cadeiras_Curso option").remove();
                var linhas = '<option class="college_row">Selecione um Curso</option>';

                for(i=0; i<data.courses.length;i++){

                    if(option == "faculdade"){
                        getAllSubjectsByCourse(data.courses[i].id);
                        $("#Consultar_Cadeiras_Curso").css("display", "none");
                    }
                    else if(option == "curso"){
                        linhas += '<option class="courses_row" value=' + data.courses[i].id +">" + data.courses[i].name + '</option>'; 
                    }
                }

                if(option == "curso"){
                    $("#mens_sem_cadeiras").remove();
                    $("#Consultar_Cadeiras_Curso").append(linhas);
                    $("#Consultar_Cadeiras_Curso").css("display", "block");

                }
               
            }
            else{
                $("#mens_sem_cadeiras").remove();
                $("#show_subjects").css("display", "none");
                $("#Consultar_Cadeiras_Curso").css("display", "none");
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe cursos nesta faculdade, logo não existem unidades curriculares.</h2>";
                $("body").append(mensagem);
            }
            
        },
        error: function(data) {
            $("#show_colleges").css("display", "none");
            $("#mens_sem_cadeiras").remove();
        }
    });
}

function getAllSubjectsByCourse(course){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjectsByCourse",
        data: {course},
        success: function(data) {
            $("#mens_sem_cadeiras").remove();  
            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){
                    $("#show_subjects").css("display", "block");  
                    getCourseNameById(data.subjects[i].curso_id, data.subjects[i]);  
                }
                  
            }    
            else{
                console.log("nao ha");
            }
            // if($("#show_subjects").css("display")!="block"){
            //     var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular nos cursos existentes</h2>";
            //     $("body").append(mensagem);
            // } 
           
        },
        error: function(data) {
            $("#show_colleges").css("display", "none");
            $("#mens_sem_cadeiras").remove();

        }
    });

}





function deleteSubject(linha){
$.ajax({
    type: "DELETE",
    url: base_url + "admin/api/deleteSubject",
    data: {code: linha.find("td:eq(0)").text()},
    success: function() {
        msgSucesso = "<p class='msgSucesso'>Faculdade eliminada com Sucesso.</p>";
        $("#show_subjects").after(msgSucesso)
        $(".msgSucesso").delay(2000).fadeOut();
        if($("#Consultar_Cadeiras").val() == "All"){
            getAllSubjects();
        }
        else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
            getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val(), "faculdade");
        }
        // else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
        //     getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val());
        // }
        // else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
        //     getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val());
        // }

        //PARA O CURSO E PARA O NO LETIVO

    },
    error: function() {
        msgErro = "<p class='msgErro'> Não foi possivel eliminar a faculdade.</p>";
        $("#show_subjects").after(msgErro)
        $(".msgErro").delay(2000).fadeOut();
    }
});
}