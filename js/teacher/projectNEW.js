
const etapas = [{id:1, nome:'', desc:'', enunciado:'', data:''}];
var subject_id
var project_page

$(document).ready(() => {

    const picker = new WindowDatePicker({
        el: '#placeholder-picker1',
        toggleEl: '#datepicker1',
        inputEl: '#datepicker1',
        type: 'DATEHOUR',
        hourType: "24",
        allowEmpty: "FALSE",
        lang: "pt",
        orientation: true,
    });




    $("#projForm")[0].reset(); //se voltarem para a pagina depois de preenchido o form a info desaparece

    //definir um numero que nunca se repita para id de cada etapa
    var etapanum = $('.etapa').length;

    $('body').on('click', '#addEtapa', function(e) {
        etapanum++;
        var pid = 'etapa'+etapanum;

        const etapa = '<div id='+pid+' class="etapa">' +
             '<label id="etapa-label" class="form-label-title"> </label>' +
             '<label id="removeEtapa" class="labelRemove"><img src="'+base_url+'/images/close.png"></label> ' +
             '<div id="inputsduo">' +
             '<label class="form-label">Nome'+
             '<input class="form-input-text" type="text" name="etapaName" required></label>'+
             '<label class="form-label" id="date-picker-label">Data de entrega' +
             '<input class="form-input-text" id="datepicker'+ etapanum +'" name="etapaDate" autocomplete="off" readonly="readonly" required>' +
             '<div id="placeholder-picker'+etapanum+'"></div>' +
             '</label>' +
             '</div> ' + 
             '<label class="form-label">Descrição</label>' +
             '<textarea class="form-text-area" type="text" name="etapaDescription" required></textarea>' + 
             '</div> '
        
        etapas.push({id:etapanum, nome:'', desc:'', enunc:'', data:''});
        console.log(etapas);

        $('.etapa').last().after(etapa);     
        $('.etapa').last().change(function(){
            var name = escapeHtml($(this).find('input[name="etapaName"]').val());
            var desc = escapeHtml($(this).find('textarea[name="etapaDescription"]').val());
            var data = escapeHtml($(this).find('input[name="etapaDate"]').val());
            var enunc = '';
            var newid = parseInt(pid.replace("etapa",""));

            insertIntoEtapas(newid, name, desc, enunc, data);
        })


        const newpicker = new WindowDatePicker({
            el: '#placeholder-picker' + etapanum,
            toggleEl: '#datepicker' + etapanum,
            inputEl: '#datepicker' + etapanum,
            type: 'DATEHOUR',
            hourType: "24",
            allowEmpty: "FALSE",
            lang: "pt",
            orientation: true,
        });
    


        newpicker.el.addEventListener('wdp.change', () => {

            var newid = parseInt(pid.replace("etapa",""));
            var data = dateFromPicker($("#datepicker" + newid).val());

            console.log("footer-dpicknew"+newid)
            if(!$("#footer-dpicknew"+newid).length){
                console.log("footer-dpicknew"+newid)
                $("#placeholder-picker" + newid + " .wdp-container").append("<div id='footer-dpicknew"+newid+"' class='datepickerfooter'><input id='hidedatepicker' type='button' value='Confirmar'></div>");
            }
  
            if (!verifyDates(data))
                $("#datepicker" + newid).css("border-left-color", "red");
            else
                $("#datepicker" + newid).css("border-left-color", "lawngreen");

            console.log(newid);

            var name = etapas[newid-1].nome;
            var desc = etapas[newid-1].desc;
            var datains = $("#datepicker" + newid).val();
            var enunc = '';


            insertIntoEtapas(newid, name, desc, enunc, datains);
        });

        $("body").on("click", "#hidedatepicker", function(){
            newpicker.close();
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
        var name = escapeHtml($(this).find('input[name="etapaName"]').val());
        var desc = escapeHtml($(this).find('textarea[name="etapaDescription"]').val());
        var data = escapeHtml($(this).find('input[name="etapaDate"]').val());
        var enunc = '';

        
        insertIntoEtapas(1, name, desc, enunc, data);
    });

    
    picker.el.addEventListener('wdp.change', () => {
        var data = dateFromPicker($("#datepicker1").val());

        if(!$("#footer-dpicker").length){
            $("#placeholder-picker1 .wdp-container").append("<div id='footer-dpicker' class='datepickerfooter'><input id='hidedatepicker' type='button' value='Confirmar'></div>");
        }

        if (!verifyDates(data))
            $("#datepicker1").css("border-left-color", "red");
        else
            $("#datepicker1").css("border-left-color", "lawngreen");

    
        var name = etapas[0].nome;
        var desc = etapas[0].desc;
        var datains = $("#datepicker1").val();
        var enunc = '';


        insertIntoEtapas(1, name, desc, enunc, datains);
    });

    $("body").on("click", "#hidedatepicker", function(){
        picker.close();
    })

    $("#maxnuminput").keyup(function(){
        validateFormNumb();
    })

    $("#minnuminput").keyup(function(){
        validateFormNumb();
    })

    $("#createProjectButton").click(() => submitProject());

    // ESCONDER POPUP AO CLICAR
    $("body").on("click", "#closeError", function(){
        $("#errormsg").fadeTo(2000, 0);
    })

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


function insertIntoEtapas(id, name, desc, enunc, data){

    newDate = dateFromPicker(data);

    console.log(id + " " + name +" " + desc + " " + enunc + " " + newDate);
    for (i=0; i<etapas.length; i++){
        if(etapas[i].id == id){
            etapas[i].nome = name;
            etapas[i].desc = desc;
            etapas[i].data = newDate;
            etapas[i].enunciado = enunc;
        }
    }

    console.log(etapas);

    if (!verifyDates(newDate))
        $("#datepicker" + id).css("border-left-color", "red");
    else
        $("#datepicker" + id).css("border-left-color", "lawngreen");
}


function validateFormNumb(){

    if($("#minnuminput").val() < 0){
        $("#errormsg").text("Insira números válidos");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        $("#minnuminput").css("border-left-color", "red");
        return false;
    } else if ($("#maxnuminput").val() < 0){
        $("#errormsg").text("Insira números válidos");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        $("#maxnuminput").css("border-left-color", "red");
        return false;
    } else if($("#minnuminput").val() != '' && $("#maxnuminput").val() != ''){
        if(parseInt($("#minnuminput").val()) >= parseInt($("#maxnuminput").val())){
            $("#errormsg").text("Número minimo deve ser menor que máximo");
            $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
            $("#minnuminput").css("border-left-color", "red");
            $("#maxnuminput").css("border-left-color", "red");
            return false;
        } else {
            $("#minnuminput").css("border-left-color", "lawngreen");
            $("#maxnuminput").css("border-left-color", "lawngreen");
            return true;
        }
    }

    if($("#minnuminput").val() == ''){
        $("#errormsg").text("Preencha todos os parametros");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        $("#minnuminput").css("border-left-color", "red");
        return false;
    }

    if($("#maxnuminput").val() == ''){
        $("#errormsg").text("Preencha todos os parametros");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        $("#maxnuminput").css("border-left-color", "red");
        return false;
    }

}


function verifyDates(data){
    // var dmaior = new Date(data);
    var dmaior = new Date(data);
    
    console.log(dmaior);

    var today = new Date();

    var dParse = Date.parse(dmaior);

    if (isNaN(dParse)){ 
        return false;
    }

    if (dmaior <= today){
        return false;
    }

    return true;
}


function validateAllDates(){
    for (i=0; i<etapas.length; i++){
        if (!verifyDates(etapas[i].data)){
            console.log(etapas[i].data);
            return false;
        }
    }

    return true;
}

function validate_descriptions(){
    if($("textarea[name='projDescription']").val() == ''){
        $("#errormsg").text("Preencha a descrição do projeto");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        return false;
    } else if($("textarea[name='etapaDescription']").val() == ''){
        $("#errormsg").text("Preencha a descrição da etapa");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        return false;
    }

    return true;
}

function verifyallinputs(){
    if (!validateFormNumb()){
        $("#errormsg").show();
        return false;
    } else if (!validateAllDates()){
        $("#errormsg").text("A data de cada etapa tem de ser maior que a data atual");
        $("#errormsg").append('<i id="closeError" class="fa fa-times" aria-hidden="true"></i>');
        $("#errormsg").show();
        return false;
    } else if (!validate_descriptions()){
        $("#errormsg").show();
        return false;
    }

    return true;
}

function submitProject(){

    if (verifyallinputs()){

        const data = {
            projName:        escapeHtml($("#projForm input[name='projName']").val()),
            groups_min:      escapeHtml($("#projForm input[name='groups_min']").val()),
            groups_max:      escapeHtml($("#projForm input[name='groups_max']").val()),
            projDescription: escapeHtml($("#projForm textarea[name='projDescription']").val()),
            file:            '',
            cadeira_id:      subject_id,
            listetapas:      etapas,
        }

        //pedido ajax para o CI
        $.ajax({
            type: "POST",
            url: base_url + "api/createProject",
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