$('body').on('click', '#ajouterCasTestBtn', function (e) {
    e.preventDefault();
    $(this).closest('div.modal').find('form').submit();
});

$('body').on('click', '#supprimerCasTestBtn', function (e) {
    e.preventDefault();
    window.location.assign($(this).attr('href').replace(/(%23)+/g, $("input[name=id]").val()));
});

$('body').on('submit', 'form', function (e) {
    var notFilled = $(this).find('[required]').map(function() {
        if ($(this).val() === '') {
            return 1;
        }
    }).get();
    if (notFilled.length) {
        e.preventDefault();
    }
});

$('#ajouterCasTest').on('hidden.bs.modal', function (e) {
    $(this).find('.modal-body').html('<i class="fas fa-sync fa-spin"></i> Chargement en cours ...');
});

$('#modifierCasTest').on('hidden.bs.modal', function (e) {
    $(this).find('.modal-body').html('<i class="fas fa-sync fa-spin"></i> Chargement en cours ...');
    $(this).find('#modifierCasTestLabel').html('Modifier le cas de test <strong>###</strong>');
});