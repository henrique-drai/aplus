$(document).ready(() => {

    getAllfaculdades();
    getAllSchoolYears();

    $("#register-course-submit").click(() => submitRegister());
    $("body").on("click", ".deleteCourse",() =>deleteCourse());
    $("body").on("click", ".editCourse",() => displayEditCourse());
    $("body").on("click", "#editCourse-form-submit", () => editCourse());


    $("#consultar_cursos_faculdade").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            getAllCursosFaculdade($(this).val()); 
            $(".course_row").hide();
        }
        else{
            $(".course_row").hide();
        }
    }) ;

})


function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSchoolYears",
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
        url: base_url + "admin/api/getAllFaculdadesUnidCurricular",
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
        descCourse:    $("#register-cursos-form input[name='descCurso']").val(),
        collegeName:   $("#register-cursos-form select[name='faculdade']").val(),
        academicYear:   $("#register-cursos-form select[name='academicYear']").val()
    }
    if (data.codCourse != "" && data.nameCourse != "" && data.descCourse != "" && data.collegeName != "Selecione uma Faculdade"){
        $.ajax({
            type: "POST",
            url: base_url + "admin/api/registerCurso",
            data: data,
            success: function(data) {
                $("#msgStatus").text("Curso registado com Sucesso");
                $("#msgStatus").show().delay(2000).fadeOut();
                $('#register-cursos-form')[0].reset();
            },
            error: function(data) {
                $("#msgStatus").text("Não foi possível adicionar o curso");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgStatus").text("É necessário preencher todos os campos");
        $("#msgStatus").show().delay(2000).fadeOut();
    }
}


    function getAllCursosFaculdade(faculdade){
        $.ajax({
            type: "GET",
            url: base_url + "admin/api/getAllCursosFaculdade",
            data: {faculdade},
            success: function(data) {
                $(".course_row").remove();
                $("#semCurso").remove();
                if(data.courses.length>0){
                    for(i=0; i<data.courses.length; i++){
                        getCursos_Standard(data.courses[i].curso_standard_id, data.courses[i].description);
 
                    }
                }
                else{
                    $("#show_courses").append("<tr id='semCurso'><td>Não existem cursos disponíveis</td></tr>");
                }
            },
            error: function(data) {
                // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
                // $("#register-faculdade-form").after(msgErro);
            }
        });
    }

    function getCursos_Standard(course_standard_id, description){
        $.ajax({
            type: "GET",
            url: base_url + "admin/api/getCursoStandard",
            data: {course_standard_id},
            success: function(data) {
                $("#cursos_register_UnidCurricular").css("display", "block");
                $(".msg").remove();
                var linhas = '';
                linhas += '<tr class="course_row">' +
                                "<td>" + data.course.id + "</td>"
                                +"<td>" + data.course.name + "</td>"
                                +"<td>" + description + "</td>"
                                + "<td><button class='editCourse' type='button'>Editar</button></td>"
                                + "<td><button class='deleteCourse' type='button'>Apagar</button></td>"
                                + "</tr>"; 
            
                 $("#show_courses").append(linhas);
                
            },
            error: function(data) {
            }
        });
    }


    

function deleteCourse(){
    var linha = $(event.target).closest("tr");
    
    const data = {
        code:   linha.find("td:eq(0)").text(),
        idCollege:    $("select[name='consultarCadeirasporFaculdade']").val(),
        
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "admin/api/deleteCourse",
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
    var x = document.getElementById("editCourse-form").style.display;
    
    if(x=="block"){
        $("#editCourse-form").css("display", "none");
    }
    else{
        $("#editCourse-form").css("display", "block");

    }

    var linha = $(event.target).closest("tr");
    codCourse = linha.find("td:eq(0)").text();    
}


function editCourse(){
    
    const data = {
        idCurso:     $("#editCourse-form input[name='codCourse']").val(),
        name:    $("#editCourse-form input[name='name']").val(),
        description:      $("#editCourse-form input[name='description']").val(),
        oldCurso: codCourse
    }

    $.ajax({
        type: "POST",
        url: base_url + "admin/api/editCourse",
        data: data,   
        success: function() {
            getAllCursosFaculdade($('#consultar_cursos_faculdade :selected').val());
            $("#msgStatus").text("Curso editado com sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
            alert("FALTA IMPLEMENTAR O EDIT");
            displayEditCourse();
        },
        error: function() {
            $("#msgStatus").text("Erro a editar curso");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });

}