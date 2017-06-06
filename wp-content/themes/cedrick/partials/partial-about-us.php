<?php
if(have_posts()) {
	while(have_posts()) {
		the_post();

		function display_social_media_links() {
			$fields = get_fields();
			if($fields) {
				foreach($fields as $field_url) {
					$field_path      = parse_url($field_url, PHP_URL_PATH);
					$field_domain    = parse_url($field_url, PHP_URL_HOST);
					$field_ltrim     = ltrim($field_domain, "www.");
					$field_rtrim     = rtrim($field_ltrim, ".com");
					$field_name      = ucfirst($field_rtrim);
					$field_username  = trim($field_path, "/");
					$field_label     = "<span class=\"social-media-label\">{$field_name}</span>";
					$field_href      = "<a target=\"_blank\" href=\"{$field_url}\">{$field_username}</a>";
					$field_div       = "<div class=\"social-media-links\">{$field_label}{$field_href}</div>";
					echo $field_div;
				}
			}
		}
		echo "<div class=\"social-media-links-container\">";
		display_social_media_links();
		echo "</div>";
	}
}
?>
