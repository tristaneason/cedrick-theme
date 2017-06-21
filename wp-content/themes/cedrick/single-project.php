<?php
/**
 * Template Name: Project
 */

get_header();
$show_wysiwyg_content = true;

if(have_posts()) {
	while(have_posts()) {
		the_post();
		// Create DOM elements for project title and year
		$project_title = the_title("<h1 class=\"project-title\">", "</h1>", false);
		$project_date = the_date("Y", "<span class=\"project-meta-entry year\">", "</span>", false);

		// Create DOM elements for project category
		$category = get_the_category();
		if(!empty($category)) {
	    $project_category = "<h2 class=\"project-category\">" . esc_html($category[0]->name) . "</h2>";
		}

		// Create DOM elements for project hashtag(s)
		$tags = wp_get_post_tags($post->ID);
		$tags_to_implode = array();
		foreach($tags as $object => $tag) {
			$tag_span = "<span class=\"project-meta-entry project-tag\">$tag->name</span>";
			array_push($tags_to_implode, $tag_span);
		}
		$project_tag_list = implode(", ", $tags_to_implode);

		// Create DOM elements for project role(s)
		$roles_object = get_field("project_role");
		$roles_to_implode = array();
		foreach($roles_object as $roles => $role) {
			$role_span = "<span class=\"project-meta-entry role\">$role->name</span>";
			array_push($roles_to_implode, $role_span);
		}
		$project_role_list = implode(", ", $roles_to_implode);

		// Display header background images
		$images_to_implode = array();
		for($i = 1; $i <=3; $i++) {
			$project_banner_img_field = get_field("project_banner_image_$i");
			$project_banner_img_field ? $project_banner_img_url = $project_banner_img_field["url"] : null;
			$project_banner_img_field ? $project_banner_img_alt = $project_banner_img_field["alt"] : null;
			$project_banner_img  = "<div class=\"project-banner-image\" style=\"background: url('$project_banner_img_url')\">";
			$project_banner_img .= "<img class=\"project-banner-image-$i\" src=\"$project_banner_img_url\" style=\"height: 0; width: 0\" alt=\"$project_banner_img_alt\">";
			$project_banner_img .= "</div>";
			array_push($images_to_implode, $project_banner_img);
		}
		$project_banner_images = implode("", $images_to_implode);

		// Display top background image
		$project_bg_img_top_field = get_field("project_background_image_top");
		$project_bg_img_top_url = $project_bg_img_top_field['url'];
		$project_bg_img_top_alt = $project_bg_img_top_field['alt'];

		// Display lower backgorund image
		$project_bg_img_lower_field = get_field("project_background_image_lower");
		$project_bg_img_lower_url = $project_bg_img_lower_field['url'];
		$project_bg_img_lower_alt = $project_bg_img_lower_field['alt'];
	} // while
} ?>

<section class="project-section">
	<div class="project-banner-container">
		<?php echo $project_banner_images; ?>
	</div>

	<div class="project-header-container">
		<?php echo $project_title; ?>
		<?php echo $project_category; ?>
	</div>

	<div class="project-meta-info">
		<div class="project-meta-item project-year">
			<h3 class="project-meta-title">Year</h3>
			<?php echo $project_date; ?>
		</div>
		<div class="project-meta-item project-role">
			<h3 class="project-meta-title">Role</h3>
			<?php echo $project_role_list; ?></span>
		</div>
		<div class="project-meta-item project-tags">
			<h3 class="project-meta-title">Hashtags</h3>
			<?php echo $project_tag_list; ?>
		</div>
	</div>

	<div class="project-summary-container">
		<div class="project-summary">
			<?php $show_wysiwyg_content ? the_content() : null; ?>
		</div>
	</div>

	<div class="project-screenshots-1">
		<div class="project-background-image-top" style="background: url('<?php echo $project_bg_img_top_url; ?>')">
			<?php
			if(have_rows("project_screenshots_set_1")) {
				while(have_rows("project_screenshots_set_1")) {
					the_row();
					$project_screenshot_field_1 = get_sub_field("project_screenshot_1");
					$project_screenshot_url_1 = $project_screenshot_field_1["url"];
					$project_screenshot_alt_1 = $project_screenshot_field_1["alt"];
					echo "<img src=\"$project_screenshot_url_1\" class=\"project-screenshot\" alt=\"$project_screenshot_alt_1\">";
				}
			}
			?>
		</div>
	</div>

	<div class="project-screenshots-2">
		<img src="<?php echo $project_bg_img_lower_url; ?>" class="project-background-image-lower" alt="<?php echo $project_bg_img_lower_alt; ?>">
		<?php
		if(have_rows("project_screenshots_set_2")) {
			while(have_rows("project_screenshots_set_2")) {
				the_row();
				$project_screenshot_field_2 = get_sub_field("project_screenshot_2");
				$project_screenshot_url_2 = $project_screenshot_field_2["url"];
				$project_screenshot_alt_2 = $project_screenshot_field_2["alt"];
				echo "<img src=\"$project_screenshot_url_2\" class=\"project-screenshot\" alt=\"$project_screenshot_alt_2\">";
			}
		}
		?>
	</div>
</section>

<?php
get_footer("project");
?>
