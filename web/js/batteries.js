if (!$('[readonly=readonly]').length) {
    var $collectionHolderB;

    // setup an "add a tag" link
    var $addTagButtonB = $('<button type="button" class="btn btn-sm add_tag_link">Ajouter une batterie de test</button>');
    var $newLinkLiB = $('<li class="list-group-item p-1"></li>').append($addTagButtonB);

    jQuery(document).ready(function() {
        // Get the ul that holds the collection of tags
        $collectionHolderB = $('ul.batteries');

        // add the "add a tag" anchor and li to the tags ul
        $collectionHolderB.append($newLinkLiB);

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        $collectionHolderB.data('index', $collectionHolderB.find(':input').length);

        $addTagButtonB.on('click', function(e) {
            $(this).blur();
            // add a new tag form (see next code block)
            addTagFormB($collectionHolderB, $newLinkLiB);
        });
    });

    function addTagFormB($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        var newForm2 = newForm.match(/<textarea[^>]*>[^<]*<\/textarea>/g);
        newForm = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">#' + index + '</span></div>' + newForm2[0] + newForm2[1] + '<div class="input-group-append"><button type="button" class="btn btn-danger btn-sm remove-batterie">&times;</button></div></div>';

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li class="list-group-item p-1"></li>').append(newForm);
        $newLinkLi.before($newFormLi);
        // add a delete link to the new form
        addTagFormDeleteLinkB();
        numeroter();
    }

    function addTagFormDeleteLinkB() {
        $('button.remove-batterie').off('click').on('click', function(e) {
            // remove the li for the tag form
            $(this).closest('li').remove();
            numeroter();
        });
    }

    var numeroter = function() {
        $('span.input-group-text:visible').map(function(i) {
            $(this).text("#" + (i + 1));
        });
    };

    addTagFormDeleteLinkB();
}