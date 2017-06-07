<?php
/**
 * Template Name: About
 */

get_header();

if(have_posts()) {
	while(have_posts()) {
		the_post();
		the_content();
		display_social_media_links();
	}
}

get_footer();

?>
