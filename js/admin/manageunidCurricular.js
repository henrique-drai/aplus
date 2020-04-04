var unidCurr

$(document).ready(() => {
    $("#show_subjects").css("display", "none");
    $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    $("#Consultar_Cadeiras_Curso").css("display", "none");
    $("#Consultar_Cadeiras_Ano").css("display", "none");
    $("#Consultar_Cadeiras").change(function(){
        if($("#Consultar_Cadeiras").val() == "All"){
            $("#show_subjects").css("display", "block");
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            getAllSubjects();
        }
        else if($("#Consultar_Cadeiras").val() == "Faculdade"){
            $("#show_subjects").css("display", "none");
            $("#Consultar_Cadeiras_Faculdade").css("display", "block");
            $("#Consultar_Cadeiras_Curso").css("display", "none");
            getColleges();
            $("#Consultar_Cadeiras_Faculdade").change(function(){
                if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
                    $("#show_subjects").css("display", "block");
                    getAllCoursesByCollege($(this).val());
                }
                else{
                    $("#show_subjects").css("display", "none");
                    $(".subject_row").remove();
                }
                
            })
            
            
        }
        else if($("#Consultar_Cadeiras").val() == "Curso"){
            $("#show_subjects").css("display", "none");
            $("#Consultar_Cadeiras_Curso").css("display", "block");
            $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            
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
        deleteCourse(unidCurr);
    })

})



function getAllSubjects(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjects",
        success: function(data) {
            $(".subject_row").remove();
            $("#mens_sem_cadeiras").remove();
            // $("#mens_erro_faculdades").remove();

            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){
                    getCourseStandardId(data.subjects[i].curso_id, data.subjects[i]);
                }
            }
            else{
                $("#mens_sem_cadeiras").remove();
                $("#show_subjects").css("display", "none");
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma faculdade</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            $("#show_colleges").css("display", "none");
            $("#mens_sem_cadeiras").remove();
            // $("#mens_erro_faculdades").remove();
            // var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as faculdades.</h2>";
            // $("body").append(mensagem);
        }
    });
}

function getCourseStandardId(course_id, dataSubject){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCourseStandardId",
        data: {course_id},
        success: function(data) {
            name = getCourseName(data.course_standard_id, dataSubject);
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });
}

function getCourseName(course_standard_id, dataSubject){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCursoStandard",
        data: {course_standard_id},
        success: function(data) {
            var linhas = '';
            linhas += '<tr class="subject_row"><td>' + dataSubject.code + '</td><td>' + data.course.name + 
                '</td><td>' + dataSubject.name + '</td><td>' + dataSubject.description + 
                '</td><td><button class="deleteSubject" type="button">Apagar</button></td></tr>'; 
            $('#show_subjects').append(linhas);
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });
};

function getColleges(){
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
                $("#Consultar_Cadeiras_Faculdade").append(linhas);
            }
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });
}


function getAllCoursesByCollege(faculdade){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllCoursesByCollege",
        data: {faculdade},
        success: function(data) {
            $(".subject_row").remove();
            $("#mens_sem_cadeiras").remove();
            if(data.courses.length>0){
                for(i=0; i<data.courses.length;i++){
                    getAllSubjectsByCollege(data.courses[i].id);
                }
            }
            else{
                $("#mens_sem_cadeiras").remove();
                $("#show_subjects").css("display", "none");
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma faculdade</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            $("#show_colleges").css("display", "none");
            $("#mens_sem_cadeiras").remove();

        }
    });
}


function getAllSubjectsByCollege(course){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSubjectsByCollege",
        data: {course},
        success: function(data) {
            $(".subject_row").remove();
            $("#mens_sem_cadeiras").remove();
            
            if(data.subjects.length>0){
                for(i=0; i<data.subjects.length;i++){
                    getCourseStandardId(data.subjects[i].curso_id, data.subjects[i]);
                }
            }           
            
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
            getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val());
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