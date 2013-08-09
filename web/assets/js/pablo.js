/**
 * Récupère un tableau de string depuis la source [=source].
 * Active la fonction typeahead du Twitter bootstrap sur la cible [=target].
 *
 * @param source
 * @param target
 *
 * @see http://tatiyants.com/how-to-use-json-objects-with-twitter-bootstrap-typeahead/
 */
function autocompletion(source, target) {
    $.getJSON(source, function(data) {
        var items = [];

        $.each(data, function(key, value) {
            items.push(value)
        });

        $(target).typeahead({
            source: items
        });
    });
}

/**
 * Affiche un calendrier après un click sur la cible [=target].
 *
 * @param target
 */
function calendrier(target) {
    $(target).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:-5",
        minDate: new Date(new Date().getFullYear() - 100, 0, 0),
        maxDate: new Date(new Date().getFullYear() - 5, 0, 31)
    });
}

/**
 * Affiche une boite de dialogue modale après un click sur la source [=source]
 * pour demander une confirmation avant la suppression de données.
 *
 * @param source
 */
function confirmation (source) {
    $(source).click(function(event) {
        event.preventDefault();

        $('.modal').modal('show');

        var url = source.attr('href');
        console.log(url);
        $('div.modal-footer button.btn-primary').click(function() {
            $(location).attr('href', url);
        })
    });
}

/**
 * Affiche l'onglet dont l'id est inclus dans l'url sous la forme de hash [=#...]
 * Sinon affiche l'onglet par défaut dont le hash est passé en paramètre.
 *
 * @param defaultHash
 */
function onglets(defaultHash) {
    if ($(location).attr('hash')) {
        $('.nav-tabs a[href="' + $(location).attr('hash') + '"]').tab('show');
    } else {
        $('.nav-tabs a[href="' + defaultHash + '"]').tab('show');
    }
}