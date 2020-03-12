$(document).ready(() => {
    // $("body").on("click", ".editTeacher",() => editTeacher());
    $("body").on("click", ".deleteTeacher",() => deleteTeacher());
})

function deleteTeacher(){
    var linha = $(event.target).closest("tr");
    $.ajax({
        type: "DELETE",
        url: base_url + "api/admin/deleteUser",
        data: {email: linha.find("td:eq(0)").text()},
        success: function(data) {
            getAllTeachers();
        },
        error: function(data) {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}