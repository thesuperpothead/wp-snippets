/*
* Render Image HTML Tag by ID if image not attached to post
*/
function render_image($id, $size='full', $alt='', $title='', $extraclass='' ) {
	$align = '';
	if ($extraclass) {
		global $image_extraclass; $image_extraclass = $extraclass;
		add_filter( 'get_image_tag_class', 'set_image_tag_extra_class', 20 );
	}
	echo get_image_tag( $id, $alt, $title, $align, $size );
	if ($extraclass)
		remove_filter( 'get_image_tag_class', 'set_image_tag_extra_class', 20 );
}
function set_image_tag_extra_class($class) {
	global $image_extraclass;
	return $class.' '.$image_extraclass;
}
