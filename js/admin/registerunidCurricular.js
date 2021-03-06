$(document).ready(() => {
    getAllfaculdades();
    getAllSchoolYears();
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
        if($(this).val()!=""){
            if($("#anos_register_UnidCurricular").val()!= ""){
                getAllCursosFaculdade($(this).val(), $("#anos_register_UnidCurricular").val()); 
            }
        }
    }) ;

    $("#anos_register_UnidCurricular").change(function(){
        if($(this).val()!=""){
            if($("#faculdades_register_UnidCurricular").val()!= ""){
                getAllCursosFaculdade($("#faculdades_register_UnidCurricular").val(), $(this).val()); 
            }
        }
    }) ;
    

    $("#register-cadeira-submit").click(function(){
        $("#Consultar_Cadeiras").val('');
        $("label[for='curso']").css("display","none");
        var codeCadeira = $("#register-cadeiras-form input[name='codeCadeira']").val();
        var nomeCadeira = $("#register-cadeiras-form input[name='nomeCadeira']").val();
        var descCadeira = $("#register-cadeiras-form textarea[name='descCadeira']").val();
        var faculdade = $("#register-cadeiras-form select[name='faculdade']").val();
        var curso = $("#register-cadeiras-form select[name='curso']").val();
        var sigla = $("#register-cadeiras-form input[name='siglaCadeira']").val();
        var form = confirmForm(codeCadeira, nomeCadeira, descCadeira, faculdade, curso, sigla);
        if(form == true){
            $("#msgErro").text("Necessário preencher todos os campos.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
        else{
            submitRegister();
        }
        
    })
})

function confirmForm(codeCadeira, nomeCadeira, descCadeira, faculdade, curso, sigla){
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
    else if(curso == null || curso.length == 0){
        return true;
    }
    else if(sigla.length == 0){
        return true;
    }
}


var curso_id = "";

function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            linhas='<option class="ano_letivo" value=""> Selecione um Ano Letivo </option>';
            if(data.schoolYears.length>0){
                for(i=0; i<data.schoolYears.length>0;i++){
                    linhas += '<option class="ano_letivo" value=' + data.schoolYears[i].id +">" + data.schoolYears[i].inicio + '/' + data.schoolYears[i].fim + '</option>'; 
                }
                $("#anos_register_UnidCurricular").append(linhas);
            }
        },
        error: function(data) {
            $("#faculdades_register_UnidCurricular").css("display", "none");
            $("#faculdades_register_UnidCurricular option").remove();
            $("#msgErro").text("Não foi possível encontrar anos letivos.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });
}

function getAllfaculdades(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllColleges",
        success: function(data) {
            var linhas = '<option class="college_row" value="">Selecione uma Faculdade</option>';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row" value=' + data.colleges[i].id +">" + data.colleges[i].name + '</option>'; 
                }
                $("#faculdades_register_UnidCurricular").append(linhas);
            }
            else{
                $("#faculdades_register_UnidCurricular").css("display", "none");
                $("#faculdades_register_UnidCurricular option").remove();
                $("#msgErro").text("Não existem disponíveis faculdade.");
                $("#msgErro").show().delay(2000).fadeOut();
            }
        },
        error: function(data) {
            $("#faculdades_register_UnidCurricular").css("display", "none");
            $("#faculdades_register_UnidCurricular option").remove();
            $("#msgErro").text("Não foi possível encontrar faculdades.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });

}

function getAllCursosFaculdade(faculdade, anoletivo){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllCursosFaculdadeAno",
        data: {faculdade,
                anoletivo},
        success: function(data) {
            if(data.courses.length>0){
                $(".course_row_register").remove();
                $("label[for='curso']").css("display","inline");
                var linhas = '<option class="course_row_register" value="">Selecione um Curso</option>';
                for(i=0; i<data.courses.length; i++){
                    
                    $("#cursos_register_UnidCurricular").css("display", "block");
                    linhas += '<option class="course_row_register" value=' + data.courses[i].id +">" + data.courses[i].name + '</option>'; 
                
                     $("#cursos_register_UnidCurricular").append(linhas);
                }
            }
            else{
                $("#cursos_register_UnidCurricular").css("display", "none");
                $("#cursos_register_UnidCurricular option").remove();
                $("#msgErro").text(" Não existem cursos associados à faculdade.");
                $("#msgErro").show().delay(2000).fadeOut();
            }
        },
        error: function(data) {
            $("#cursos_register_UnidCurricular").css("display", "none");
            $("#cursos_register_UnidCurricular option").remove();
            $("#msgErro").text(" Não existem cursos associados à faculdade.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });

}


function submitRegister(){
    var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
    const data = {
        codeCadeira:   $("#register-cadeiras-form input[name='codeCadeira']").val(),
        nomeCadeira:    $("#register-cadeiras-form input[name='nomeCadeira']").val(),
        descCadeira:    $("#register-cadeiras-form textarea[name='descCadeira']").val(),
        semestre: $("#register-cadeiras-form select[name='semestre']").val(),
        curso:    $("#register-cadeiras-form select[name='curso']").val(),
        sigla:    $("#register-cadeiras-form input[name='siglaCadeira']").val(),
        cor:   randomColor,
    }
    $("#faculdades_register_UnidCurricular").val("");
    $("#anos_register_UnidCurricular").val("");
    $("#cursos_register_UnidCurricular").css("display", "none");
    $("#cursos_register_UnidCurricular option").remove();
    $.ajax({
        type: "POST",
        url: base_url + "api/registerSubject",
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
            $("#register-cadeiras-form input[name='codeCadeira']").css("border-left-color", "red");
            $("#msgErro").text("Não foi possivel registar a unidade curricular");
            $("#msgErro").show().delay(2000).fadeOut();
            
        }
    });
}