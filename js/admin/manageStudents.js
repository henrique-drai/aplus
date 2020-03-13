$(document).ready(() => {
    $("body").on("click", ".editStudent",() => displayEditStudent());
    $("body").on("click", "#editStudent-form-submit", () => editStudent());
    $("body").on("click", ".deleteStudent",() => deleteStudent());
})

var oldEmail = "";

function deleteStudent(){
    var linha = $(event.target).closest("tr");
    $.ajax({
        type: "DELETE",
        url: base_url + "api/admin/deleteUser",
        data: {email: linha.find("td:eq(0)").text()},
        success: function(data) {
            getAllStudents();
        },
        error: function(data) {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}

function displayEditStudent(){
    $("#editStudent-form").css("display", "block");
    var linha = $(event.target).closest("tr");
    oldEmail = linha.find("td:eq(0)").text();
}

function editStudent(){
    const data = {
        name:       $("#editStudent-form input[name='name']").val(),
        surname:    $("#editStudent-form input[name='surname']").val(),
        email:      $("#editStudent-form input[name='email']").val(),
        password:   $("#editStudent-form input[name='password']").val(),
        role:       $("#editStudent-form select[name='role']").val(),
        oldemail:   oldEmail,
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/admin/editStudent",
        data: data,   
        success: function() {
        },
        error: function() {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}