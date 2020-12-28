<?php
/*
 * Adding Color column to pa_colour taxonomy
 */
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
});
add_filter("manage_edit-pa_colour_columns", function ($columns) {
    $num = 1;
    $new_columns = Array( 'color_img' => 'Color' );
    return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
});
add_filter("manage_pa_colour_custom_column", function ( $string, $column_name, $term_id ) {
    if ($column_name == 'color_img') {
        $color_img = get_field( 'color_img', 'pa_colour_'.$term_id )['sizes']['thumbnail'];
        $string = '<div class="tax-color-img" style="background-image: url('.$color_img.');"></div>';
    }
    return $string;
}, 10, 3);
