		<!-- footer -->
		<footer class="footer" role="contact-info">
			<div class="footer-left next-container">
				<a class="next-link" href="<?php  ?>">Next</a>
			</div>
			<div class="footer-center project-container">
				<h4 class="project-label">Project</h4>
				<span class="projet-name"><?php echo get_the_title(); ?></span>
			</div>
			<div class="footer-right date-container">
				<h4 class="date-label">Year</h4>
				<span class="date-entry"><?php echo get_the_date("Y"); ?></span>
			</div>
		</footer>
		<!-- /footer -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
