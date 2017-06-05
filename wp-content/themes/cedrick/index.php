<?php get_header(); ?>

<div class="post-feed-wrapper">

	<!-- section -->
	<section role="main">
		<?php get_template_part('loop'); ?>
	</section>
	<!-- /section -->

</div><!-- /.post-feed-wrapper -->


<?php get_template_part('pagination'); ?>
	
<?php get_footer(); ?>