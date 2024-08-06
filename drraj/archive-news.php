<?php

get_header(); 
pageBanner(array(
  'title' => 'News',
  'photo' => get_theme_file_uri('images/news-banner-h.png')
));
?>


<div class="container container--narrow page-section">

<ul class="link-list min-list">

<?php
  while(have_posts()) {
    the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php }
  echo paginate_links();
?>
</ul>



</div>

<?php get_footer();

?>