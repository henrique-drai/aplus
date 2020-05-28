var unidCurr
var allSubjects = "";
var selectedUC = "";

$(document).ready(() => {

    cleanTable();

    // $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    // $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    // $("#Consultar_Cadeiras_Curso").css("display", "none");
    // $("#Consultar_Cadeiras_Ano").css("display", "none");

    getColleges();
    getCourses();
    getAllYears();

    $(".SubjectsSelects").change(function(){
        cleanTable();
        var faculdade = $("#Consultar_Cadeiras_Faculdade").val();
        var curso = document.getElementById("Consultar_Cadeiras_Curso").options[document.getElementById("Consultar_Cadeiras_Curso").selectedIndex].text;
        var cursonome = curso.split("(")[0];
        if(cursonome == "Selecione uma Curso"){
            cursonome = "";
        }
        var ano = $("#Consultar_Cadeiras_Ano").val();
        getSubjectsByFilters(faculdade,cursonome,ano);

    })

    // $("#Consultar_Cadeiras").change(function(){
    //     if($("#Consultar_Cadeiras").val() == "All"){

    //         cleanTable();
    //         allSubjects = "";
    //         getAllSubjects();

    //         $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    //         $("#Consultar_Cadeiras_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Ano").css("display", "none");

    //     }
    //     else if($("#Consultar_Cadeiras").val() == "Faculdade"){  // QUER VER POR FACULDADES

    //         cleanTable();

    //         $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Faculdade").css("display", "block");
    //         $("#Consultar_Cadeiras_Ano").css("display", "none");

    //         getColleges("faculdade");
    //         $("#Consultar_Cadeiras_Faculdade").unbind("change");
    //         $("#Consultar_Cadeiras_Faculdade").change(function(){
                
    //             cleanTable();
    //             if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
    //                 getAllCoursesByCollege($(this).val(), "faculdade");
                    
    //             }
    //             else{
    //                 $("#mens_sem_cadeiras").remove();
    //                 $(".subject_row").remove();
    //             }
                
    //         })  
    //     }
    //     else if($("#Consultar_Cadeiras").val() == "Curso"){ // QUER VER POR CURSOS
            
    //         $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "block");;
    //         $("#Consultar_Cadeiras_Ano").css("display", "none");
    //         $("#Consultar_Cadeiras_Faculdade").css("display", "none");
            
    //         cleanTable();

    //         getColleges("curso");

    //         $("#Consultar_Cadeiras_Faculdade_Curso").unbind("change");
    //         $("#Consultar_Cadeiras_Curso").unbind("change");

    //         $("#Consultar_Cadeiras_Faculdade_Curso").change(function(){
    //             cleanTable();
    //             if($("#Consultar_Cadeiras_Faculdade_Curso").val() != "Selecione uma Faculdade"){

    //                 getAllCoursesByCollege($(this).val(), "curso");                    
    //             }
    //             else{

    //                 $("#Consultar_Cadeiras_Curso").css("display", "none");
    //                 $("#mens_sem_cadeiras").remove();  
    //             }   
    //         }) 

    //         $("#Consultar_Cadeiras_Curso").change(function(){
    //             if($("#Consultar_Cadeiras_Curso").val() != "Selecione um curso"){
    //                 cleanTable();
    //                 getAllSubjectsByCourse($(this).val());
    //             }
    //             else{
    //                 cleanTable();
    //                 $("#mens_sem_cadeiras").remove();
                    
    //             }
                
    //         })
    //     }
    //     else if($("#Consultar_Cadeiras").val() == "AnoLetivo"){
    //         $("#show_subjects").css("display", "none");
    //         $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    //         $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Ano").css("display", "block");
    //         $("#Consultar_Cadeiras_Ano").unbind("change");
    //         getAllYears();

    //         $("#Consultar_Cadeiras_Ano").change(function(){
    //             cleanTable();
    //             if($("#Consultar_Cadeiras_Ano").val() != "Selecione um Ano Letivo"){
    //                 getAllCoursesByYear($(this).val());                    
    //             }
    //         })

    //     }
    //     else{
    //         cleanTable();
    //         $("#Consultar_Cadeiras_Faculdade").css("display", "none");
    //         $("#Consultar_Cadeiras_Faculdade_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Curso").css("display", "none");
    //         $("#Consultar_Cadeiras_Ano").css("display", "none");
    //     }
    // });

    $("body").on("click", "#editSubject-form-submit", () => editSubject());

    //open popup
	$('body').on('click','.deleteSubject', function(event){
        event.preventDefault();
        unidCurr = $(event.target).closest("tr");
        $('#subject_admin_delete').addClass('is-visible');
    });
    
	//close popup
	$('#subject_admin_delete').on('click', function(event){
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
        $('#subject_admin_delete').removeClass('is-visible');
        deleteSubject(unidCurr);
    })

    // POPUP Edit

    $('body').on("click", ".editSubject",function() {
        event.preventDefault();
        User = $(event.target).closest("tr");
        $('#subject_admin_edit').addClass('is-visible');
        displayEditSubject();
    });

    $('#subject_admin_edit').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });
})


function cleanTable(){
    allSubjects = "";
    $("#subject_list").remove();
    $(".subject_row").remove();
}



function getAllSubjects(){

    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSubjects",
        success: function(data) {

            cleanTable();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();

            if(data.subjects.length>0){
                makeAllSubjectsTable(data);           
            }
            else{
                $("#mens_sem_cadeiras").remove();
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            cleanTable();
            $("#mens_sem_cadeiras").remove();
            $("#mens_erro_faculdades").remove();
            var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as unidades curriculares.</h2>";
            $("body").append(mensagem);
        }
    })
}



function makeAllSubjectsTable(data){   
    var allSubjects="";
    for(i=0; i<data.subjects.length;i++){
        allSubjects += '<tr class="subject_row">' +
                    '<td>'+ data.subjects[i].id +'</td>' +
                    '<td>'+ data.subjects[i].code +'</td>' +
                    '<td>'+ data.courses[i].name +'</td>' +
                    '<td>'+ data.subjects[i].name + '</td>' +
                    '<td>'+ data.subjects[i].sigla + '</td>' +
                    '<td>'+ data.subjects[i].semestre + '</td>' +
                    '<td>'+ data.subjects[i].description + '</td>' +
                    '<td><input class="editSubject" type="button" value="Editar"></td>' +
                    '<td><input class="deleteSubject" type="button" value="Eliminar"></td>' +
                    '</tr>';
    }
    var table = '<table class="adminTable" id="subject_list">' +
    '<tr><th>ID</th>' +
    '<th>Código da UC</th>' +
    '<th>Curso</th>' + 
    '<th>Nome</th>' +
    '<th>Sigla</th>' +
    '<th>Semestre</th>' +
    '<th>Descrição</th>' + 
    '<th>Editar</th>' +
    '<th>Apagar</th></tr>' +
    allSubjects + 
    '</table>'

    $("#subject-container").html(table);       
}

function getColleges(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllColleges",
        success: function(data) {
            
            $("#Consultar_Cadeiras_Faculdade option").remove();
            $("#Consultar_Cadeiras_Faculdade_Curso option").remove();
            var linhas = '<option class="college_row" value="">Selecione uma Faculdade</option>';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row" value=' + data.colleges[i].id +">" + data.colleges[i].name + '</option>'; 
                }
                // if (option == "faculdade"){
                $("#Consultar_Cadeiras_Faculdade").append(linhas);
                // }
                // else if(option == "curso"){
                //     $("#Consultar_Cadeiras_Faculdade_Curso").append(linhas);
                // }                
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar as faculdades.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}

function getCourses(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllCourses",
        success: function(data) {
            $("#Consultar_Cadeiras_Curso option").remove();
            var linhas = '<option class="course_row" value="">Selecione uma Curso</option>';
            if(data.courses.length>0){
                for(i=0; i<data.courses.length;i++){
                    linhas += '<option class="course_row" value=' + data.courses[i].id +">" + data.courses[i].name + " (" + data.numSubject[data.courses[i].name] + ")" + '</option>'; 
                }    
                $("#Consultar_Cadeiras_Curso").append(linhas);         
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar as faculdades.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}

function getAllYears(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            
            $("#Consultar_Cadeiras_Ano option").remove();
            var linhas = '<option class="year_row" value="">Selecione um Ano Letivo</option>';
            if(data.schoolYears.length>0){
                for(i=0; i<data.schoolYears.length;i++){
                    linhas += '<option class="year_row" value=' + data.schoolYears[i].id +">" + data.schoolYears[i].inicio + "/" + data.schoolYears[i].fim + '</option>'; 
                }
                $("#Consultar_Cadeiras_Ano").append(linhas);             
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar os anos letivos.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}

function getSubjectsByFilters(faculdade, curso, ano){
    $.ajax({
        type: "GET",
        url: base_url + "api/getSubjectsByFilters",
        data: {f: faculdade,c: curso, a: ano},
        success: function(data) {
            if(data.subjects != ""){
                makeAllSubjectsTable(data);
            }
            else{
                $("#mens_sem_cadeiras").remove();
                cleanTable();
                var mensagem = "<h2 id='mens_sem_cadeiras'>Não existem unidades curriculares com as opções indicadas.</h2>";
                $("#subject-container").append(mensagem); 
            }
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel encontrar os anos letivos.</p>";
            $("#register-faculdade-form").after(msgErro);
        }
    });
}


// function getAllCoursesByCollege(faculdade, option){
//     $.ajax({
//         type: "GET",
//         headers: {"Authorization": localStorage.token},
//         url: base_url + "api/getAllCursosFaculdade",
//         data: {faculdade},
//         success: function(data) {
//             cleanTable();
//             if(data.courses.length>0){

//                 $("#Consultar_Cadeiras_Curso option").remove();
//                 var linhas = '<option class="college_row">Selecione um Curso</option>';

//                 if(option == "faculdade"){
//                     getAllSubjectsByCourse(data.courses);
//                     $("#Consultar_Cadeiras_Curso").css("display", "none");
//                 }

//                 for(i=0; i<data.courses.length;i++){
//                     if(option == "curso"){
//                         linhas += '<option class="courses_row" value=' + data.courses[i].id +">" + data.courses[i].name + '</option>'; 
//                     }
//                 }

//                 if(option == "curso"){
//                     $("#mens_sem_cadeiras").remove();
//                     $("#Consultar_Cadeiras_Curso").append(linhas);
//                     $("#Consultar_Cadeiras_Curso").css("display", "block");

//                 }
               
//             }
//             else{
//                 $("#mens_sem_cadeiras").remove();
//                 cleanTable();
//                 $("#Consultar_Cadeiras_Curso").css("display", "none");
//                 var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe cursos nesta faculdade, logo não existem unidades curriculares.</h2>";
//                 $("body").append(mensagem);
//             }
            
//         },
//         error: function(data) {
//             cleanTable();
//             $("#mens_sem_cadeiras").remove();
//         },
//         complete: function(data){
//             if($("subject_list").css("display")=="none" && $("subject_list").length == 0){
//                 cleanTable();
//                 $("#mens_sem_cadeiras").remove();
//                 var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular nos cursos existentes</h2>";
//                 $("body").append(mensagem);
//             }
//        } 
//     });
// }

// function getAllSubjectsByCourse(courses){
//     $.ajax({
//         type: "GET",
//         headers: {"Authorization": localStorage.token},
//         url: base_url + "api/getAllSubjectsByCourse",
//         data: {courses},
//         success: function(data) {
//             cleanTable();
//             $("#mens_sem_cadeiras").remove();  
//             if(data.subjects.length>0){
//                 makeAllSubjectsTable(data);
//             }    
//             else{
//                 cleanTable();
//                     $("#mens_sem_cadeiras").remove();
//                     var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular nos cursos existentes</h2>";
//                     $("body").append(mensagem);
//             }
//         },
//         error: function(data) {
//             $("#show_colleges").css("display", "none");
//             $("#mens_sem_cadeiras").remove();

//         }
//     });

// }




// function getAllCoursesByYear(idyear){
//     $.ajax({
//         type: "GET",
//         headers: {"Authorization": localStorage.token},
//         url: base_url + "api/getAllCoursesByYear",
//         data: {idyear},
//         success: function(data) {
//             if(data.courses.length>0){
//                 getAllSubjectsByCourse(data.courses)
//             }
//             else{
//                 cleanTable();
//                 $("#mens_sem_cadeiras").remove();
//                 var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma unidade curricular neste ano letivo</h2>";
//                 $("body").append(mensagem);
//             }
//         },
//         error: function(data) {
//             msgErro = "<p class='msgErro'> Não foi possivel encontrar os anos letivos.</p>";
//             $("#register-faculdade-form").after(msgErro);
//         }
//     });
// }


function displayEditSubject(){
    var linha = $(event.target).closest("tr");
    selectedUC = linha.find("td:eq(0)").text();
    codigo = linha.find("td:eq(1)").text();
    nome =  linha.find("td:eq(3)").text();
    sigla =  linha.find("td:eq(4)").text();
    semestre =  linha.find("td:eq(5)").text();
    desc =  linha.find("td:eq(6)").text();
   
    $("#editSubject-form input[name='codigo']").val(codigo);
    $("#editSubject-form input[name='nome']").val(nome);
    $("#editSubject-form input[name='semestre']").val(semestre);
    $("#editSubject-form textarea[name='descCadeira']").val(desc);
    $("#editSubject-form input[name='sigla']").val(sigla);
    $(".popup").css("display", "block");
}


function  editSubject(){
    const data = {
    id: selectedUC,
    codigo:    $("#editSubject-form input[name='codigo']").val(),
    nome:    $("#editSubject-form input[name='nome']").val(),
    sigla:    $("#editSubject-form input[name='sigla']").val(),
    semestre:    $("#editSubject-form input[name='semestre']").val(),
    desc:    $("#editSubject-form textarea[name='descCadeira']").val(),
    }

    $.ajax({
        type: "POST", 
        url: base_url + "api/editSubject",
        data: data,   
        success: function() {    
            $("#subject_admin_edit").removeClass('is-visible');
            var faculdade = $("#Consultar_Cadeiras_Faculdade").val();
            var curso = document.getElementById("Consultar_Cadeiras_Curso").options[document.getElementById("Consultar_Cadeiras_Curso").selectedIndex].text;
            var cursonome = curso.split("(")[0];
            
            if(cursonome == "Selecione uma Curso"){
                cursonome = "";
            }
            else{
                cursonome = cursonome.split(" ")[0]; 
            }
            
            var ano = $("#Consultar_Cadeiras_Ano").val();
            getSubjectsByFilters(faculdade,cursonome,ano);
        },
        error: function() {
            msgErro = "<p class='msgErro'> Não foi possivel editar o utilizador.</p>";
            $("#msgErroEditar").append(msgErro);
            $(".msgErro").delay(2000).fadeOut();
        }
    });
}




function deleteSubject(linha){
$.ajax({
    type: "DELETE", 
    url: base_url + "api/deleteSubject",
    data: {code: linha.find("td:eq(0)").text()},
    success: function() {
        msgSucesso = "<p class='msgSucesso'>Faculdade eliminada com Sucesso.</p>";
        $("body").after(msgSucesso)
        $(".msgSucesso").delay(2000).fadeOut();
        if($("#Consultar_Cadeiras").val() == "All"){
            getAllSubjects();
        }
        else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade" && $("#Consultar_Cadeiras_Faculdade").val()!=null){
            getAllCoursesByCollege($("#Consultar_Cadeiras_Faculdade").val(), "faculdade");
        }
        else if($("#Consultar_Cadeiras_Curso").val() != "Selecione um curso"){
            getAllSubjectsByCourse($("#Consultar_Cadeiras_Curso").val());
        }
        else if($("#Consultar_Cadeiras_Faculdade").val() != "Selecione uma Faculdade"){
            getAllCoursesByYear($("#Consultar_Cadeiras_Ano").val());
        }

    },
    error: function() {
        msgErro = "<p class='msgErro'> Não foi possivel eliminar a faculdade.</p>";
        $("body").after(msgErro)
        $(".msgErro").delay(2000).fadeOut();
    }
});
}