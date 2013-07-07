/**
 * Récupère un tableau de string depuis la source [=source].
 * Active la fonction typeahead du Twitter bootstrap sur la cible [=target].
 *
 * @param source
 * @param target
 *
 * @see http://tatiyants.com/how-to-use-json-objects-with-twitter-bootstrap-typeahead/
 */
function autosuggest(source, target) {
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