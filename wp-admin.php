<?php
/*
 * Adding Color column to pa_colour taxonomy
 */
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
});
add_filter("manage_edit-pa_colour_columns", function ($columns) {
    $num = 1;
    $new_columns = ['color_img' => 'Color'];
    return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
});
add_filter("manage_pa_colour_custom_column", function ( $string, $column_name, $term_id ) {
    if ($column_name == 'color_img') {
        $color_img = get_field( 'color_img', 'pa_colour_'.$term_id )['sizes']['thumbnail'];
        $string = '<div class="tax-color-img" style="background-image: url('.$color_img.');"></div>';
    }
    return $string;
}, 10, 3);

/*
 * Add notices on post updated
 */
add_action('save_post_events', 'post_event_to_lcrig', 20, 3);
function post_event_to_lcrig( $post_ID, $post, $update ) {
    add_filter( 'redirect_post_location', 'redirect_post_location_lcrig_posted', 90, 2 );
}
function redirect_post_location_lcrig_posted($location, $post_id) {
    return add_query_arg( [ 'use' => 'updated' ], $location );
}
add_action( 'admin_notices', 'admin_notices_event_lcrig' );
function admin_notices_event_lcrig() {
    if (isset($_GET['use']) && in_array($_GET['use'], ['updated', 'created', 'failed']))
        echo '<div id="message" class="notice notice-success is-dismissible"><p>This event was updated on LCRIG</p></div>';
}
