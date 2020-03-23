const etapas = [{id:1, nome:'', desc:'', data:''}];
var subject_id
var project_page

$(document).ready(() => {

    //definir um numero que nunca se repita para id de cada etapa
    var etapanum = $('.etapa').length;

    $('body').on('click', '#addEtapa', function(e) {
        etapanum++;
        var pid = 'etapa'+etapanum;

        const etapa = '<p id='+pid+' class="etapa">' +
             '<label id="etapa-label" class="form-label-title"> </label>' +
             '<label class="form-label">Nome</label> ' +
             '<input class="form-input-text" type="text" name="etapaName" required> ' +
             '<label class="form-label">Descrição</label> ' + 
             '<textarea class="form-text-area" type="text" name="etapaDescription" required></textarea> ' + 
             '<label class="form-label">Data de entrega</label> ' + 
             '<input class="form-input-text" type="datetime-local" name="etapaDate" required> ' +
             '<label id="removeEtapa"><img src="'+base_url+'/images/close.png"></label> ' +
             '</p> '
        
        etapas.push({id:etapanum, nome:'', desc:'', data:''});
        console.log(etapas);

        $('.etapa').last().after(etapa);     
        $('.etapa').last().change(function(){
            var name = $(this).find('input[name="etapaName"]').val();
            var desc = $(this).find('textarea[name="etapaDescription"]').val();
            var data = $(this).find('input[name="etapaDate"]').val();

            var newid = parseInt(pid.replace("etapa",""));

            insertIntoEtapas(newid, name, desc, data);
        })


        refreshEtapasTitle();

    })

    $('body').on('click', '#removeEtapa', function(e) {
        var strid = $(this).parent().attr("id");
        var id = parseInt(strid.replace("etapa",""));

        for (i=0; i<etapas.length; i++){
            if(etapas[i].id == id){
                etapas.splice(i,1);
            }
        }

        console.log(etapas);
        
        $(this).parent().remove();

        refreshEtapasTitle();
    }) 



    $("#etapa1").change(function(){
        var name = $(this).find('input[name="etapaName"]').val();
        var desc = $(this).find('textarea[name="etapaDescription"]').val();
        var data = $(this).find('input[name="etapaDate"]').val();
        insertIntoEtapas(1, name, desc, data);
    })

    $("#maxnuminput").keyup(function(){
        validateFormNumb();
    })

    $("#minnuminput").keyup(function(){
        validateFormNumb();
    })

    $("#createProjectButton").click(() => submitProject());

})


function setSubjectID(id){
    subject_id = id;
}

function setProjectPage(url){
    project_page = url;
}

function refreshEtapasTitle(){
    $('.etapa').each(function(index){
        var trueindex = index+1;
        $(this).find("#etapa-label").text('Etapa '+trueindex);
    })
}


function insertIntoEtapas(id, name, desc, data){
    console.log(id + " " + name +" " + desc + " " + data);
    for (i=0; i<etapas.length; i++){
        if(etapas[i].id == id){
            etapas[i].nome = name;
            etapas[i].desc = desc;
            etapas[i].data = data;
        }
    }

    console.log(etapas);

    if (!verifyDates(data))
        $("#etapa"+id+" input[name='etapaDate']").css("border-left-color", "salmon");
    else
        $("#etapa"+id+" input[name='etapaDate']").css("border-left-color", "palegreen");
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


function verifyDates(data){
    var dmaior = new Date(data);
    var today = new Date();

    var dParse = Date.parse(dmaior);

    if (isNaN(dParse)){
        return false;
    }

    if (dmaior < today){
        return false;
    }

    return true;
}


function validateAllDates(){
    for (i=0; i<etapas.length; i++){
        if (!verifyDates(etapas[i].data)){
            return false;
        }
    }

    return true;
}

function verifyallinputs(){
    if (!validateFormNumb()){
        $("#errormsg").text("O número máximo de alunos por grupo tem de ser maior que o mínimo");
        $("#errormsg").show().delay(5000).fadeOut();
        return false;
    } else if (!validateAllDates()) {
        $("#errormsg").text("A data de cada etapa tem de ser maior que a data atual");
        $("#errormsg").show().delay(5000).fadeOut();
        return false;
    } else {
        return true;
    }
}

function submitProject(){

    if (verifyallinputs()){

        const data = {
            projName:        $("#projForm input[name='projName']").val(),
            groups_min:      $("#projForm input[name='groups_min']").val(),
            groups_max:      $("#projForm input[name='groups_max']").val(),
            projDescription: $("#projForm textarea[name='projDescription']").val(),
            file:            $("#projForm input[name='file']").val(),
            cadeira_id:      subject_id,
            listetapas:      etapas,
        }

        //pedido ajax para o CI

        // console.log(data);

        $.ajax({
            type: "POST",
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "teacher/api/createProject",
            data: data,
            success: function(data) {
                console.log(data);
                var newpage = project_page + data.toString();
                window.location.assign(newpage);

            },
            error: function(data) {
                console.log("Erro na API:")
                console.log(data)
            }
        });
    

    }
}