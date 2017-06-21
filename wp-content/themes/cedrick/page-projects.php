<?php
/**
 * Template Name: Projects Overview
 */

get_header(); ?>

<section class="projects-section">

  <?php
  $args = array(
    'post_type' => array('project'),
  );
  $query = new WP_Query($args);

  // Loop through project posts
  if($query->have_posts()) {
    while($query->have_posts()) {
      $query->the_post();
      $project_url = get_post_permalink();
      $project_title = get_the_title();
      $project_thumbnail_array = get_field("project_thumbnail");
      $project_thumbnail_url = $project_thumbnail_array["url"];
      $project_thumbnail_alt = $project_thumbnail_array["alt"]; ?>

      <div class="project-container">
        <a class="project-url" href="<?php echo $project_url; ?>">
          <img class="project-thumbnail" src="<?php echo $project_thumbnail_url; ?>" alt="<?php echo $project_thumbnail_alt; ?>">
        </a>
        <a class="project-url" href="<?php echo $project_url; ?>">
          <h2 class="project-title"><?php echo $project_title; ?></h2>
        </a>
      </div>

      <?php
      wp_reset_postdata();
    }
  }
  else {
    echo "No project posts found :(";
  } ?>

</section>

<?php
get_footer();
?>
