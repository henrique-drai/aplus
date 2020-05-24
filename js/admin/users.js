$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())

    getAllfaculdades();
    getAllSchoolYears();
    getYears();
    getColleges();


    // ############################ EXPORT ###########################################

    // 1 ou 2 como parâmetro, para não repetir código e para saber se é do primeiro form ou do segundo

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
                $("#importStatus").html("Ficheiro importado com sucesso");
                $("#importStatus").show().delay(2000).fadeOut();
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

    $("#registerUserFacul").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            if($("#registerAnoUser").val()!= ""){
                getAllCursosFaculdade($(this).val(), $("#registerAnoUser").val()); 
            }
        }
    });

    $("#registerAnoUser").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            if($("#registerUserFacul").val()!= ""){
                getAllCursosFaculdade($("#registerUserFacul").val(), $(this).val()); 
            }
        }
    });
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

    const data = {
        name:       $("#register-form input[name='name']").val(),
        surname:    $("#register-form input[name='surname']").val(),
        email:      $("#register-form input[name='email']").val(),
        password:   $("#register-form input[name='password']").val(),
        role:       $("#register-form select[name='role']").val(),
        curso:      $("#register-form select[name='cursoUser']").val(),
    }
    if(data.role == "admin" || data.role == "teacher"){
        if(data.name!=="" || data.surname!=="" || data.email!=="" || data.password!==""){
            $.ajax({
                type: "POST",
                url: base_url + "api/register",
                data: data,
                success: function(data) {
                    $("input[type='text']").val("");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                },
                error: function(data) {
                    $("input[type='text']").val("");
                    $("#msgStatus").text("Não foi possivel registar o utilizador.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                }
            });
        }
        else{
            $("#msgStatus").text("É necessário preencher todos os campos.");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    }
    else{
        if(data.name!=="" || data.surname!=="" || data.email!=="" || data.password!=="" || data.course !== null){
            $.ajax({
                type: "POST",
                url: base_url + "api/register",
                data: data,
                success: function(data) {
                    $("input[type='text']").val("");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                },
                error: function(data) {
                    $("input[type='text']").val("");
                    $("#msgStatus").text("Não foi possivel registar o utilizador.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                }
            });
        }
        else{
            $("#msgStatus").text("É necessário preencher todos os campos.");
            $("#msgStatus").show().delay(2000).fadeOut();
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
            $("#msgStatus").text("Não foi possível encontrar anos letivos.");
            $("#msgStatus").show().delay(2000).fadeOut();
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
                $("#msgStatus").text("Não existem disponíveis faculdade.");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        },
        error: function(data) {
            $("#msgStatus").text("Não foi possível encontrar faculdades.");
            $("#msgStatus").show().delay(2000).fadeOut();
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
                for(i=0; i<data.courses.length; i++){
                   
                    var linhas = '';
                    linhas += '<option class="course_row_register_user" value=' + data.courses[i].id +">" + data.courses[i].name + '</option>'; 
                
                     $("#registerUserCurso").append(linhas);
                }
            }
            else{
                $("#cursoUser").css("display", "none");
                $("#registerUserCurso option").remove();
                $("#msgStatus").text("Não existem cursos.");
                $("#msgStatus").show().delay(2000).fadeOut();

            }
        },
        error: function(data) {
            $("#cursoUser").css("display", "none");
            $("#registerUserCurso option").remove();
            $("#msgStatus").text(" Não existem cursos.");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });

}