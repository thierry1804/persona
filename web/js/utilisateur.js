$(document).on('click', '[data-toggle="modal"]', function () {
    let target = $(this).data("target");
    if (target == '#ajouter_user' || target == '#modifier_user') {
        $(target + ' .modal-body').load($(this).data("remote"), function () {
            if (!$('.password').is(':visible')) {
                $('input[type="password"]').removeAttr("required");
            }
        });
    }
});

$(document).on('click', '#ajouter-user', function () {
    $(this).closest('div.modal').find('#ajouter-user-hide').click();
});

$(document).on('click', '#modifier-user', function () {
    $(this).closest('div.modal').find('#modifier-user-hide').click();
});

$(document).on('click', '#modifier-mdp', function () {
    $('.password').toggleClass('d-none');
    if ($('.password').is(':visible')) {
        $('#modifier-mdp').html('Ne pas changer');
        $('input[type="password"]').attr("required", "required");
        $('#edit-mdp').removeClass('dropdown');
        $('#edit-mdp').addClass('dropup');
    } else {
        $('#modifier-mdp').html('Changer mot de passe');
        $('input[type="password"]').removeAttr("required");
        $('#edit-mdp').removeClass('dropup');
        $('#edit-mdp').addClass('dropdown');
    }
});

$(document).on('click', '.changeMdp', function () {
    $('#modifier-mdp').click();
});

$(document).on('click', '#supprimer-user', function () {
    $(this).closest('tbody').find('#supprimer-user-hide').click();
});



