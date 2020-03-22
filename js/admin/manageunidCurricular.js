$(document).ready(() => {
    getAllSubjects();
    
    // $("body").on("click", ".deleteCollege",() => deleteCollege());

    // setInterval(getAllSubjects, 5000);
})



function getAllSubjects(){
$.ajax({
    type: "GET",
    url: base_url + "admin/api/getAllSubjects",
    success: function(data) {
        $("#show_subjects").css("display", "block");
        $(".subject_row").remove();
        $("#mens_sem_cadeiras").remove();
        // $("#mens_erro_faculdades").remove();

        if(data.subjects.length>0){
            for(i=0; i<data.subjects.length;i++){
                getCourseStandardId(data.subjects[i].curso_id, data.subjects[i]);
            }
        }
        else{
            $("#mens_sem_cadeiras").remove();
            $("#show_subjects").css("display", "none");
            var mensagem = "<h2 id='mens_sem_cadeiras'>Não existe nenhuma faculdade</h2>";
            $("body").append(mensagem)
        }
        
    },
    error: function(data) {
        $("#show_colleges").css("display", "none");
        $("#mens_sem_cadeiras").remove();
        // $("#mens_erro_faculdades").remove();
        // var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as faculdades.</h2>";
        // $("body").append(mensagem);
    }
});
}

function getCourseStandardId(course_id, dataSubject){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCourseStandardId",
        data: {course_id},
        success: function(data) {
            name = getCourseName(data.course_standard_id.id, dataSubject);
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });
}

function getCourseName(course_standard_id, dataSubject){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getCursoStandard",
        data: {course_standard_id},
        success: function(data) {
            var linhas = '';
            linhas += '<tr class="subject_row"><td>' + dataSubject.code + '</td><td>' + data.course.name + 
                '</td><td>' + dataSubject.name + '</td><td>' + dataSubject.description + 
                '</td><td><button class="deleteSubject" type="button">Apagar</button></td></tr>'; 
            $('#show_subjects').append(linhas);
        },
        error: function(data) {
            // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
            // $("#register-faculdade-form").after(msgErro);
        }
    });
};



// function deleteCollege(){
// var linha = $(event.target).closest("tr");
// $.ajax({
//     type: "DELETE",
//     url: base_url + "admin/api/deleteCollege",
//     data: {siglas: linha.find("td:eq(2)").text()},
//     success: function() {
//         $(".msgSucesso").remove();
//         $(".msgErro").remove();
//         msgSucesso = "<p class='msgSucesso'>Faculdade eliminada com Sucesso.</p>";
//         $("#show_colleges").after(msgSucesso);
//     },
//     error: function() {
//         $(".msgSucesso").remove();
//         $(".msgErro").remove();
//         msgErro = "<p class='msgErro'> Não foi possivel eliminar a faculdade.</p>";
//         $("#show_colleges").after(msgErro);
//     }
// });
// }