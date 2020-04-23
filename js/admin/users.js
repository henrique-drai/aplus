$(document).ready(() => {
    $("#register-form-submit").click(() => submitRegister())

    $("#exportCsv").on("submit", function(e) {
        e.preventDefault()
        $.ajax({
            type: "GET",
            headers: {"Authorization": localStorage.token},
            url: base_url + "api/saveCSV",
            data:{role:$("#exportCsv select").val()},
            success:function(data){exportCSV(data)}
        })
    })

})



function submitRegister(){

    const data = {
        name:       $("#register-form input[name='name']").val(),
        surname:    $("#register-form input[name='surname']").val(),
        email:      $("#register-form input[name='email']").val(),
        password:   $("#register-form input[name='password']").val(),
        role:       $("#register-form select[name='role']").val(),
    }
    if(data.name!=="" || data.surname!=="" || data.email!=="" || data.password!==""){
        $.ajax({
            type: "POST",
            headers: {"Authorization": localStorage.token},
            url: base_url + "api/register",
            data: data,
            success: function(data) {
                $("input[type='text']").val("");
                $("#msgStatus").text("Utilizador registado com sucesso.");
                $("#msgStatus").show().delay(2000).fadeOut();
            },
            error: function(data) {
                $("input[type='text']").val("");
                $("#msgStatus").text("Não foi possivel registar o utilizador.");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgStatus").text("É necessário preencher todos os campos.");
        $("#msgStatus").show().delay(2000).fadeOut();
    }
}

function exportCSV(csvContent){
    // var encodedUri = encodeURI(csvContent); 
    // window.open(encodedUri);
    // console.log(csvContent);
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvContent);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'export.csv';
    hiddenElement.click();
}


// function exportCSV() {
//     $.ajax({
//         type: "GET",
//         headers: {"Authorization": localStorage.token},
//         url: base_url + "api/saveCSV"}
//     )}