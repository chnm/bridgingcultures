jQuery(document).ready(function() {

    var excludedTypes = [
        'Moving Image',
        'Oral History',
        'Sound',
        'Event',
        'Email',
        'Hyperlink',
        'Person',
        'Interactive Resource',
        'Text',
        'Theme Icon'
    ];

    if (jQuery('#item-type-search').length > 0) {
        jQuery('#item-type-search option').each(function() {
            if (jQuery.inArray(jQuery(this).html(), excludedTypes) == -1) {
            } else {
                jQuery(this).remove();
            }
        });
    }
    
    
});