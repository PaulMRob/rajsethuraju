<?php 

require get_theme_file_path('/inc/search-route.php');

function drraj_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() {return get_the_author();}
    ));
}

add_action('rest_api_init', 'drraj_custom_rest');

function pageBanner($args = NULL) {
    if(!isset($args['title'])) {
        $args['title'] = get_the_title();
    }

    if(!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!isset($args['photo'])) {
        if (get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/news-banner-h.png');
        }
    }
    ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>  
    </div>
    <?php
}

function raj_files() {
    wp_enqueue_script('main-raj-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    wp_enqueue_style('font-awsome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('raj_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('raj_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script('main-raj-js', 'rajData', array(
        'root_url' => get_site_url()
    ));
}


add_action('wp_enqueue_scripts', 'raj_files');

function raj_features() {

// ADDING DYNAMIC MENU
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('pageBanner', 1500, 550, true);

// ADDING CUSTOM LOGO SUPPORT    
    add_theme_support(
        'custom-logo', 
        array(
            'height'        => 250,
            'width'         => 250,
            'flex-width'    => true,
            'flex-height'   => true,
        )
    );
}

add_action('after_setup_theme', 'raj_features');

//ORDERING PAST EVENTS IN ARCHIVE
function raj_adjust_queries($query) {
    if (!is_admin() AND is_post_type_archive('rubric') AND is_main_query()){
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', '-1');
    }

    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        $query->set('met_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key'     => 'event_date',
              'compare' => '>=',
              'value'   => date('Ymd'),
              'type'    => 'numeric'
            )
          ));

    }
}

add_action('pre_get_posts', 'raj_adjust_queries');


