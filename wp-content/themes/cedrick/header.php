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

   </head>
   <body <?php body_class(); ?>>

      <div class="header-wrapper">

         <!-- header -->
         <header class="header" role="banner">

            <!-- logo -->
            <div class="logo">
               <a href="<?php echo home_url(); ?>" alt="Logo" class="logo-img"></a>
            </div>
            <!-- /logo -->

            <!-- <a class="menu-button">Menu</a> -->
            <nav class="nav" role="navigation">
               <?php html5blank_nav(); ?>
            </nav>

         </header>
         <!-- /header -->

      </div><!-- /.header-wrapper -->