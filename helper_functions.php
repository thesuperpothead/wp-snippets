<?php
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

/*
* Get YouTube or Vimeo video poster
*/
function get_video_poster($post_obj) {
	$poster = get_field( 'poster', $post_obj->ID );
	if (!empty($poster))
		return $poster['sizes']['medium_large'];
	else {
		$type = get_field( 'type', $post_obj->ID );
		if ($type == 'youtube') {
			return 'https://i.ytimg.com/vi/'.get_field( 'youtube_video_id', $post_obj->ID ).'/hqdefault.jpg';
		} elseif ($type == 'vimeo') {
			$imgid = get_field( 'vimeo_video_id', $post_obj->ID );
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			return $hash[0]['thumbnail_medium'];
		}
	}
	return get_template_directory_uri().'/assets/images/tcy_vdo.png';
}

/*
 * Send message to my telegram
 */
function send_message_to_telegram($text) {
	$token = "1038159654:AAEjdpyA3RqLznzt8wbwauKS0ha0ccM2i-E";
	$chat_id = "-398790792";
	$data = [
		'text' => $text,
		'chat_id' => $chat_id
	];
	$sendToTelegram = file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
	//$sendToTelegram = file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
}
