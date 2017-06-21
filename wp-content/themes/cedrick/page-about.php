<?php
/**
 * Template Name: About
 */

get_header();

if(have_posts()) {
  while(have_posts()) {
    the_post(); ?>

    <section class="about-section">
      <div class="about-content-container">
        <?php the_content(); ?>
        <div class="social-media-links-container">

        <?php
        $fields = get_fields();
        if($fields) {
          foreach($fields as $field_url) {                              // https://www.field.com/username/
            $field_path      = parse_url($field_url, PHP_URL_PATH);     // /username
            $field_domain    = parse_url($field_url, PHP_URL_HOST);     // www.field.com
            $field_trim1     = str_replace("www.", "", $field_domain);  // field.com
            $field_trim2     = str_replace(".com", "", $field_trim1);   // field
            $field_name      = ucfirst($field_trim2);                   // Field
            $field_username  = trim($field_path, "/");                  // username
            if(!empty($field_url)) { ?>

              <div class="social-media-item">
                <h2 class="social-media-label"><?php echo $field_name; ?></h2>
                <a target="_blank" href="<?php echo $field_url; ?>"><?php echo $field_username; ?></a>
              </div>

            <?php
            }
          } // foreach
        } ?>

        </div> <!-- .social-media-links-container -->
      </div> <!-- .about-content-container -->
    </section>

  <?php
  } // while
} // if

get_footer();

?>
