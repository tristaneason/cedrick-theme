<?php get_header(); ?>

	<section role="main">
		<h1><?php the_title(); ?></h1>
		<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
					<br class="clear">
					<?php edit_post_link(); ?>
				</article>

			<?php
			} // while
		}
		else { ?>

			<article>
				<h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>
			</article>

		<?php
		} ?>
		</section>
	<?php
	} ?>

<?php get_footer(); ?>
