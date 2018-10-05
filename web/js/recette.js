$('body').on('click', '#enregistrerRecetteBtn', function (e) {
    $(this).closest('div.modal').find('form').submit();
});

$('#recetter').on('hidden.bs.modal', function (e) {
    $(this).find('.modal-body').html('<i class="fas fa-sync fa-spin"></i> Chargement en cours ...');
    $(this).find('#recetterLabel').html('Recette fonctionnelle <strong>###</strong>');
});