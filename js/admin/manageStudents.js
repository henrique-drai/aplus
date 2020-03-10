$(document).ready(() => {
    $(".editStudent").click(() => editStudent())
    $(".deleteStudent").click(() => deleteStudent())
    console.log("cenas")
})

function deleteStudent(){
    console.log("Cenas")
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteStudent",
        data: {email: $(".student_email").val()},
        success: function(data) {
            console.log("Apagou!!")
        },
        error: function(data) {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}