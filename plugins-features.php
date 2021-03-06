<?php
/*
* Adding new template within plugin folder
*/
add_filter( 'page_template', function( $page_template ){
	if ( get_page_template_slug() == 'ss88-syrup-subscription.php' ) {
		$page_template = dirname( __FILE__ ) . '/templates/syrup-subscription.php';
	}
	return $page_template;
}) ;

add_filter( 'theme_page_templates', function( $post_templates, $wp_theme, $post, $post_type ) {
	$post_templates['ss88-syrup-subscription.php'] = __('Syrup Subscription');
	return $post_templates;
}, 10, 4 );

