<?php get_header(); ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/hero-raj.jpg') ?>)"></div>
    <div class="page-banner__content c-white">
      <h1 class="headline headline--large ">dr <br> <strong>raj</strong><br> sethuraju</h1> 
      <h3 class="headline headline--small">Associate Professor of Criminal Justice, Activist, Community Leader</h3>
    </div>
  </div>

  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">My Upcoming Events</h2>

        <?php
          $homepageEvents = new WP_query(array(
            'posts_per_page'  => 2,
            'post_type'       => 'event',
            'meta_key'        => 'event_date',
            'orderby'         => 'meta_value_num',
            'order'           => 'ASC',
            'meta_query'      => array(
              array(
                'key'     => 'event_date',
                'compare' => '>=',
                'value'   => date('Ymd'),
                'type'    => 'numeric'
              )
            )
          ));
          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post(); ?>
            
            <!-- EVENT LIST -->
            <div class="event-summary-fp">
              <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php
                $eventDate = new DateTime(get_field('event_date'));
                echo $eventDate->format('M')  
                ?></span>
                <span class="event-summary__day"><?php 
                $eventDate = new DateTime(get_field('event_date'));
                echo $eventDate->format('d')
                ?></span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                } ?><a href="<?php the_permalink(); ?>" class="nu gray"> Read more</a></p>
              </div>
            </div>

          <?php } ?>

        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--black">View All Events</a></p>
      </div>
    </div>

    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">My Recent News</h2>

        <?php
          $homepageNews = new WP_query(array(
            'posts_per_page' => 2
          ));

          while ($homepageNews->have_posts()) {
            $homepageNews->the_post(); ?>
            
            <!-- NEWS LIST -->
            <div class="news-summary">
              <div class="news-summary__content">
                <h5 class="news-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                } ?><a href="<?php the_permalink(); ?>" class="nu gray"> Read more</a></p>
              </div>
            </div>

          <?php } wp_reset_postdata();
        ?>

        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('news'); ?>" class="btn btn--yellow">Read More News</a></p>
      </div>
    </div>
  </div>

  <div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
      <div class="glide__slides">
        <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/consulting.png;') ?>)">
          <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
              <h2 class="headline headline--medium t-center">Consulting</h2>
              <!-- <p class="t-center">All students have free unlimited bus fare.</p> -->
              <p class="t-center no-margin"><a href="#" class="btn btn--black">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/public-speaking.png') ?>)">
          <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
              <h2 class="headline headline--medium t-center">Public Speaking</h2>
              <!-- <p class="t-center">Our dentistry program recommends eating apples.</p> -->
              <p class="t-center no-margin"><a href="#" class="btn btn--black">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/poverty-sim.png') ?>)">
          <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
              <h2 class="headline headline--medium t-center">Poverty Simulations</h2>
              <!-- <p class="t-center">Fictional University offers lunch plans for those in need.</p> -->
              <p class="t-center no-margin"><a href="#" class="btn btn--black">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/justice.png') ?>)">
          <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
              <h2 class="headline headline--medium t-center">Justice Systems</h2>
              <!-- <p class="t-center">Fictional University offers lunch plans for those in need.</p> -->
              <p class="t-center no-margin"><a href="#" class="btn btn--black">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
  </div>

  <?php get_footer(); 
?>

