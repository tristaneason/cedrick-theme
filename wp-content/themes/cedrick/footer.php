		<!-- footer -->
		<footer class="footer" role="contact-info">
			<div class="footer-left developer-container">
				<a class="developer-link" target="_blank" href="http://harbr.co">Developed by Harbr Co.</a>
			</div>
			<div class="footer-center contact-container">
				<a class="contact-link" href="mailto:<?php the_field("email", "option"); ?>"><?php the_field("email", "option"); ?></a>
			</div>
			<div class="footer-right misc-container">
				<span>All rights reserved. &copy; <?php echo date("Y"); ?></span>
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
