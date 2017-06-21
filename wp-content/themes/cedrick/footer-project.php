      <footer class="footer" role="contact-info">
        <div class="footer-container">
          <div class="footer-item next-prev-container">

            <?php
            $prev_post = get_previous_post();
            $prev_post_id = $prev_post->ID;
            if($prev_post) { ?>
              <a class="next-link" href="<?php echo get_permalink($prev_post_id); ?>">Next</a>
            <?php
            }
            else { ?>
              <span class="disabled-next-link">Next</span>
            <?php
            } ?>

          </div>
          <div class="footer-item project-container">
            <h4 class="footer-label project-label">Project</h4>
            <span class="footer-entry project-name"><?php echo get_the_title(); ?></span>
          </div>
          <div class="footer-item date-container">
            <h4 class="footer-label date-label">Year</h4>
            <span class="footer-entry date-entry"><?php echo get_the_date("Y"); ?></span>
          </div>
        </div>
      </footer>

      <?php wp_footer(); ?>

      <script>
      (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
      (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
      l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
      ga('send', 'pageview');
      </script>

    </div> <!-- .barba-container -->
  </body>
</html>
