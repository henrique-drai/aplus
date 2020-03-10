$(document).ready(() => {

    var etapanum = $('.etapa').length;

    $('body').on('click', '#addEtapa', function(e) {
        etapanum++;
        var etapa = '<p class="etapa">' +
             '<label class="form-label">Nome</label> ' +
             '<input class="form-input-text" type="text" name="etapaName'+etapanum+'"> ' +
             '<label class="form-label">Descrição</label> ' + 
             '<input class="form-input-text" type="text" name="etapaDescription'+etapanum+'"> ' +
             '<label class="form-label">Data de entrega</label> ' + 
             '<input class="form-input-text" type="date" name="etapaDate'+etapanum+'"> ' +
             '<label id="removeEtapa"> X </label> ' +
             '</p> '

        $('.etapa').last().after(etapa);        
    })

    $('body').on('click', '#removeEtapa', function(e) {
        $(this).parent().remove();
    })
})