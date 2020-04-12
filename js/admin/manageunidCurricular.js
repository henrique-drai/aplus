var unidCurr
var allSubjects = "";
var flagprogressbar = true;

$(document).ready(() => {

    $(".progress").css("display", "none");
    $(".progress-bar").css("diplay","none");

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
        else if($("#Consultar_Cadeiras").val() == "Faculdade"){  // QUER VER POR FACULDADES

            cleanTable();

            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "block");

            getColleges("faculdade");
            $("#Consultar_Cadeiras_Faculdade").unbind("change");
            $("#Consultar_Cadeiras_Faculdade").change(function(){
                
                cleanTable();
                if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
                    getAllCoursesByCollege($(this).val(), "faculdade");
                    
                }
                else{
                    $("#mens_sem_cadeiras").remove();
                    $(".subject_row").remove();
                }
                
            })  
        }
        else if($("#Consultar_Cadeiras").val() == "Curso"){ // QUER VER POR CURSOS
            
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "block");;
            
            cleanTable();

            $("#Consultar_Cadeiras_Faculdade").css("display", "none");

            getColleges("curso");

            $("#Consultar_Cadeiras_Faculdade_Curso").unbind("change");
            $("#Consultar_Cadeiras_Curso").unbind("change");

            $("#Consultar_Cadeiras_Faculdade_Curso").change(function(){
                cleanTable();
                if($("#Consultar_Cadeiras_Faculdade_Curso").val() != "Selecione uma Faculdade"){

                    getAllCoursesByCollege($(this).val(), "curso");                    
                }
                else{

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
            $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            $("#Consultar_Cadeiras_Ano").css("display", "block");
            $("#Consultar_Cadeiras_Ano").unbind("change");
            getAllYears();

            $("#Consultar_Cadeiras_Ano").change(function(){
                cleanTable();
                if($("#Consultar_Cadeiras_Ano").val() != "Selecione um Ano Letivo"){
                    getAllCoursesByYear($(this).val());                    
                }
            })

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

function getCourseNameById(course_id, dataSubject, count=0, length){
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
            
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar o curso.</p>";
            $("#register-faculdade-form").after(msgErro);
        },
       complete: function(data){
            if(count == length){ 
                $("#mens_sem_cadeiras").remove();
                $(".progress").css("display", "none");
                $(".progress-bar").css("diplay","none");
                makeAllSubjectsTable();
                flagprogressbar=false;
            }
            else if (flagprogressbar && count!=length){
                
                $(".progress").css("display", "block");
                $(".progress-bar").css("display","block");
                $(".progress-bar").css("width",(count*100)/length+"%");
                $(".progressbar_percentage").text((count*100)/length + "%");
            }
       } 
    });
}


function getAllSubjects(){

    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjects",
        success: function(data) {
            flagprogressbar = true;
            cleanTable();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();
            var count = 0;
            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){
                    count+=1;
                    getCourseNameById(data.subjects[i].curso_id, data.subjects[i], count, data.subjects.length);
                }                
            }
            else{
                $("#mens_sem_cadeiras").remove();
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            cleanTable();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();
            var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as unidades curriculares.</h2>";
            $("body").append(mensagem);
        }
    })
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
            $("#Consultar_Cadeiras_Faculdade_Curso option").remove();
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
                flagprogressbar = true;
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
        },
        complete: function(data){
            if($("subject_list").css("display")=="none" && $("subject_list").length == 0){
                cleanTable();
                $("#mens_sem_cadeiras").remove();
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular nos cursos existentes</h2>";
                $("body").append(mensagem);
            }
       } 
    });
}

function getAllSubjectsByCourse(course){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjectsByCourse",
        data: {course},
        success: function(data) {
            cleanTable();
            $("#mens_sem_cadeiras").remove();  
            var count = 0;
            flagprogressbar = true;
            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){  
                    count+=1;
                    getCourseNameById(data.subjects[i].curso_id, data.subjects[i], count, data.subjects.length);
                }
            }    

            // Mensagem de Erro quando nao ha cadeiras em cursos

            // if(count == 0){
            //     cleanTable();
            //     $("#mens_sem_cadeiras").remove();
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


function getAllYears(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllYears",
        success: function(data) {
            
            $("#Consultar_Cadeiras_Ano option").remove();
            var linhas = '<option class="college_row">Selecione um Ano Letivo</option>';
            if(data.years.length>0){
                for(i=0; i<data.years.length;i++){
                    linhas += '<option class="college_row" value=' + data.years[i].id +">" + data.years[i].inicio + "/" + data.years[i].fim + '</option>'; 
                }
                $("#Consultar_Cadeiras_Ano").append(linhas);             
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar os anos letivos.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}

function getAllCoursesByYear(idyear){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllCoursesByYear",
        data: {idyear},
        success: function(data) {
            if(data.courses.length>0){
                for(var i = 0; i<data.courses.length; i++){
                    getAllSubjectsByCourse(data.courses[i].id)
                }
            }
            else{
                cleanTable();
                $("#mens_sem_cadeiras").remove();
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhum curso neste ano letivo</h2>";
                $("body").append(mensagem);
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar os anos letivos.</p>";
            $("#register-faculdade-form").after(msgErro);
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
        else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade" && $("#Consultar_Cadeiras_Faculdade").val()!=null){
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