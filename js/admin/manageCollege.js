$(document).ready(() => {
        getAllColleges();
        setInterval(getAllColleges, 3000);
})

function getAllColleges(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllColleges",
        success: function(data) {
            $("#show_colleges").css("display", "block");
            $(".college_row").remove();
            $("#mens_sem_faculdades").remove();
            var linhas = '';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<tr class="college_row"><td>' + data.colleges[i].name + '</td><td>' + data.colleges[i].location +
                    '</td><td><button class="deleteUser" type="button">Apagar</button></td></tr>'; 
                }
                $('#show_colleges').append(linhas);
            }
            else{
                $("#mens_sem_faculdades").remove();
                $("#show_colleges").css("display", "none");
                var mensagem = "<h2 id='mens_sem_faculdades'>Não existe nenhuma faculdade</h2>";
                $("body").append(mensagem)
            }
            
        },
        error: function(data) {
            console.log("Erro a mostrar as faculdades!")
        }
    });
}


// function deleteCollege(){
//     var linha = $(event.target).closest("tr");
//     $.ajax({
//         type: "DELETE",
//         url: base_url + "admin/api/deleteCollege",
//         data: {email: linha.find("td:eq(0)").text()},
//         success: function() {
//             if (page_name=="students"){
//                 getAllStudents();
//             } else if (page_name=="teachers") {
//                 getAllTeachers();
//             } 
//         },
//         error: function() {
//             alert("Dados inválidos. (Esta mensagem vai ser substituída, como é óbvio)")
//         }
//     });
// }