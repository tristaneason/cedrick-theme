		<!-- footer -->
		<footer class="footer" role="contentinfo">

			<div class="footer-social">
				<ul>
					<li class="fb"><a href="#">Fb</a></li>
					<li class="twt"><a href="#">Twt</a></li>
					<li class="gplus"><a href="#">G+</a></li>
				</ul>
			</div>

			<div class="footer-copyright">
				<p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> &mdash; All rights reserved</p>
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
