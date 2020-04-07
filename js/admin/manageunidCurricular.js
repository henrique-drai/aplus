var unidCurr
var allSubjects = "";

$(document).ready(() => {

    cleanTable();



    $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    $("#Consultar_Cadeiras_Curso").css("display", "none");
    $("#Consultar_Cadeiras_Ano").css("display", "none");
    
    $("#Consultar_Cadeiras").change(function(){
        if($("#Consultar_Cadeiras").val() == "All"){

            cleanTable();
            allSubjects = "";
            getAllSubjects();
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
        }
        else if($("#Consultar_Cadeiras").val() == "Faculdade"){

            cleanTable();

            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "block");

            getColleges("faculdade");

            $("#Consultar_Cadeiras_Faculdade").change(function(){
                if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
                    cleanTable();
                    //DAR A ESCREVER DUAS VEZES AQUI
                    getAllCoursesByCollege($(this).val(), "faculdade");
                    
                }
                else{
                    cleanTable();

                    $("#mens_sem_cadeiras").remove();
                    $(".subject_row").remove();
                }
                
            })  
        }
        else if($("#Consultar_Cadeiras").val() == "Curso"){
            
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "block");;
            
            cleanTable();

            $("#Consultar_Cadeiras_Faculdade").css("display", "none");

            getColleges("curso");

            $("#Consultar_Cadeiras_Faculdade_Curso").change(function(){
                if($("#Consultar_Cadeiras_Faculdade_Curso").val() != "Selecione uma Faculdade"){
                    cleanTable();
                    getAllCoursesByCollege($(this).val(), "curso");                    
                }
                else{
                    cleanTable();

                    $("#Consultar_Cadeiras_Curso").css("display", "none");
                    $("#mens_sem_cadeiras").remove();
                    
                }
                
            })  
            $("#Consultar_Cadeiras_Curso").change(function(){
                if($("#Consultar_Cadeiras_Curso").val() != "Selecione um curso"){
                    cleanTable();

                    getAllSubjectsByCourse($(this).val());
                    
                }
                else{
                    cleanTable();
                    $("#mens_sem_cadeiras").remove();
                    
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
            cleanTable();
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Ano").css("display", "none");
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

function cleanTable(){
    allSubjects = "";
    $("#subject_list").remove();
    $(".subject_row").remove();
}

function getCourseNameById(course_id, dataSubject){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCourseNameById",
        data: {course_id},
        success: function(data) {
            allSubjects += '<tr class="subject_row">' +
                '<td>'+ dataSubject.code +'</td>' +
                '<td>'+ data.course.name +'</td>' +
                '<td>'+ dataSubject.name + '</td>' +
                '<td>'+ dataSubject.description + '</td>' +
                '<td><input class="editSubject" type="button" value="Editar"></td>' +
                '<td><input class="deleteSubject" type="button" value="Eliminar"></td>' +
                '</tr>';
            makeAllSubjectsTable();

            // var linhas = '';
            // linhas += '<tr class="subject_row"><td>' + dataSubject.code + '</td><td>' + data.course.name + 
            //     '</td><td>' + dataSubject.name + '</td><td>' + dataSubject.description + 
            //     '</td><td><button class="editSubject" type="button">Editar</button></td><td><button class="deleteSubject" type="button">Apagar</button></td></tr>'; 
            // $('#show_subjects').append(linhas);
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar o curso.</p>";
            $("#register-faculdade-form").after(msgErro);
        },
    });
}


function getAllSubjects(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjects",
        success: function(data) {
            cleanTable();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();

            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){
                    getCourseNameById(data.subjects[i].curso_id, data.subjects[i]);
                }
                
            }
            else{
                $("#mens_sem_cadeiras").remove();
                cleanTable();
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular</h2>";
                $("body").append(mensagem)
            }
            // $("#show_subjects").css("display", "block");
            
        },
        error: function(data) {
            cleanTable();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();
            var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as unidades curriculares.</h2>";
            $("body").append(mensagem);
        }
    });
}



function makeAllSubjectsTable(){   
    var table = '<table class="adminTable" id="subject_list">' +
        '<tr><th>Código da UC</th>' +
        '<th>Curso</th>' + 
        '<th>Nome</th>' +
        '<th>Descrição</th>' + 
        '<th>Editar</th>' +
        '<th>Apagar</th></tr>' +
        allSubjects + 
        '</table>'


    $("#subject-container").html(table);    
}

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
            cleanTable();
            if(data.courses.length>0){

                $("#Consultar_Cadeiras_Curso option").remove();
                var linhas = '<option class="college_row">Selecione um Curso</option>';
                console.log(data.courses)
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
                cleanTable();
                $("#Consultar_Cadeiras_Curso").css("display", "none");
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe cursos nesta faculdade, logo não existem unidades curriculares.</h2>";
                $("body").append(mensagem);
            }
            
        },
        error: function(data) {
            cleanTable();
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
                    getCourseNameById(data.subjects[i].curso_id, data.subjects[i]);  
                }
                  
            }    
            // else{
                // FALTA AQUI CENAS PARA QUANDO NAO A CADEIRAS
            // }
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
        $("body").after(msgSucesso)
        $(".msgSucesso").delay(2000).fadeOut();
        if($("#Consultar_Cadeiras").val() == "All"){
            getAllSubjects();
        }
        else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
            getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val(), "faculdade");
        }
        else if($("#Consultar_Cadeiras_Curso").val() != "Selecione um curso"){
            getAllSubjectsByCourse($("#Consultar_Cadeiras_Curso").val());
        }
        // else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
        //     getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val());
        // }

        //PARA O CURSO E PARA O NO LETIVO

    },
    error: function() {
        msgErro = "<p class='msgErro'> Não foi possivel eliminar a faculdade.</p>";
        $("body").after(msgErro)
        $(".msgErro").delay(2000).fadeOut();
    }
});
}