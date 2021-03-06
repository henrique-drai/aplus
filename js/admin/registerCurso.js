var cso

$(document).ready(() => {

    getAllfaculdades();
    getAllSchoolYears(); 

    $("#register-course-submit").click(() => submitRegister());
    // $("body").on("click", ".editCourse",() => displayEditCourse());
    $("body").on("click", "#editCourse-form-submit", () => editCourse());


    $("#consultar_cursos_faculdade").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            getAllCursosFaculdade($(this).val()); 
            $(".course_row").hide();
            $("#course-container").show();
        }
        else{
            $(".course_row").hide();
            $(".adminTable").css("display", "none");
            $("#course-container").hide();
        }
    }) ;

        //open popup
	$('body').on('click','.deleteCourse', function(event){
        event.preventDefault();
        cso = $(event.target).closest("tr");

        const mq5 = window.matchMedia( "(min-width: 1490px)" );
        $(".cd-popup-container > #toDel").remove()
        

        if (mq5.matches) {
            cursoName = cso.find("td:eq(1)").text()
            anoLetivo = cso.find("td:eq(2)").text()
           
            $(".cd-popup-container").prepend(
                        "<p id='toDel'>Tem a certeza que deseja eliminar o curso '" + cursoName + " (" + anoLetivo + ")" 
                        + "' ?</p>")
        }
        else{
            $(".cd-popup-container").prepend(
                "<p id='toDel'>Tem a certeza que deseja eliminar o curso ?</p>")
        }
        


        $('#courses_admin_delete').addClass('is-visible');
    });
    
	//close popup
	$('#courses_admin_delete').on('click', function(event){
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
        $('#courses_admin_delete').removeClass('is-visible');
        deleteCourse(cso);
    })

    // $("body").on("click", ".paginationjs .paginationjs-pages li>a", function(){

    //     const mq = window.matchMedia( "(max-width: 701px)" );
    //     const mq2 = window.matchMedia( "(max-width: 1490px)" );

    //     if (mq2.matches) {

    //         $('.adminTable tr').find('td:eq(3),th:eq(3)').remove();

    //         if(mq.matches){
    //             $('.adminTable tr').find('td:eq(0),th:eq(0)').remove();
    //          $('.adminTable tr').find('td:eq(2),th:eq(2)').remove();
    //         }            
    //     } 
    // })

    // _____________________________________________

    $('body').on("click", ".editCourse",function() {
        event.preventDefault();
        User = $(event.target).closest("tr");
        $(".cd-popup-container > #toDel").remove()
        $('#courses_admin_edit').addClass('is-visible');
        displayEditCourse()
    });

    $('#courses_admin_edit').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });

})



function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            linhas="";
            if(data.schoolYears.length>0){
                for(i=0; i<data.schoolYears.length>0;i++){
                    linhas += '<option class="ano_letivo" value=' + data.schoolYears[i].id +">" + data.schoolYears[i].inicio + '/' + data.schoolYears[i].fim + '</option>'; 
                }
                $("#consultar_anos_letivos").append(linhas);
            }
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function getAllfaculdades(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllColleges",
        success: function(data) {
            var linhas = '<option class="college_row">Selecione uma Faculdade</option>';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row" value=' + data.colleges[i].id +">" + data.colleges[i].name + '</option>'; 
                }
                $("#faculdades_register_UnidCurricular").append(linhas);
                $("#consultar_cursos_faculdade").append(linhas);
            }
        },
        error: function(data) {
        }
    });

}


function submitRegister(){
    const data = {
        codCourse:   $("#register-cursos-form input[name='codeCurso']").val(),
        nameCourse:    $("#register-cursos-form input[name='nomeCurso']").val(),
        descCourse:    $("#register-cursos-form textarea").val(),
        collegeId:   $("#register-cursos-form select[name='faculdade']").val(),
        academicYear:   $("#register-cursos-form select[name='academicYear']").val()
    }
    if (data.codCourse != "" && data.nameCourse != "" && data.descCourse != "" && data.collegeId != "Selecione uma Faculdade"){
        $.ajax({
            type: "POST",
            url: base_url + "api/registerCurso",
            data: data,
            success: function(data) {
                $("#msgStatus").text("Curso registado com Sucesso");
                $("#msgStatus").show().delay(2000).fadeOut();
                $('#register-cursos-form')[0].reset();

                if($("#consultar_cursos_faculdade").val() != "Selecione uma Faculdade"){
                    getAllCursosFaculdade($("#consultar_cursos_faculdade").val())
                }
               
            },
            error: function(data) {
                $("#msgErro").text("Não foi possível adicionar o curso");
                $("#msgErro").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgErro").text("É necessário preencher todos os campos");
        $("#msgErro").show().delay(2000).fadeOut();
    }
}


    function getAllCursosFaculdade(faculdade){
        $.ajax({
            type: "GET",
            url: base_url + "api/getAllCursosFaculdade",
            data: {faculdade},
            success: function(data) {
                $("#semCurso").remove();
                if(data.courses.length>0){
                    makeCoursesTable(data)                    
                }
                else{
                    $(".paginationjs").remove();
                    $(".adminTable").css("display", "none");
                    $("#msgErro2").text("Não existem cursos disponíveis para a faculdade selecionada.");
                    $("#msgErro2").show().delay(2000).fadeOut();
                    
                }
            },
            error: function(data) {
                var mensagem = "<h2 id='mens_erro_cursos'>Não é possivel apresentar os cursos.</h2>";
                $("body").append(mensagem);
                $("#msgErro2").delay(2000).fadeOut();
            }
        });
    }

    function makeCoursesTable(data){


        courses = [];

        for (i=0; i<data.courses.length; i++){
            courses.push('<tr class="courses">' +
                '<td class="codeRemovetd">'+ data.courses[i].code +'</td>' +
                '<td>'+ data.courses[i].name +'</td>' +
                '<td class="anoRemovetd">'+ data.years[i] + '</td>' +
                "<td class='descRemovetd'>" + data.courses[i].description + "</td>" +

                "<td class='editCourseRemovetd'><input class='editCourse' type='button' value='Editar'></td>"
                + "<td><input class='deleteCourse' type='button' value='Eliminar'></td>"
                + '</tr>')
        }

        const mq = window.matchMedia( "(max-width: 701px)" );
        const mq2 = window.matchMedia( "(max-width: 1490px)" );
        $('#course-container').pagination({
            dataSource: courses,
            pageSize: 5,
            pageNumber: 1,
            callback: function(data, pagination) {
                $(".courses").remove();
                $(".adminTable").append(data);

                if (mq2.matches) {
                    $('.descRemovetd').remove();
                    $('.editCourseRemovetd').remove();

                    if(mq.matches){
                        $('.anoRemovetd').remove();
                        $('.codeRemovetd').remove();
                    }            
                } 
            }
        })  
        if (mq2.matches) {
            $('#EditarCourseRemove').remove();
            $('#DescCourseRemove').remove();
            if(mq.matches){
                $('#anoCourseRemove').remove();
                $('#codeCourseRemove').remove();
            }
        }
        $(".adminTable").css("display", "table");
        // var table = '<table class="adminTable" id="show_courses">' +
        //     '<tr><th>Código de Curso</th>' +
        //     '<th>Nome</th>' + 
        //     '<th>Ano Letivo</th>' +
        //     '<th>Descrição</th>' +
        //     '<th>Editar</th>' +
        //     '<th>Eliminar</th>' +
        //     '</tr>' +
        //     course + 
        //     '</table>'
    
        // $("#course-container").html(table); 
        
        
    }
    
    

function deleteCourse(linha){
    
    const data = {
        code:   linha.find("td:eq(0)").text(),
        idCollege:    $("select[name='consultarCadeirasporFaculdade']").val(),
    }

    $.ajax({
        type: "DELETE", 
        url: base_url + "api/deleteCourse",
        data: data,

        success: function() {
            getAllCursosFaculdade(data.idCollege);            
            $("#msgStatus").text("Curso eliminado com Sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
        },
        error: function() {
            $("#msgStatus").text("Erro a eliminar curso");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });
}


    
codCourse = "";

function displayEditCourse(){
    // var x = document.getElementById("editCourse-form").style.display;
    $(".popup").css("display", "block");

    var linha = $(event.target).closest("tr");
    codCourse = linha.find("td:eq(0)").text();
    
    name = linha.find("td:eq(1)").text();   
    academicYear = linha.find("td:eq(2)").text();   
    description = linha.find("td:eq(3)").text();   

    $("#editCourse-form").css("display", "block");

    $("#editCourse-form input[name='codCourse']").val(codCourse);
    $("#editCourse-form input[name='name']").val(name);
    $("#editCourse-form input[name='academicYear']").val(academicYear) ;
    $("#descriptionTA").val(description) ;
      
    // }
}


function editCourse(){
    
    const data = {
        code:     $("#editCourse-form input[name='codCourse']").val(),
        name:    $("#editCourse-form input[name='name']").val(),
        academicYear:    $("#editCourse-form input[name='academicYear']").val(),
        description:      $("#descriptionTA").val(),
        collegeId:      $('#consultar_cursos_faculdade :selected').val(),
        oldCurso: codCourse
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/editCourse",
        data: data,   
        success: function() {
            $("#courses_admin_edit").removeClass('is-visible');

            getAllCursosFaculdade(data.collegeId);
            $("#msgStatusEditar").text("Curso editado com sucesso");
            $("#msgStatusEditar").show().delay(5000).fadeOut();
            displayEditCourse();
        },
        error: function() {
            $("#courses_admin_edit").removeClass('is-visible');
            $("#msgErroEditar").text("Erro a editar curso");
            $("#msgErroEditar").show().delay(2000).fadeOut();
        }
    });

}