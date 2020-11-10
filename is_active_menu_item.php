<?php
function is_active_menu_item($url) {
	$ID = get_the_ID();
	$url_ID = url_to_postid($url);
	if ($url_ID && $url_ID == $ID)
		return 'active';
	else {
		if (is_home() || is_singular('post')) { // if blog page or blog post
			$page_for_posts = get_option( 'page_for_posts' );
			$page_for_posts_url = get_the_permalink( $page_for_posts );
			$page_for_posts_url = untrailingslashit(str_replace(['https://', 'http://'], '', $page_for_posts_url));
			$url = untrailingslashit(str_replace(['https://', 'http://'], '', $url));
			if ($page_for_posts_url == $url)
				return 'active';
		}
	}
	return '';
}
