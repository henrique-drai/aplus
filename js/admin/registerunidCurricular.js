$(document).ready(() => {
    getAllfaculdades();
    $("#faculdades_register_UnidCurricular").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            getAllCursosFaculdade($(this).val()); 
        }
    }) ;

    $("#register-cadeira-submit").click(() => submitRegister())
})


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
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });

}


function getAllCursosFaculdade(faculdade){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllCursosFaculdade",
        data: {faculdade},
        success: function(data) {
            for(i=0; i<data.courses.length; i++){
                getCursos_Standard(data.courses[i].curso_standard_id);
            }
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });

}


function getCursos_Standard(courseid){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCursoStandard",
        data: {courseid},
        success: function(data) {
            $("#cursos_register_UnidCurricular").css("display", "block");
            var linhas = '';
           
            linhas += '<option class="course_row" value=' + data.course.id +">" + data.course.name + '</option>'; 
        
             $("#cursos_register_UnidCurricular").append(linhas);
            
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });
}

function submitRegister(){
    const data = {
        codeCadeira:   $("#register-cadeiras-form input[name='codeCadeira']").val(),
        nomeCadeira:    $("#register-cadeiras-form input[name='nomeCadeira']").val(),
        descCadeira:    $("#register-cadeiras-form input[name='descCadeira']").val(),
        curso:    $("#register-cadeiras-form select[name='curso']").val(),

    }
    $("input[type='text']").val("");
    $("#faculdades_register_UnidCurricular").val("Selecione uma Faculdade");
    $("#cursos_register_UnidCurricular").css("display", "none");
    $(".msgSucesso").remove();
    $(".msgErro").remove();
    $.ajax({
        type: "POST",
        url: base_url + "admin/api/registerSubject",
        data: data,
        success: function(data) {
            msgSucesso = "<p class='msgSucesso'>Unidade Curricular registada com Sucesso.</p>";
            $("#register-cadeiras-form").after(msgSucesso);
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel registar a unidade curricular.</p>";
            $("#register-cadeiras-form").after(msgErro);
        }
    });
    
}