if ($("#prestation_client").length) {
    parent = $("#prestation_client").parent();
    parent.removeClass('col-sm-10');
    parent.addClass('col-sm-9');
    grandparent = parent.parent();
    grandparent.append($("<div></div>").addClass('col-sm-1').html('<button id="clientAdd" type="button" class="btn btn-default btn-xs" aria-label="Ajout client" data-toggle="modal" data-target="#modalAddClient"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>'));
}

$("#clientAdd").on('click', function() {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: Routing.generate('strollad_prestages_client_add'),
        async: false
    })
    .done(function(response){
        $("#modalAddClient .modal-body").html(response.html);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert('Error : ' + errorThrown);
    });
});

$("#saveNewClient").on('click', function() {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: Routing.generate('strollad_prestages_client_add'),
        data: $("form[name=client]").serialize(),
        async: false
    })
    .done(function(response){
        created = response.created;
        if (created) {
            $("#modalAddClient").modal('hide');
        } else {
            $("#modalAddClient .modal-body").html(response.html);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert('Error : ' + errorThrown);
    });
});