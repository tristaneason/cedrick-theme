<?php get_header(); ?>

	<!-- PAGE SPECIFIC CONDITIONALS -->
	<?php /* CONTACT */ if ( is_page( 'contact' ) ) { ?>
		<?php get_template_part( 'partials/partial', 'contact' ); ?>

	<?php } /* ABOUT-US */ elseif ( is_page( 'about-us' ) ) { ?>
		<?php get_template_part( 'partials/partial', 'about-us' ); ?>
		

	<?php } /* GENERIC PAGES */ else { ?>

		<!-- section -->
		<section role="main">
		
			<h1><?php the_title(); ?></h1>
		
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<?php the_content(); ?>
				
				<br class="clear">
				
				<?php edit_post_link(); ?>
				
			</article>
			<!-- /article -->
			
		<?php endwhile; ?>
		
		<?php else: ?>
		
			<!-- article -->
			<article>
				
				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				
			</article>
			<!-- /article -->
		
		<?php endif; ?>
		
		</section>
		<!-- /section -->

		<?php get_sidebar(); ?>

	<?php } ?>

<?php get_footer(); ?>