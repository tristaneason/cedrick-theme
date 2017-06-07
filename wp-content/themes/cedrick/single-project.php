<?php
/**
 * Template Name: Project
 */

get_header();

if(have_posts()) {
	while(have_posts()) {
		the_post();
		$project_title = the_title("", "", false);
		$project_date = the_date("Y", "", "", false);

		$category = get_the_category();
		if(!empty($category)) {
	    $project_category = esc_html($category[0]->name);
		}

		$tags = wp_get_post_tags($post->ID);
		$tags_to_implode = array();
		foreach($tags as $object => $tag) {
			$tag_span = "<span class=\"project-tag\">$tag->name</span>";
			array_push($tags_to_implode, $tag_span);
		}
		$tags_list = implode(", ", $tags_to_implode);


	}
} ?>

	<div class="project-banner-container">
	</div>

	<div class="project-header-container">
		<h1 class="project-title"><?php echo $project_title; ?></h1>
		<h2><?php echo $project_category; ?></h2>
	</div>

	<div class="project-meta-info">
		<div class="project-year">
			<h3 class="title">Year</h3>
			<span class="entry year"><?php echo $project_date; ?></span>
		</div>
		<div class="project-role">
			<h3 class="title">Role</h3>
			<span class="entry role"><?php  ?></span>
		</div>
		<div class="project-tags">
			<h3 class="title">Hashtags</h3>
			<span class="entry hashtags"><?php echo $tags_list; ?></span>
		</div>
	</div>

<?php
get_footer();

?>
