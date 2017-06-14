<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?></title>

    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>
    <?php $permalink = get_permalink(); ?>
  </head>

  <body <?php body_class(); ?> id="barba-wrapper">
    <div class="barba-container" style="height:100%">
      <div class="header-wrapper">
        <header class="header" role="banner">
          <div class="site-name-container">
            <a href="<?php echo home_url(); ?>" class="site-name"><?php bloginfo(); ?></a>
          </div>
          <nav class="nav" role="navigation">
            <?php html5blank_nav(); ?>
          </nav>
        </header>
      </div>
