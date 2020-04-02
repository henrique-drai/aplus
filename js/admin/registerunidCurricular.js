$(document).ready(() => {
    getAllfaculdades();
    $("#register-cadeiras-form input[name='codeCadeira']").on("input", function(){
        var codCadeira = $("#register-cadeiras-form input[name='codeCadeira']").val();
        
        if(codCadeira.length == 0 ){
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

    $("#register-cadeira-submit").click(function(){
        var codeCadeira = $("#register-cadeiras-form input[name='codeCadeira']").val();
        var nomeCadeira = $("#register-cadeiras-form input[name='nomeCadeira']").val();
        var descCadeira = $("#register-cadeiras-form textarea[name='descCadeira']").val();
        var faculdade = $("#register-cadeiras-form select[name='faculdade']").val();
        var curso = $("#register-cadeiras-form select[name='curso']").val();
        var form = confirmForm(codeCadeira, nomeCadeira, descCadeira, faculdade, curso);
        if(form == true){
            $("#msgStatus").text("Necessário preencher todos os campos.");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
        else{
            submitRegister();
        }
        
    })
})

function confirmForm(codeCadeira, nomeCadeira, descCadeira, faculdade, curso){
    if(codeCadeira.length == 0){
        return true;
    }
    else if(nomeCadeira.length == 0){
        return true;
    }
    else if(descCadeira.length == 0){
        return true;
    }
    else if(faculdade  === "Selecione uma Faculdade" ){
        return true;
    }
    else if(curso.length == 0){
        return true;
    }
}


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
            else{
                $("#faculdades_register_UnidCurricular").css("display", "none");
                $("#faculdades_register_UnidCurricular option").remove();
                $("#msgStatus").text("Não existem disponíveis faculdade.");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        },
        error: function(data) {
            $("#faculdades_register_UnidCurricular").css("display", "none");
            $("#faculdades_register_UnidCurricular option").remove();
            $("#msgStatus").text("Não foi possível encontrar faculdade.");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });

}


function getAllCursosFaculdade(faculdade){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllCursosFaculdade",
        data: {faculdade},
        success: function(data) {
            if(data.courses.length>0){
                for(i=0; i<data.courses.length; i++){
                    getCursos_Standard(data.courses[i].curso_standard_id, data.courses[i].id);
                }
            }
            else{
                $("#cursos_register_UnidCurricular").css("display", "none");
                $("#cursos_register_UnidCurricular option").remove();
                $("#msgStatus").text(" Não existem cursos associados à faculdade.");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        },
        error: function(data) {
            $("#cursos_register_UnidCurricular").css("display", "none");
            $("#cursos_register_UnidCurricular option").remove();
            $("#msgStatus").text(" Não existem cursos associados à faculdade.");
            $("#msgStatus").show().delay(2000).fadeOut();
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
            var linhas = '';
            linhas += '<option class="course_row" value=' + curso_id +">" + data.course.name + '</option>'; 
        
             $("#cursos_register_UnidCurricular").append(linhas);
            
        },
        error: function(data) {

        }
    });
}

function submitRegister(){
   
    const data = {
        codeCadeira:   $("#register-cadeiras-form input[name='codeCadeira']").val(),
        nomeCadeira:    $("#register-cadeiras-form input[name='nomeCadeira']").val(),
        descCadeira:    $("#register-cadeiras-form textarea[name='descCadeira']").val(),
        curso:    $("#register-cadeiras-form select[name='curso']").val(),
    }
    $("#faculdades_register_UnidCurricular").val("Selecione uma Faculdade");
    $("#cursos_register_UnidCurricular").css("display", "none");
    $("#cursos_register_UnidCurricular option").remove();
    $.ajax({
        type: "POST",
        url: base_url + "admin/api/registerSubject",
        data: data,
        success: function(data) {
            $("input[type='text']").val("");
            $("textarea[type='text']").val("");
            $("#register-cadeiras-form input[name='codeCadeira']").css("border-left-color", "red");
            $("#msgStatus").text("Unidade Curricular registada com Sucesso.");
            $("#msgStatus").show().delay(2000).fadeOut();
        },
        error: function(jqxhr) {
            $("input[type='text']").val("");
            $("textarea[type='text']").val("");

            // var html = $(jqxhr.responseText);
            // var body = html.find("div #container");
            // console.log(body);

            // PARA VER QUAL E O ERRO se e porque existem codigos iguais


            $("#register-cadeiras-form input[name='codeCadeira']").css("border-left-color", "red");
            $("#msgStatus").text("Não foi possivel registar a unidade curricular");
            $("#msgStatus").show().delay(2000).fadeOut();
            
        }
    });
}