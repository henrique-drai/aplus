var etapas = [{id:'etapa1', nome:'', desc:'', data:''}];

$(document).ready(() => {

    var etapanum = $('.etapa').length;

    $('body').on('click', '#addEtapa', function(e) {
        etapanum++;
        var pid = 'etapa'+etapanum;

        const etapa = '<p id='+pid+' class="etapa">' +
             '<label class="form-label">Nome</label> ' +
             '<input class="form-input-text" type="text" name="etapaName" required> ' +
             '<label class="form-label">Descrição</label> ' + 
             '<input class="form-input-text" type="text" name="etapaDescription" required> ' +
             '<label class="form-label">Data de entrega</label> ' + 
             '<input class="form-input-text" type="date" name="etapaDate" required> ' +
             '<label id="removeEtapa"> X </label> ' +
             '</p> '
        
        etapas.push({id:'etapa'+etapanum, nome:'', desc:'', data:''});
        $('.etapa').last().after(etapa);     

        $('.etapa').last().change(function(){
            var name = $(this).find('input[name="etapaName"]').val();
            var desc = $(this).find('input[name="etapaDescription"]').val();
            var data = $(this).find('input[name="etapaDate"]').val();
            insertIntoEtapas(pid, name, desc, data);
        })
    })

    $('body').on('click', '#removeEtapa', function(e) {
        for (i=0; i<etapas.length; i++){
            if(etapas[i].id == $(this).parent().attr("id"))
                etapas.splice(i);
        }
        console.log(etapas);
        $(this).parent().remove();
    }) 

    $("#etapa1").change(function(){
        var name = $(this).find('input[name="etapaName"]').val();
        var desc = $(this).find('input[name="etapaDescription"]').val();
        var data = $(this).find('input[name="etapaDate"]').val();
        insertIntoEtapas("etapa1", name, desc, data);
    })

    $("#maxnuminput").keyup(function(){
        validateFormNumb();
    })

    $("#minnuminput").keyup(function(){
        validateFormNumb();
    })

    $("#createProjectButton").click(() => submitProject());

})


function insertIntoEtapas(id, name, desc, data){
    console.log(name +" " + desc + " " + data);
    for (i=0; i<etapas.length; i++){
        if(etapas[i].id == id)
            etapas[i].nome = name;
            etapas[i].desc = desc;
            etapas[i].data = data;
    }

    verifyDates(id);
}


function validateFormNumb(){
    if($("#minnuminput").val() != '' && $("#maxnuminput").val() != ''){
        if(parseInt($("#minnuminput").val()) >= parseInt($("#maxnuminput").val())){
            $("#minnuminput").css("border-left-color", "salmon");
            $("#maxnuminput").css("border-left-color", "salmon");
            return false;
        } else {
            $("#minnuminput").css("border-left-color", "palegreen");
            $("#maxnuminput").css("border-left-color", "palegreen");
            return true;
        }
    }
}


function verifyDates(id){
    for (i=0; i<etapas.length; i++){
        if(etapas[i].id == id)
            etapas[i].nome = name;
            etapas[i].desc = desc;
            etapas[i].data = data;
    }
}


function verifyallinputs(){
    if (!validateFormNumb()){
        console.log("mensagem de erro do input dos grupos")
        return false;
    } else {
        console.log("inputs estão bem");
        return true;
        //por enquanto so estamos a verifcar este
    }
}

function submitProject(){

    if (verifyallinputs()){

        const data = {
            projName:        $("#projForm input[name='projName']").val(),
            groups_min:      $("#projForm input[name='groups_min']").val(),
            groups_max:      $("#projForm input[name='groups_max']").val(),
            projDescription: $("#projForm input[name='projDescription']").val(),
            file:            $("#projForm input[name='file']").val(),
            listetapas:      etapas,
        }
    
        console.log(data);
    }
}