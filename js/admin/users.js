$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())


    getYears();
    getColleges();

    $("#collegesDisplay").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){

            $("#yearsDisplay").change(function(){
                if($("#yearsDisplay").val()!="Selecione um Ano Letivo" && $("#yearsDisplay").val()!="Selecione uma Faculdade"){
                    $("#coursesDisplay").remove()
                    $("#exportInfo2").remove()
                    getCursosFaculdade($("#yearsDisplay").val(), $("#collegesDisplay").val());
                }
            }) ; 
        }
    }) ;


    $("#exportCsv").on("submit", function(e) {
        e.preventDefault()
        $.ajax({
            type: "GET",
            headers: {"Authorization": localStorage.token},
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


    $("body").on("click", "#exportInfo2", function() {

        const data = {
            college:        $("#collegesDisplay").val(),
            year:           $("#yearsDisplay").val(),
            course:         $("#coursesDisplay").val(),

        }

        $.ajax({
            type: "GET",
            headers: {"Authorization": localStorage.token},
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





})




function getCursosFaculdade(ano, faculdade){

    const data = {
        faculdade:          faculdade,
        anoletivo:          ano,
    }

    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getAllCursosFaculdadeAno",
        data: data,
        success: function(data) {
            var option = "Selecione um Curso";
            console.log(data)

            if(data.courses.length > 0){
                for (i=0; i<data.courses.length; i++){
                    option+= "<option value='" + data.courses[i].id + "'>"+ data.courses[i].name  + "</option>"
                }
               
                $("#export2Csv").append("<select id='coursesDisplay' name='courses'></select>")
                $("#coursesDisplay").html(option)
                $("#export2Csv").append("<input type='submit' id='exportInfo2' value='Exportar'>")

            }
            else{
                $("#coursesDisplay").remove()
                $("#exportInfo2").remove()
                $("#collegeStatus").html("Não existem cursos");
                $("#collegeStatus").show().delay(2000).fadeOut();
            }
            
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function getColleges(){
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getAllColleges",            
        success: function(data) {
            var option = "<option class='college_row'>Selecione uma Faculdade</option>";
 
            for (i=0; i<data.colleges.length; i++){
                option+= "<option value='" + data.colleges[i].id + "'>"+ data.colleges[i].name  + "</option>"
            }
            $("#collegesDisplay").html(option)
           
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}


function getYears(){

    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            var option = "<option class='years'>Selecione um Ano Letivo</option>";

            for (i=0; i<data.schoolYears.length; i++){
                option+= "<option value='" + data.schoolYears[i].id + "'>"+ data.schoolYears[i].inicio  + "</option>"
            }
            $("#yearsDisplay").html(option)
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
    }
    if(data.name!=="" || data.surname!=="" || data.email!=="" || data.password!==""){
        $.ajax({
            type: "POST",
            headers: {"Authorization": localStorage.token},
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
