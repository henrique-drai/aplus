$(document).ready(() => {
    $("#import-data-submit").click(() => importData())  
})



function importData(){

    
    $.ajax({
        type: "POST",
        url: base_url + "admin/api/importCSV",
        data: {fileName: $("#file-form input[name='myfile']").val()},
        success: function(data) {
            msgSucesso = "<p class='msgSucesso'>Dados importados com Sucesso.</p>";
            alert("Sucesso");
        },
        error: function(data) {
            msgErro = "<p class='msgErro'> Não foi possivel importar os dados.</p>";
            alert("Erro");
        }
    });
    
}