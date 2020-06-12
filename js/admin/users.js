$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())

    getAllfaculdades();
    getAllSchoolYears();
    getYears();
    getColleges();


    // ##############################################################################
    
    $("#studentsOrTeachers").change(function(){
        
        if($("#studentsOrTeachers").val()!="Selecione um Privilégio" ){

            if($("#studentsOrTeachers").val()=="students"){
                $("#teachersImport").css("display","none")
                $("#collegesDisplay1").css("display","block")
                $("#yearsDisplay1").css("display","block")

                
            }
            else{
                $("#collegesDisplay1").css("display","none")
                $("#yearsDisplay1").css("display","none")
                $("#teachersImport").css("display","block")
            }
        }
        else{
            $("#teachersImport").css("display","none")
            $("#collegesDisplay1").css("display","none")
            $("#yearsDisplay1").css("display","none")
        }

    }) ;


    // ############################ POP-UP ###########################################

    var path =  $('#csvExample').attr("src")

    $('body').on("click", "#showDemo",function() {
        event.preventDefault();
        $("#removePadding").text("Formato ficheiro '.csv' de importação - Alunos ")
        $('#csvExample').attr("src", path.replace("csv_example_prof.png", "csv_example.png"));
        $("#csvExample").css("width","420px");
        $('#import_csv_style').addClass('is-visible');
    });
    $('body').on("click", "#showDemo2",function() {
        event.preventDefault();
        $("#removePadding").text("Formato ficheiro '.csv' de importação - Professores")
        $('#csvExample').attr("src", path.replace("csv_example.png", "csv_example_prof1.png"));
        $("#csvExample").css("width","529px");

        $('#import_csv_style').addClass('is-visible');
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
    $("body").on('click', "#closePopUp", function(){
        $('.cd-popup').removeClass('is-visible');
    })


      
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


    $("#teachersImport").submit(function(e) {

        e.preventDefault();    
        var formData = new FormData(this);

        // CONTINUAR A PARTIR DAQUI
        // FAZER O AJAX -> CONTROLLER -> MODEL

        $.ajax({
            url: base_url + "api/importTeachersSubjects",
            type: 'POST',
            headers: {"Authorization": localStorage.token},
            data: formData,
            success: function (data) {
                $("#importSuccess").html("Ficheiro importado com sucesso");
                $("#importSuccess").show().delay(2000).fadeOut();
                $("#file").val("");
},
            error: function(data) {
                $("#importError").html("Erro a importar ficheiro");
                $("#importError").show().delay(2000).fadeOut();
},
            cache: false,
            contentType: false,
            processData: false
        });
    });
    

// PRECISA DE SER SUBMIT?!?
    $("#importToCourse").submit(function(e) {


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
                $("#file").val("");
                $(".fa-upload").show()
                $(".js-fileName").text("Escolher ficheiro")
                
            },
            error: function(data) {
                $("#importError").html("Erro a importar ficheiro");
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
            $("#registerAnoUser").first();
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
            $("#registerAnoUser").first();
            $("#registerUserCurso").val("");
        }
        else if($(this).val()=="teacher"){
            $("#register-form label[for='academicYearUser']").css("display", "block");
            $("#register-form label[for='faculUser']").css("display", "block");
            $("#registerUserFacul").css("display", "block");
            $("#registerAnoUser").css("display", "block");
            $("#cursoUser").css("display", "none");
            $("#registerUserFacul").val("");
            $("#registerAnoUser").first();
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

    $("#registerUserCurso").change(function(){
        if($(this).val()!=""){
            if($("#registerUserCurso").val()!= "" && $("#register-form select[name='role']").val() == "student"){
                getAllCadeirasByCourse($("#registerUserCurso").val()); 
                $("#cadeirasUser").css("display", "block");
            }
        }
        else{
            $("#cadeirasUser").css("display", "none");
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
                $("#cadeirasUser").css("display", "block");
            }
        }
        else{
            $("#cadeirasUser").css("display", "none");
        }
    });

    $("body").on("dblclick", ".cadeira_row_user", function(){
        $("#selectedCadeiras").css("display", "block");
        $("#cadeiras").css("display", "block");

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
                // var linha = '<p class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<a class='tirarCadeira' href='#'>&times;</a></p>";
                // var linha = '<p class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<button class='tirarCadeira'>Anular</button></p>";
                var linha = '<div class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<div class='tirarCadeira'>&times; <span class='tooltiptext'>Remover</span></div></div>";
                $("#cadeiras").append(linha);
            }

        }
        else{
            // var linha = '<p class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<a class='tirarCadeira' href='#'>&times;</a></p>";
            var linha = '<div class="selectedcadeiras" id="cadeira_' + $(this).val()+'">' + $(this).text() + "<div class='tirarCadeira'>&times; <span class='tooltiptext'>Remover</span></div></div>";
            $("#cadeiras").append(linha);
        }        
        $( "#registerUserCadeira option[value=" + $(this).val() + "]").remove();
        
    })

    $("body").on("click", ".tirarCadeira", function(){

        var id = $(this).parent().attr('id').split("_")[1]
        var text = $(this).parent().text().split("×")[0]
        $("#registerUserCadeira").append("<option class='cadeira_row_user' value=" + id +">" + text + "</option>")
        
        $(this).parent().remove();
    //    registerUserCadeira
       if($(".selectedcadeiras").length==0){
            $("#cadeiras").css("display", "none");
        }
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
                if(data.schoolYears[i].inicio>=new Date().getFullYear()){
                    option+= "<option value='" + data.schoolYears[i].id + "'>"+ data.schoolYears[i].inicio  + "</option>"
                }
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
    var cadeirasUser = [];
    if($(".selectedcadeiras").length>0){
        for(var i=0; i<$(".selectedcadeiras").length; i++){
            var id = $(".selectedcadeiras")[i].id
            var cadeiraid = id.split("_")[1];
            cadeirasUser.push(cadeiraid);
        }
    }
    const data = {
        name:       $("#register-form input[name='name']").val(),
        surname:    $("#register-form input[name='surname']").val(),
        email:      $("#register-form input[name='email']").val(),
        password:   $("#register-form input[name='password']").val(),
        role:       $("#register-form select[name='role']").val(),
        curso:      $("#register-form select[name='cursoUserSel']").val(),
        cadeiras:   cadeirasUser,
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
                    $("#register-form select[name='role']").val("admin");
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
        if(data.name!=="" && data.surname!=="" && data.email!=="" && data.password!=="" && data.course !== "" && cadeirasUser !== []){
            $.ajax({
                type: "POST",
                url: base_url + "api/register",
                data: data,
                success: function(data) {
                    $("input[type='text']").val("");
                    $("input[type='password']").val("");
                    $("#register-form select[name='role']").val("admin");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                    $("#register-form label[for='academicYearUser']").css("display", "none");
                    $("#register-form label[for='faculUser']").css("display", "none");
                    $("#registerUserFacul").css("display", "none");
                    $("#registerAnoUser").css("display", "none");
                    $("#cadeirasUser").css("display", "none");
                    $("#cursoUser").css("display", "none");
                    $("#selectedCadeiras").css("display", "none"); 
                    $(".selectedcadeiras").remove();
                    $("#registerUserFacul").val("");
                    $("#registerAnoUser").first();
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
                    $("#register-form select[name='role']").val("admin");
                    $("#msgStatus").text("Utilizador registado com sucesso.");
                    $("#msgStatus").show().delay(2000).fadeOut();
                    $("#register-form label[for='academicYearUser']").css("display", "none");
                    $("#register-form label[for='faculUser']").css("display", "none");
                    $("#registerUserFacul").css("display", "none");
                    $("#registerAnoUser").css("display", "none");
                    $("#cadeirasUser").css("display", "none");
                    $("#cursoUser").css("display", "none");
                    $("#selectedCadeiras").css("display", "none"); 
                    $(".selectedcadeiras").remove();
                    $("#registerUserFacul").val("");
                    $("#registerAnoUser").first();
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
                // $("#importFromCsv").append("<input type='file' id='myfile' name='userfile' accept='.csv' required>")
                
                $("#importFromCsv").append("<div class='form-group'>"

                // +"<input type='file' id='myfile' name='file' class='input-file' accept='.csv' required >"

                +"<input type='file' name='userfile' id='file' class='input-file' accept='.csv' required>"
                +"<label for='file' class='btn btn-tertiary js-labelFile'>"
                +"<i class='fa fa-upload'></i>"
                + "<span class='js-fileName'>Escolher ficheiro</span>"
                +"</label>"
                +"</div>"
                )

                $('.input-file').each(function() {
                    var $input = $(this),
                        $label = $input.next('.js-labelFile'),
                        labelVal = $label.html();
                    
                    $input.on('change', function(element) {
                        var fileName = '';
                        if (element.target.value) fileName = element.target.value.split('\\').pop();

                        if(fileName ){
                            $label.addClass('has-file').find('.js-fileName').html(fileName); 
                            $(".fa-upload").hide()
                        }
                        else{
                            $label.removeClass('has-file').html(labelVal);
                        }
                    });
                });
                
                
                $("#importFromCsv").append("<input type='submit' id='importToCourse'  value='Importar'></input>")               
            }
            else{
                $(".form-group").remove()
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
            if(data.schoolYears.length<3){
                var linhas='<option class="ano_letivo_user" value=' + data.schoolYears[0].id +">" + data.schoolYears[0].inicio + '/' + data.schoolYears[0].fim + '</option>';
                for(i=1; i<data.schoolYears.length;i++){
                    linhas += '<option class="ano_letivo_user" value=' + data.schoolYears[i].id +">" + data.schoolYears[i].inicio + '/' + data.schoolYears[i].fim + '</option>'; 
                }
                $("#registerAnoUser").html(linhas);
            }
            else if (data.schoolYears.length>=3){
                var linhas='<option class="ano_letivo_user" value=' + data.schoolYears[0].id +">" + data.schoolYears[0].inicio + '/' + data.schoolYears[0].fim + '</option>';
                for(i=1; i<3;i++){
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
                    linhas += '<option class="cadeira_row_user" value=' + data.cadeiras[i]["id"] +">" + data.cadeiras[i]["name"] + '</option>'; 
                }
                $("#registerUserCadeira").html(linhas);

            }
            else{
                $("#cadeirasUser").css("display", "none");
                $("#msgErro").text("Não existem cadeiras.");
                $("#msgErro").show().delay(2000).fadeOut();

            }
        },
        error: function(data) {
            $("#cadeirasUser").css("display", "none");
            $("#msgErro").text(" Não existem cadeiras.");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });
}