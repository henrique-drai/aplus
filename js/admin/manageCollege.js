$(document).ready(() => {
        getAllColleges();
        
        $("body").on("click", ".deleteCollege",() => deleteCollege());

        setInterval(getAllColleges, 3000);
})

function getAllColleges(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllColleges",
        success: function(data) {
            $("#show_colleges").css("display", "block");
            $(".college_row").remove();
            var linhas = '';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<tr class="college_row"><td>' + data.colleges[i].name + '</td><td>' + data.colleges[i].location + 
                    '</td><td>' + data.colleges[i].siglas + '</td><td><button class="deleteCollege" type="button">Apagar</button></td></tr>'; 
                }
                $('#show_colleges').append(linhas);
            }
            else{
                $("#show_colleges").css("display", "none");
                var mensagem = "<h2 id='mens_sem_faculdades'>Não existe nenhuma faculdade</h2>";
                $("body").append(mensagem);
                $("#mens_sem_faculdades").delay(2000).fadeOut();

            }
            
        },
        error: function(data) {
            $("#show_colleges").css("display", "none");
            var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as faculdades.</h2>";
            $("body").append(mensagem);
            $("#mens_erro_faculdades").delay(2000).fadeOut();
        }
    });
}


function deleteCollege(){
    var linha = $(event.target).closest("tr");
    $.ajax({
        type: "DELETE",
        url: base_url + "admin/api/deleteCollege",
        data: {siglas: linha.find("td:eq(2)").text()},
        success: function() {
            $("#msgStatusDelete").text("Faculdade eliminada com Sucesso");
            $("#msgStatusDelete").show().delay(2000).fadeOut();
        },
        error: function() {
            $("#msgStatus").text(" Não foi possivel eliminar a faculdade");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });
}