<?php
// add editor-style.css to WYSIWYG Editor
add_editor_style();

function vine_mce4_options($init) {
    $default_colours = '
        "000000", "Black",
        "993300", "Burnt orange",
        "333300", "Dark olive",
        "003300", "Dark green",
        "003366", "Dark azure",
        "000080", "Navy Blue",
        "333399", "Indigo",
        "333333", "Very dark gray",
        "800000", "Maroon",
        "FF6600", "Orange",
        "808000", "Olive",
        "008000", "Green",
        "008080", "Teal",
        "0000FF", "Blue",
        "666699", "Grayish blue",
        "808080", "Gray",
        "FF0000", "Red",
        "FF9900", "Amber",
        "99CC00", "Yellow green",
        "339966", "Sea green",
        "33CCCC", "Turquoise",
        "3366FF", "Royal blue",
        "800080", "Purple",
        "999999", "Medium gray",
        "FF00FF", "Magenta",
        "FFCC00", "Gold",
        "FFFF00", "Yellow",
        "00FF00", "Lime",
        "00FFFF", "Aqua",
        "00CCFF", "Sky blue",
        "993366", "Red violet",
        "FFFFFF", "White",
        "FF99CC", "Pink",
        "FFCC99", "Peach",
        "FFFF99", "Light yellow",
        "CCFFCC", "Pale green",
        "CCFFFF", "Pale cyan",
        "99CCFF", "Light sky blue"
    ';
    $custom_colours = '
        "E4773B", "techinc coral",
    ';

    $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
    $init['textcolor_rows'] = 6;

    return $init;
}
add_filter('tiny_mce_before_init', 'vine_mce4_options');

/*
* Add Formats to TinyMCE
*/
add_filter( 'mce_buttons_2', 'extend_mce_buttons_2' );
function extend_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'tiny_mce_before_init', 'extend_mce_before_init_insert_formats' );
function extend_mce_before_init_insert_formats( $init_array ) {
    $style_formats =[  
        [
            'title' => 'btn-bordered',
            'selector' => 'a',
            'classes' => 'btn btn-join'
        ],
    ];
    $init_array['style_formats'] = wp_json_encode( $style_formats );
    return $init_array;
}
