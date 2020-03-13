$(document).ready(() => {
    $("body").on("click", ".editUser",() => displayEditUser());
    $("body").on("click", "#editUser-form-submit", () => editUser());
    $("body").on("click", ".deleteUser",() => deleteUser());
})

var oldEmail = "";

function deleteUser(){
    var linha = $(event.target).closest("tr");
    $.ajax({
        type: "DELETE",
        url: base_url + "api/admin/deleteUser",
        data: {email: linha.find("td:eq(0)").text()},
        success: function() {
        },
        error: function() {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}

function displayEditUser(){
    $("#editUser-form").css("display", "block");
    var linha = $(event.target).closest("tr");
    oldEmail = linha.find("td:eq(0)").text();
}

function editUser(){
    const data = {
        name:       $("#editUser-form input[name='name']").val(),
        surname:    $("#editUser-form input[name='surname']").val(),
        email:      $("#editUser-form input[name='email']").val(),
        password:   $("#editUser-form input[name='password']").val(),
        role:       $("#editUser-form select[name='role']").val(),
        oldemail:   oldEmail,
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/admin/editUser",
        data: data,   
        success: function() {
        },
        error: function() {
            alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
        }
    });
}