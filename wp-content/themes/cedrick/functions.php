<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

if(!isset($content_width)) {
	$content_width = 900;
}

if(function_exists('add_theme_support')) {
	// Add Menu Support
	add_theme_support('menus');

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('large', 1440, '', true); // Large Thumbnail
	add_image_size('medium', 900, '', true); // Medium Thumbnail
	add_image_size('small', 400, '', true); // Small Thumbnail

	// Enables post and comment RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Localisation Support
	load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

// HTML5 Blank navigation
function html5blank_nav() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function cedrick_enqueue_scripts() {
	wp_enqueue_style('style-name', get_template_directory_uri() . '/css/site.css');
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts-min.js', array(), 1, true);
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
	register_nav_menus(array( // Using array to specify more menus if needed
		'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
		'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
		'blog-cat-menu' => __('Blog Category Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
	return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
	global $post;
	if(is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	}
	elseif(is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}
	return $classes;
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'prev_text' => 'Newer Posts',
		'next_text' => 'Older Posts'
	));
}

// Custom Excerpts
// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
function html5wp_index($length) {
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
	global $post;
	if(function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if(function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = "<p>{$output}</p>";
	echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
	return false;
}

// Shorten Post Titles in blog feed
function ShortenText($text) { // Function name ShortenText
  $chars_limit = 30; // Character length
  $chars_text = strlen($text);
  $text = "{$text} ";
  $text = substr($text,0,$chars_limit);
  $text = substr($text,0,strrpos($text,' '));

  if($chars_text > $chars_limit) {
		$text = "{$text}...";
	} // Ellipsis
	 return $text;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}

// Fix Blog saying its the current menu item for custom post type posts...
function is_blog() {
	global $post;
	$posttype = get_post_type($post);
	return (($posttype == 'post') && (is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author())) ? true : false;
}

function fix_blog_link_on_cpt($classes, $item, $args) {
	if(!is_blog()) {
		$blog_page_id = intval(get_option('page_for_posts'));
		if($blog_page_id != 0 && $item->object_id == $blog_page_id) {
			unset($classes[
				array_search('current_page_parent', $classes)
			]);
		}
	}
	return $classes;
}

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null) {
	return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
function html5_shortcode_demo_2($atts, $content = null) {
	return "<h2>{$content}</h2>";
}

// Create custom taxonomy for role
function role_taxonomy_init() {
	register_taxonomy(
		'role',
		'post',
		array(
			'label' => __('Role'),
			'rewrite' => array(
				'slug' => 'role'
			)
		)
	);
}

// Create Custom Post Type
function create_post_type_html5() {
	register_taxonomy_for_object_type('category', 'project'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'project');
	register_post_type('project',
		array(
			'labels' => array(
				'name'                => __('Project Post', 'project'),
				'singular_name'       => __('Project Post', 'project'),
				'add_new'             => __('Add New', 'project'),
				'add_new_item'        => __('Add New Project Post', 'project'),
				'edit'                => __('Edit', 'project'),
				'edit_item'           => __('Edit Project Post', 'project'),
				'new_item'            => __('New Project Post', 'project'),
				'view'                => __('View Project Post', 'project'),
				'view_item'           => __('View Project Post', 'project'),
				'search_items'        => __('Search Project Post', 'project'),
				'not_found'           => __('No Project Post found', 'project'),
				'not_found_in_trash'  => __('No Project Post found in Trash', 'project')
			),
			'public'         => true,
			'hierarchical'   => true,
			'has_archive'    => true,
			'menu_position'  => 5,
			'supports'       => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			), // Go to Dashboard Custom Project Post for supports
			'can_export' => true, // Allows export in Tools > Export
			'taxonomies' => array(
				'post_tag',
				'category'
			) // Add Category and Post Tags support
		)
	);
}

if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'   => 'Theme Options',
		'menu_title'   => 'Theme Options',
    'menu_slug'    => 'theme-options',
    'capability'   => 'edit_posts',
    'parent_slug'  => '',
    'position'     => false,
    'icon_url'     => false
   ));

   acf_add_options_sub_page(array(
    'page_title'   => 'Contact Email',
    'menu_title'   => 'Contact Email',
    'menu_slug'    => 'theme-options-contact-email',
    'capability'   => 'edit_posts',
    'parent_slug'  => 'theme-options',
    'position'     => false,
    'icon_url'     => false
   ));
}

// Add Actions
add_action('wp_enqueue_scripts', 'cedrick_enqueue_scripts'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('init', 'role_taxonomy_init'); // Create custom taxonomy for role

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('nav_menu_css_class', 'fix_blog_link_on_cpt', 10, 3);

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

// If Dynamic Sidebar Exists
if(function_exists('register_sidebar')) {
	// Define Sidebar Widget Area 1
	register_sidebar(array(
		'name' => __('Widget Area 1', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	// Define Sidebar Widget Area 2
	register_sidebar(array(
		'name' => __('Widget Area 2', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

?>
