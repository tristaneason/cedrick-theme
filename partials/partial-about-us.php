<div class="intro-wrapper">
	<div class="intro-content">
		<h2>Your diversified application</h2>
		<h1>SPECIALISTS</h1>
	</div>
	<div class="header-swap">
	</div>
</div><!-- /.intro-wrapper -->


<div class="about-slider-wrapper">
	<div class="about-text-heading">
		<h1>So here<span class="apostrophe">'</span>s<br />
		<span class="highlight">The Scoop.</span></h1>
	</div>
		
	<div class="about-slider">
	<?php if(get_field('about_text_slides')): ?>
		<ul class="about-content">
		<?php while(the_repeater_field('about_text_slides')): ?>
			<li>
				<p><?php the_sub_field('about_text_slide'); ?></p>
			</li>
		<?php endwhile; ?>
		</ul>

		<div class="slider-controls">
			<p><span class="about-slide-prev"></span><span class="about-slide-next"></span></p>
		</div>
	<?php endif; ?>

	</div><!-- /.about-slider -->
</div><!-- /.about-slider-wrapper -->


<div class="about-video">
	<div class="about-video-text">
		<h1>Think . Create . Repeat</h1>
		<p>Watch the day in the life at Trinity Graphics.</p>
		<a href="#" class="play-btn">Play</a>
	</div><!-- /.about-video -->
</div><!-- /.about-video-text -->


<div class="team-wrapper">
<?php if( have_rows('team_member_slides') ): ?>
	<ul class="team-member-slider">

	<?php
		$team_member_index = 0;
		while( have_rows('team_member_slides') ): the_row();
		$team_member_index++; 
	?>
		<li class="team-member team-member-<?php echo $team_member_index; ?>" data-team-member-index="<?php echo $team_member_index; ?>">
			<aside class="bio-text">
				<div class="inner-right">
					<h3><?php the_sub_field('team_member_name'); ?></h3>
					<p><?php the_sub_field('team_member_bio'); ?></p>
				</div>
			</aside>
		<?php if(get_sub_field('team_member_photos')): ?>
			<ul class="team-member-gallery">
			<?php while(has_sub_field('team_member_photos')): ?>
				<li>
					<?php $photo = wp_get_attachment_image_src(get_sub_field('team_member_photo'), 'full'); ?>
					<img src="<?php echo $photo[0]; ?>" alt="<?php echo get_the_title(get_field('team_member_photo')) ?>" />
				</li>
			<?php endwhile; ?>
			</ul>
			<div class="slider-controls gallery-pager">
				<p><span class="gallery-prev-photo"></span><span class="gallery-next-photo"></span></p>
			</div>
		<?php endif; ?>
		</li>
	<?php endwhile; ?>

	</ul><!-- /.team-member-slider -->
	<div class="slider-controls">
		<p><span class="team-slide-prev"></span><span class="team-slide-next"></span></p>
	</div>
<?php endif; ?>
</div><!-- /.team-wrapper -->


<div class="office-gallery-wrapper">
	<div class="section group">
		<aside class="col span_4_of_10">
			<div class="inner-left">
				<div class="content">
					<h3>Check the<br />
					<span class="highlight">Office Digs.</span></h3>
					<a href="#" class="btn-round-white">Map It</a>
				</div>
			</div>
		</aside>

		<?php if( have_rows('office_gallery') ): ?>
		<ul class="slider-office-gallery">
			<?php while( have_rows('office_gallery') ): the_row(); ?>

			<li>
				<?php $image = wp_get_attachment_image_src(get_sub_field('office_photos'), 'full'); ?>
				<img src="<?php echo $image[0]; ?>" alt="<?php  the_sub_field('title');?>" />
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
		
		<div class="slider-controls col span_6_of_10">
			<p><span class="office-slide-prev"></span><span class="office-slide-next"></span></p>
		</div>
	</div>
</div><!-- /.office-gallery-wrapper -->


<div class="get-quote-wrapper">
	<div class="get-quote-content">
		<h2>Your Diversified Application Specialists</h2>
		<p>We build brands by combining quality workmanship and distinctive design.<br />
			Whether it's screen printing, embroidery or promotional items, we deliver professional results with a personal touch.</p>
		<a href="#" class="btn-round-white">Get a quote</a>
	</div>
</div>