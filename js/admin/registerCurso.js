$(document).ready(() => {

    getAllfaculdades();
    $("#register-course-submit").click(() => submitRegister());


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
        }
    });

}


function submitRegister(){
    const data = {
        codCourse:   $("#register-cursos-form input[name='codeCurso']").val(),
        nameCourse:    $("#register-cursos-form input[name='nomeCurso']").val(),
        descCourse:    $("#register-cursos-form input[name='descCurso']").val(),
        collegeName:   $("#register-cursos-form select[name='faculdade']").val()
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