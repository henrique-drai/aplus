$(document).ready(() => {
    $("#register-course-submit").click(() => submitRegister())  
})



function submitRegister(){
    const data = {
        codCourse:   $("#register-cursos-form input[name='codeCurso']").val(),
        nameCourse:    $("#register-cursos-form input[name='nomeCurso']").val(),
        descCourse:    $("#register-cursos-form input[name='descCurso']").val(),
        collegeName:   $("#register-cursos-form select[name='faculdade']").val()
    }
   
    $('#register-cursos-form')[0].reset();

    // $(".msgSucesso").remove();
    // $(".msgErro").remove();

    $.ajax({
        type: "POST",
        url: base_url + "admin/api/registerCurso",
        data: data,
        success: function(data) {
            msgSucesso = "<p class='msgSucesso'>Curso registado com Sucesso.</p>";
            $("#register-faculdade-form").after(msgSucesso);
            console.log("Sucesso");
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel registar o curso.</p>";
            $("#register-faculdade-form").after(msgErro);
            console.log("Erro");
        }
    });
    
}