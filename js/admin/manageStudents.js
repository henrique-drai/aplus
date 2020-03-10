$(document).ready(() => {
    // $("body").on("click", ".editStudent",() => editStudent());
    $("body").on("click", ".deleteStudent",() => deleteStudent());
})

function deleteStudent(){
    var linha = $(event.target).closest("tr");
    $.ajax({
        type: "DELETE",
        url: base_url + "api/admin/deleteStudent",
        data: {email: linha.find("td:eq(0)").text()},
        success: function(data) {
            getAllStudents();
        },
        error: function(data) {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}