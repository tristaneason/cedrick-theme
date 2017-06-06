<?php get_header(); ?>

	<!-- PAGE SPECIFIC CONDITIONALS -->
	<?php
	if(is_page('contact')) {
		get_template_part('partials/partial', 'contact');
	}
	elseif(is_page('about-us')) {
		get_template_part('partials/partial', 'about-us');
	}
	else {
	?>

	<!-- section -->
	<section role="main">
		<h1><?php the_title(); ?></h1>

		<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post();
		?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
			<br class="clear">
			<?php edit_post_link(); ?>
		</article>
		<!-- /article -->

			<?php
			} // while
		}
		else {
		?>

		<!-- article -->
		<article>
			<h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>
		</article>
		<!-- /article -->

		<?php
		}
		?>

		</section>
		<!-- /section -->
	<?php } ?>

<?php get_footer(); ?>
