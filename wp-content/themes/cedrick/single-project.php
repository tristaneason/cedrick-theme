<?php
/**
 * Template Name: Project
 */

get_header();

if(have_posts()) {
	while(have_posts()) {
		the_post();
		the_title();
		the_date("Y");
		$tags = wp_get_post_tags($post->ID);
		foreach($tags as $object => $tag) {
			$tag_name = $tag->name . ", ";
			echo $tag_name;
		}
	}
}

get_footer();

?>
