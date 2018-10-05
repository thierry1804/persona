$('body').on('click', '[data-toggle="modal"]', function () {
    let target = $(this).data("target");
    let lectureSeule = (parseInt($(this).data('lecture-seule')) === 1);
    switch (target) {
        case '#recetter':
            $(target + 'Label strong').html($.trim($(this).text()));
            $(target + ' .modal-footer .btn').removeClass("d-none");
            $(target + ' .modal-footer .btn:first').addClass("d-none");
            if (lectureSeule) {
                $(target + ' .modal-footer .btn').addClass("d-none");
                $(target + ' .modal-footer .btn:first').removeClass("d-none");
            }
            break;
        case '#modifierCasTest':
            $(target + ' .modal-footer #supprimerCasTestBtn').addClass("d-none");
            break;
    }
    $(target + ' .modal-body').load($(this).data("remote"), function() {
        switch (target) {
            case '#modifierCasTest':
                $(target + 'Label strong').html($('#appbundle_castest_numero').val() + ' - ' + $('#appbundle_castest_titre').val());
                if ($('#appbundle_castest_numero[readonly]').length === 0) {
                    $(target + ' .modal-footer #supprimerCasTestBtn').removeClass("d-none");
                }
                break;
            case '#recetter':
                if (lectureSeule) {
                    $(target + ' input').prop('disabled', true);
                    $(target + ' input').attr('disabled', 'disabled');
                }
                break;
        }
    });
});
$('body').on('click', '#enregistrerProjet', function () {
    $("#ajouterProjet form").submit();
});