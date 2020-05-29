$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())

    getAllfaculdades();
    getAllSchoolYears();
    getYears();
    getColleges();


    // ############################ EXPORT ###########################################


    $("#collegesDisplay").change(function(){
        
        if($("#yearsDisplay").val()!="Selecione um Ano Letivo" && $("#collegesDisplay").val()!="Selecione uma Faculdade"){
            getCursosFaculdade($("#yearsDisplay").val(), $("#collegesDisplay").val());
        }

    }) ;
    $("#yearsDisplay").change(function(){
        if($("#yearsDisplay").val()!="Selecione um Ano Letivo" && $("#collegesDisplay").val()!="Selecione uma Faculdade"){
            getCursosFaculdade($("#yearsDisplay").val(), $("#collegesDisplay").val());
        }
    }) ;


    // ############################ IMPORT ###########################################

    
    $("#collegesDisplay1").change(function(){
        
        if($("#yearsDisplay1").val()!="Selecione um Ano Letivo" && $("#collegesDisplay1").val()!="Selecione uma Faculdade"){
            getCursosFaculdade2($("#yearsDisplay1").val(), $("#collegesDisplay1").val());
        }

    }) ;
    $("#yearsDisplay1").change(function(){
        if($("#yearsDisplay1").val()!="Selecione um Ano Letivo" && $("#collegesDisplay1").val()!="Selecione uma Faculdade"){
            getCursosFaculdade2($("#yearsDisplay1").val(), $("#collegesDisplay1").val());
        }
    }) ;


    $("#importFromCsv").submit(function(e) {

        const info = {
            college:        $("#collegesDisplay").val(),
            year:           $("#yearsDisplay").val(),
            course:         $("#coursesDisplay").val(),
        }

        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: base_url + "api/importStudentsCourse",
            type: 'POST',
            headers: {"Authorization": localStorage.token},
            data: formData,
            success: function (data) {
                $("#importSuccess").html("Ficheiro importado com sucesso");
                $("#importSuccess").show().delay(2000).fadeOut();
                $("#myfile").val("");
            },
            error: function(data) {
                $("#importError").html("Ficheiro importado com sucesso");
                $("#importError").show().delay(2000).fadeOut();
                $("#myfile").val("");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    


    $("#exportCsv").on("submit", function(e) {
        e.preventDefault()
        $.ajax({
            type: "GET", 
            url: base_url + "api/saveCSV",
            data:{role:$("#exportCsv select").val()},
            success:function(data){
            
                    var downloadLink = document.createElement("a");
                    var fileData = ['\ufeff'+data];   

                    var blobObject = new Blob(fileData,{
                        type: "text/csv;charset=utf-8;"
                    });

                    var url = URL.createObjectURL(blobObject);
                    downloadLink.href = url;
                    var role = $("#exportCsv select").val();

                    if(role=="student"){
                        downloadLink.download = "students.csv";
                    }
                    else if(role=="teacher"){
                        downloadLink.download = "teachers.csv";
                    }
                    else{
                        downloadLink.download = "studentsTeachers.csv";
                    }
                    
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);

                    }
        })
    })

    
    $("#file-form").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: base_url + "api/importX",
            type: 'POST',
            data: formData,
            success: function (data) {
                $("#importStatus").html("Ficheiro importado com sucesso");
                $("#importStatus").show().delay(2000).fadeOut();
                $("#myfile").val("");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    $("body").on("click", "#exportInfo2", function() {

        const data = {
            college:        $("#collegesDisplay").val(),
            year:           $("#yearsDisplay").val(),
            course:         $("#coursesDisplay").val(),

        }

        $.ajax({
            type: "GET",
            url: base_url + "api/exportSpecific",
            data: data,
            success:function(data){

                var downloadLink = document.createElement("a");
                var fileData = ['\ufeff'+data];   

                var blobObject = new Blob(fileData,{
                    type: "text/csv;charset=utf-8;"
                });

                var url = URL.createObjectURL(blobObject);
                downloadLink.href = url;
                
                downloadLink.download =  $("#coursesDisplay option:selected").text() + ".csv";

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);

                
            
            }
        })
       
    })

    $("#register-form select[name='role']").change(function(){
        if($(this).val()=="student"){
            $("#register-form label[for='academicYearUser']").css("display", "block");
            $("#register-form label[for='faculUser']").css("display", "block");
            $("#registerUserFacul").css("display", "block");
            $("#registerAnoUser").css("display", "block");
            $("#cursoUser").css("display", "none");
            $("#cadeirasProf").css("display", "none");
            $("#registerUserFacul").val("");
            $("#registerAnoUser").val("");
            $("#registerUserCurso").val("");
            $("#selectedCadeiras").css("display", "none");
            $(".selectedcadeiras").remove();
        }
        else if($(this).val()=="admin"){
            $("#register-form label[for='academicYearUser']").css("display", "none");
            $("#register-form label[for='faculUser']").css("display", "none");
            $("#registerUserFacul").css("display", "none");
            $("#registerAnoUser").css("display", "none");
            $("#cadeirasProf").css("display", "none");
            $("#cursoUser").css("display", "none");
            $("#selectedCadeiras").css("display", "none"); 
            $(".selectedcadeiras").remove();
            $("#registerUserFacul").val("");
            $("#registerAnoUser").val("");
            $("#registerUserCurso").val("");
        }
        else if($(this).val()=="teacher"){
            $("#register-form label[for='academicYearUser']").css("display", "block");
            $("#register-form label[for='faculUser']").css("display", "block");
            $("#registerUserFacul").css("display", "block");
            $("#registerAnoUser").css("display", "block");
            $("#cursoUser").css("display", "none");
            $("#registerUserFacul").val("");
            $("#registerAnoUser").val("");
            $("#registerUserCurso").val("");
        }
    })

    $("#registerUserFacul").change(function(){
        if($(this).val()!=""){
            if($("#registerAnoUser").val()!= "" && $("#register-form select[name='role']").val() == "student"){
                getAllCursosFaculdade($(this).val(), $("#registerAnoUser").val()); 
            }
        }
        else{
            $("#cursoUser").css("display", "none");
        }
    });

    $("#registerAnoUser").change(function(){
        if($(this).val()!=""){
            if($("#registerUserFacul").val()!= "" && $("#register-form select[name='role']").val() == "student"){
                getAllCursosFaculdade($("#registerUserFacul").val(), $(this).val()); 
            }
        }
        else{
            $("#cursoUser").css("display", "none");
        }
    });

    $("#registerUserFacul").change(function(){
        if($(this).val()!=""){
            if($("#registerAnoUser").val()!= "" && $("#register-form select[name='role']").val() == "teacher"){
                getAllCursosFaculdade($(this).val(), $("#registerAnoUser").val()); 
            }
        }
        else{
            $("#cursoUser").css("display", "none");
        }
    });

    $("#registerAnoUser").change(function(){
        if($(this).val()!=""){
            if($("#registerUserFacul").val()!= "" && $("#register-form select[name='role']").val() == "teacher"){
                getAllCursosFaculdade($("#registerUserFacul").val(), $(this).val());   
            }
        }
        else{
            $("#cursoUser").css("display", "none");
        }
    });

    $("#registerUserCurso").change(function(){
        if($(this).val()!=""){
            if($("#registerUserCurso").val()!= "" && $("#register-form select[name='role']").val() == "teacher"){
                getAllCadeirasByCourse($("#registerUserCurso").val()); 
                $("#cadeirasProf").css("display", "block");
            }
        }
        else{
            $("#cadeirasProf").css("display", "none");
        }
    });

    $("body").on("click", ".cadeira_row_prof", function(){
        $("#selectedCadeiras").css("display", "block");

        if($(".selectedcadeiras").length>0){
            var repetido = true;
            for(var i=0; i<$(".selectedcadeiras").length; i++){
                
                var id = $(".selectedcadeiras")[i].id
                var cadeiraid = id.split("_")[1];
                if(cadeiraid == $(this).val()){
                    repetido = false;
                }
               
            }
            if(repetido){
                var linha = '<p class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<a class='tirarCadeira' href='#'>&times;</a></p>";
                $("#selectedCadeiras").append(linha);
            }
        }
        else{
            var linha = '<p class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<a class='tirarCadeira' href='#'>&times;</a></p>";
            $("#selectedCadeiras").append(linha);
        }        
        
    })

    $("body").on("click", ".tirarCadeira", function(){
       $(this).parent().remove();
    })

})


function getColleges(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllColleges",            
        success: function(data) {
            var option = "<option class='college_row'>Selecione uma Faculdade</option>";
 
            for (i=0; i<data.colleges.length; i++){
                option+= "<option value='" + data.colleges[i].id + "'>"+ data.colleges[i].name  + "</option>"
            }
            $("#collegesDisplay").html(option)
            $("#collegesDisplay1").html(option)
           
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}


function getYears(){

    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            var option = "<option class='years'>Selecione um Ano Letivo</option>";

            for (i=0; i<data.schoolYears.length; i++){
                option+= "<option value='" + data.schoolYears[i].id + "'>"+ data.schoolYears[i].inicio  + "</option>"
            }
            $("#yearsDisplay").html(option)
            $("#yearsDisplay1").html(option)
            
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function submitRegister(){
    var cadeirasprof = [];
    if($(".selectedcadeiras").length>0){
        for(var i=0; i<$(".selectedcadeiras").length; i++){
            var id = $(".selectedcadeiras")[i].id
            var cadeiraid = id.split("_")[1];
            cadeirasprof.push(cadeiraid);
        }
    }
    const data = {
        name:       $("#register-form input[name='name']").val(),
        surname:    $("#register-form input[name='surname']").val(),
        email:      $("#register-form input[name='email']").val(),
        password:   $("#register-form input[name='password']").val(),
        role:       $("#register-form select[name='role']").val(),
        curso:      $("#register-form select[name='cursoUserSel']").val(),
        cadeiras:   cadeirasprof,
    }
    if(data.role == "admin"){
        if(data.name!=="" && data.surname!=="" && data.email!=="" && data.password!==""){
            $.ajax({
                type: "POST",
                url: base_url + "api/register",
                data: data,
                success: function(data) {
                    $("input[type='text']").val("");
                    $("input[type='password']").val("");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                },
                error: function(data) {
                    $("#msgErro").text("Não foi possivel registar o utilizador.");
                    $("#msgErro").show().delay(2000).fadeOut();
                }
            });
        }
        else{
            $("#msgErro").text("É necessário preencher todos os campos.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    }
    else if(data.role == "student"){
        if(data.name!=="" && data.surname!=="" && data.email!=="" && data.password!=="" && data.course !== ""){
            $.ajax({
                type: "POST",
                url: base_url + "api/register",
                data: data,
                success: function(data) {
                    $("input[type='text']").val("");
                    $("input[type='password']").val("");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                    $("#register-form label[for='academicYearUser']").css("display", "none");
                    $("#register-form label[for='faculUser']").css("display", "none");
                    $("#registerUserFacul").css("display", "none");
                    $("#registerAnoUser").css("display", "none");
                    $("#cadeirasProf").css("display", "none");
                    $("#cursoUser").css("display", "none");
                    $("#selectedCadeiras").css("display", "none"); 
                    $(".selectedcadeiras").remove();
                    $("#registerUserFacul").val("");
                    $("#registerAnoUser").val("");
                    $("#registerUserCurso").val("");
                },
                error: function(data) {
                    $("#msgErro").text("Não foi possivel registar o utilizador.");
                    $("#msgErro").show().delay(2000).fadeOut();
                }
            });
        }
        else{
            $("#msgErro").text("É necessário preencher todos os campos.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    }
    else if(data.role == "teacher"){
        if(data.name!=="" && data.surname!=="" && data.email!=="" && data.password!==""){
            $.ajax({
                type: "POST",
                url: base_url + "api/register",
                data: data,
                success: function(data) {
                    $("input[type='text']").val("");
                    $("input[type='password']").val("");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                    $("#register-form label[for='academicYearUser']").css("display", "none");
                    $("#register-form label[for='faculUser']").css("display", "none");
                    $("#registerUserFacul").css("display", "none");
                    $("#registerAnoUser").css("display", "none");
                    $("#cadeirasProf").css("display", "none");
                    $("#cursoUser").css("display", "none");
                    $("#selectedCadeiras").css("display", "none"); 
                    $(".selectedcadeiras").remove();
                    $("#registerUserFacul").val("");
                    $("#registerAnoUser").val("");
                    $("#registerUserCurso").val("");
                },
                error: function(data) {
                    $("#msgErro").text("Não foi possivel registar o utilizador.");
                    $("#msgErro").show().delay(2000).fadeOut();
                }
            });
        }
        else{
            $("#msgErro").text("É necessário preencher todos os campos.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    }
    
}


// #################################################################################################



function getCursosFaculdade(ano, faculdade){

    const data = {
        faculdade:          faculdade,
        anoletivo:          ano,
    }

    $.ajax({
        type: "GET",
        url: base_url + "api/getAllCursosFaculdadeAno",
        data: data,
        success: function(data) {
            var option = "Selecione um Curso";
            if(data.courses.length > 0){
                for (i=0; i<data.courses.length; i++){
                    option+= "<option value='" + data.courses[i].id + "'>"+ data.courses[i].name  + "</option>"
                }
           
                $("#export2Csv").append("<select id='coursesDisplay' name='courses'></select>")
                $("#coursesDisplay").html(option)
                $("#export2Csv").append("<input type='submit' id='exportInfo2' value='Exportar'>")
            }
            else{
                
                $("#exportInfo2").remove()
                $("#collegeStatus").html("Não existem cursos");
                $("#collegeStatus").show().delay(2000).fadeOut();
                $("#coursesDisplay").remove()
            }            
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}



function getCursosFaculdade2(ano, faculdade){
    const data = {
        faculdade:          faculdade,
        anoletivo:          ano,
    }
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllCursosFaculdadeAno",
        data: data,
        success: function(data) {
            var option = "Selecione um Curso";
            if(data.courses.length > 0){
                for (i=0; i<data.courses.length; i++){
                    option+= "<option value='" + data.courses[i].id + "'>"+ data.courses[i].name  + "</option>"
                }
                $("#importFromCsv").append("<select id='coursesDisplay1' name='courses'></select>")
                $("#coursesDisplay1").html(option)
                $("#importFromCsv").append("<input type='file' id='myfile' name='userfile' accept='.csv' required>")
                $("#importFromCsv").append("<input type='submit' id='importToCourse'  value='Importar'></input>")               
            }
            else{
                $("#myfile").remove()
                $("#importToCourse").remove()
                $("#collegeStatus1").html("Não existem cursos");
                $("#collegeStatus1").show().delay(2000).fadeOut();
                $("#coursesDisplay1").remove()
            }
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

// ####################################################################################

function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            linhas='<option class="ano_letivo_user" value=""> Selecione um Ano Letivo </option>';
            if(data.schoolYears.length>0){
                for(i=0; i<data.schoolYears.length>0;i++){
                    linhas += '<option class="ano_letivo_user" value=' + data.schoolYears[i].id +">" + data.schoolYears[i].inicio + '/' + data.schoolYears[i].fim + '</option>'; 
                }
                $("#registerAnoUser").html(linhas);
            }
        },
        error: function(data) {
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
            var linhas = '<option class="college_row_user" value="">Selecione uma Faculdade</option>';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row_user" value=' + data.colleges[i].id +">" + data.colleges[i].name + '</option>'; 
                }
                $("#registerUserFacul").html(linhas);
            }
            else{
                
                $("#msgErro").text("Não existem disponíveis faculdade.");
                $("#msgErro").show().delay(2000).fadeOut();
            }
        },
        error: function(data) {
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
                $(".course_row_register_user").remove();
                $("#cursoUser").css("display", "block");
                var linhas = '<option class="course_row_user" value="">Selecione um Curso</option>';
                for(i=0; i<data.courses.length; i++){ 
                    linhas += '<option class="course_row_register_user" value=' + data.courses[i].id +">" + data.courses[i].name + '</option>'; 
                }
                $("#registerUserCurso").html(linhas);
            }
            else{
                $("#cursoUser").css("display", "none");
                $("#msgErro").text("Não existem cursos.");
                $("#msgErro").show().delay(2000).fadeOut();

            }
        },
        error: function(data) {
            $("#cursoUser").css("display", "none");
            $("#msgErro").text(" Não existem cursos.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });
}

function getAllCadeirasByCourse(cursoid){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllCadeirasByCourse",
        data: {cursoid},
        success: function(data) {
            if(data.cadeiras.length>0){
                var linhas = '';
                for(var i=0; i< data.cadeiras.length; i++){
                    linhas += '<option class="cadeira_row_prof" value=' + data.cadeiras[i]["id"] +">" + data.cadeiras[i]["name"] + '</option>'; 
                }
                $("#registerProfCadeira").html(linhas);

            }
            else{
                $("#cadeirasProf").css("display", "none");
                $("#msgErro").text("Não existem cadeiras.");
                $("#msgErro").show().delay(2000).fadeOut();

            }
        },
        error: function(data) {
            $("#cadeirasProf").css("display", "none");
            $("#msgErro").text(" Não existem cadeiras.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });
}