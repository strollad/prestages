$("#prestation_client").on('click', function(){
    if ($(this).val() == 'addClient') {
        $('#modalAddClient').modal('show');
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: Routing.generate('client_ajouter'),
            async: false
        })
            .done(function(response){
                $("#modalAddClient .modal-body").html(response.html);
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                alert('Error : ' + errorThrown);
            });
    }
});

$("#saveNewClient").on('click', function() {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: Routing.generate('client_ajouter'),
        data: $("form[name=client]").serialize(),
        async: false
    })
        .done(function(response){
            if (response.created) {
                $("#modalAddClient").modal('hide');
                $("#prestation_client optgroup[label=Existants]").append($('<option></option>').val(response.id).html(response.organisation));
                $("#prestation_client").val(response.id);
            } else {
                $("#modalAddClient .modal-body").html(response.html);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            alert('Error : ' + errorThrown);
        });
});

$(".show-prestation").on('click', function() {
    window.location = Routing.generate('prestation_voir', {'id': $(this).attr('data-prestation')});
});
$(".show-client").on('click', function() {
    window.location = Routing.generate('client_voir', {'id': $(this).attr('data-client')});
});
$(".show-utilisateur").on('click', function() {
    window.location = Routing.generate('utilisateur_voir', {'id': $(this).attr('data-utilisateur')});
});
