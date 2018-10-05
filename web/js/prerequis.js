var $collectionHolder;

// setup an "add a tag" link
if (!$('[readonly=readonly]').length) {
    var $addTagButton = $('<button type="button" class="btn btn-sm add_tag_link">Ajouter un prérequis</button>');
    var $newLinkLi = $('<li class="list-group-item p-1"></li>').append($addTagButton);
    
    jQuery(document).ready(function() {
        // Get the ul that holds the collection of tags
        $collectionHolder = $('ul.prerequis');

        // add the "add a tag" anchor and li to the tags ul
        $collectionHolder.append($newLinkLi);

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        $collectionHolder.data('index', $collectionHolder.find(':input').length);

        $addTagButton.on('click', function(e) {
            $(this).blur();
            // add a new tag form (see next code block)
            addTagForm($collectionHolder, $newLinkLi);
        });
    });

    function addTagForm($collectionHolder, $newLinkLi) {
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

        var newForm1 = newForm.match(/<input[^>].*\/>/g);
        newForm = '<div class="input-group">' + newForm1[0] + '<div class="input-group-append"><button type="button" class="btn btn-danger btn-sm remove-prerequis">&times;</button></div></div>';

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li class="list-group-item p-1"></li>').append(newForm);
        $newLinkLi.before($newFormLi);
        // add a delete link to the new form
        addTagFormDeleteLink();
    }

    function addTagFormDeleteLink() {
        $('button.remove-prerequis').off('click').on('click', function(e) {
            // remove the li for the tag form
            $(this).closest('li').remove();
        });
    }

    addTagFormDeleteLink();
}