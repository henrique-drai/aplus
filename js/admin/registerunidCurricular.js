$(document).ready(() => {
    getAllfaculdades();
    $("#register-cadeiras-form input[name='codeCadeira']").on("input", function(){
        var codCadeira = $("#register-cadeiras-form input[name='codeCadeira']").val();
        if(codCadeira.length !== 5){
            $("#register-cadeiras-form input[name='codeCadeira']").css("border-left-color", "red");
        }
        else{
            $("#register-cadeiras-form input[name='codeCadeira']").css("border-left-color", "lawngreen");
        }
    })
   
    $("#faculdades_register_UnidCurricular").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            getAllCursosFaculdade($(this).val()); 
        }
    }) ;

    $("#register-cadeira-submit").click(() => submitRegister())
})

var curso_id = "";
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
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });

}


function getAllCursosFaculdade(faculdade){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllCursosFaculdade",
        data: {faculdade},
        success: function(data) {
            $(".msg").remove();
            if(data.courses.length>0){
                for(i=0; i<data.courses.length; i++){
                    getCursos_Standard(data.courses[i].curso_standard_id, data.courses[i].id);
                }
            }
            else{
                $(".msg").remove();
                $("#cursos_register_UnidCurricular").css("display", "none");
                $("#cursos_register_UnidCurricular option").remove();
                msg = "<p class='msg'> Não existem cursos associados à faculdade.</p>";
                $("#faculdades_register_UnidCurricular").after(msg);
            }
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });

}


function getCursos_Standard(course_standard_id, curso_id){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCursoStandard",
        data: {course_standard_id},
        success: function(data) {
            $(".course_row").remove();
            $("#cursos_register_UnidCurricular").css("display", "block");
            $(".msg").remove();
            var linhas = '';
            linhas += '<option class="course_row" value=' + curso_id +">" + data.course.name + '</option>'; 
        
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
    $("#cursos_register_UnidCurricular option").remove()
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