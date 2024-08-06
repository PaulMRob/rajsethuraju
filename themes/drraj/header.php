<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
  <header class="site-header">
    <div class="container">
      <div class="site-header__util">
        <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      </div>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li <?php if (get_post_type() == 'rubric') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/rubric') ?>">academic</a></li>
            <li <?php if (is_page('about') or wp_get_post_parent_id(0) == 75) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/about') ?>">about</a></li>
            <li <?php if (get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/events') ?>">events</a></li>
            <li <?php if (get_post_type() == 'news') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/news'); ?>">news</a></li>
            <li><a href="<?php echo site_url('/consulting') ?>">consulting</a></li>
          </ul> 
        </nav>
        
      </div>
      <div class="site-header__logo-container">
      <a href="<?php echo site_url('/') ?>"><img src="<?php echo get_theme_file_uri('images/logo_white.png') ?>" alt=""></a>          
      </div>
    </div>
  </header>